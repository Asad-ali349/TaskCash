<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\admin;
use App\property;
use App\property_gallery;
use App\property_docs;
use App\service_type;
use App\vendors;
use App\property_expenses;
use App\expense_docs;
use App\buyer;
use App\property_sold;
use App\invoices;
use App\investors;
use App\property_investment;



class AdminController extends Controller
{
    //
    public function index()
    {
        return view('index');
    }
    public function login(Request $req)
    {
        $validator = Validator::make($req->all(),[
            'email'=>'required|email',
            'password'=>'required', 
        ]);

        if($validator->fails())
        {
            return redirect()->back()->with('error_msg', $validator->errors()->first());
        }else{
            // dd($req);
            if(Auth::guard('admin')->attempt(['email'=>$req->email,'password'=>$req->password]))
            {

                ///////////////////take to dashboard
                return redirect("/dashboard");
            }
            else
            {
                //////////////////////error msg password not correct
                return redirect()->back()->with('error_msg', "Incorrect Password");
            }
        }
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();

        $request->session()->regenerateToken();
        return redirect('/');
    }
    public function forgot_password()
    {
        return view('forget_password');
    }
    public function submit_forgot_password(Request $req)
    {
        $validator = Validator::make($req->all(),[
            'email'=>'required|email', 
        ]);

        if($validator->fails())
        {
            return redirect()->back()->with('error_msg', $validator->errors()->first());
        }else{
            // dd($req);
            $user=admin::where('email',$req->email)->first();
            if($user){   
                dd("sss");
            }else{
                return redirect()->back()->with('error_msg', " User not found");
            }
        }
    }
    public function dashboard()
    {
        $current_month=date('m');
        $current_year=date('Y');
        $total_purchase=property::whereMonth('created_at', '=', date('m'))->whereYear('created_at', '=', date('Y'))->sum('purchased_amount');
        $total_sale=property_sold::whereMonth('created_at', '=', date('m'))->whereYear('created_at', '=', date('Y'))->sum('sold_amount');
        $total_expense=property_expenses::whereMonth('created_at', '=', date('m'))->whereYear('created_at', '=', date('Y'))->sum('amount');
        
        $purchase_property_count=property::whereMonth('created_at', '=', date('m'))->whereYear('created_at', '=', date('Y'))->get()->count();
        $sold_property_count=property_sold::whereMonth('created_at', '=', date('m'))->whereYear('created_at', '=', date('Y'))->get()->count();
        $vendor_count=vendors::get()->count();


        return view('dashboard',compact(['total_purchase','total_sale','total_expense','purchase_property_count','sold_property_count','vendor_count']));
    }



    public function cal_revenue()
    {

        $current_year=date('Y');
        // ------------------------------------------------------------------Purchase------------------------------------------------------------//

        $monthly_purchase_revenue=DB::select('SELECT MONTHNAME(purchased_date) as month,sum(purchased_amount) as sum FROM `property` where Year(property.purchased_date)='.$current_year.' GROUP BY Month(purchased_date);');
        $count=0;
        $month_purchase_name=array();
        $month_purchase_sum=array();
        foreach($monthly_purchase_revenue as $revenue){
            $month_purchase_name[$count]=$revenue->month;
            $month_purchase_sum[$count]=$revenue->sum;
            $count++;  
        }

        $yearly_purchase_revenue=DB::select('SELECT Year(purchased_date) as year,sum(purchased_amount) as sum FROM `property` GROUP BY Year(purchased_date);');
        $count2=0;
        $year_purchase_name=array();
        $year_purchase_sum=array();
        foreach($yearly_purchase_revenue as $revenue){
            $year_purchase_name[$count2]=$revenue->year;
            $year_purchase_sum[$count2]=$revenue->sum;
            $count2++;  
        }
        // ------------------------------------------------------------------------------------------------------------------------------------


        // ------------------------------------------------------------------Sale---------------------------------------------------------------//

        $monthly_sale_revenue=DB::select('SELECT MONTHNAME(created_at) as month,sum(sold_amount) as sum FROM `property_sold` where Year(property_sold.created_at)='.$current_year.' GROUP BY Month(created_at);');
        $count=0;
        $month_sale_name=array();
        $month_sale_sum=array();
        foreach($monthly_sale_revenue as $revenue){
            $month_sale_name[$count]=$revenue->month;
            $month_sale_sum[$count]=$revenue->sum;
            $count++;  
        }

        $yearly_sale_revenue=DB::select('SELECT Year(created_at) as year,sum(sold_amount) as sum FROM `property_sold` GROUP BY Year(created_at);');
        $count2=0;
        $year_sale_name=array();
        $year_sale_sum=array();
        foreach($yearly_sale_revenue as $revenue){
            $year_sale_name[$count2]=$revenue->year;
            $year_sale_sum[$count2]=$revenue->sum;
            $count2++;  
        }
        // ----------------------------------------------------------------------------------------------------------------------------------------------//

        $response=['error'=>false];
        $response['month_purchase_name']=$month_purchase_name;
        $response['month_purchase_sum']=$month_purchase_sum;
        $response['month_sale_name']=$month_sale_name;
        $response['month_sale_sum']=$month_sale_sum;
        $response['year_purchase_name']=$year_purchase_name;
        $response['year_purchase_sum']=$year_purchase_sum;
        $response['year_sale_name']=$year_sale_name;
        $response['year_sale_sum']=$year_sale_sum;
        return response()->json($response);


        // return view('admin/dashboard',compact(['student_count','courses_count','helping_material_count','month_name','month_sum']));
    }
    public function profile()
    {
        $user_id=Auth::guard('admin')->user()->id;
        $user=admin::where('id',$user_id)->first();
        return view('profile',compact('user'));
    }
    public function edit_profile($user_id)
    {   
        $user=admin::where('id',$user_id)->first();
        return view('edit_profile',compact('user'));
    }
    public function submit_edit_profile(Request $req)
    {
        $validator = Validator::make($req->all(),[
            'name'=>'required',
            'email'=>'required',
            'phone'=>'required',
            'address'=>'required',
        ]);

        if($validator->fails())
        {
            return redirect()->back()->with('error_msg', $validator->errors()->first());
        }else{
            $user_id=Auth::guard('admin')->user()->id;

            if($req->file('profile_image')!=null){
                
                $unlink_doc=Storage::delete(Auth::guard('admin')->user()->profile_image);
                $profileImage=$req->file('profile_image')->store('Profile_Image');
                $add_property=admin::where('id',$user_id)->update([
                    'name'=>$req->name,
                    'email'=>$req->email, 
                    'phone'=>$req->phone, 
                    'address'=>$req->address, 
                    'profile_image'=>$profileImage,
                ]);
                if($add_property){
                    return redirect()->back()->with('success_msg', 'Profile Updated');
                }else{
                    return redirect()->back()->with('error_msg', 'Unable To Update Profile...');
                }
            }else{
                $add_property=admin::where('id',$user_id)->update([
                    'name'=>$req->name,
                    'email'=>$req->email, 
                    'phone'=>$req->phone, 
                    'address'=>$req->address, 
                ]);
                if($add_property){
                    return redirect()->back()->with('success_msg', 'Profile Updated');
                }else{
                    return redirect()->back()->with('error_msg', 'Unable To Update Profile...');
                }
            }
            
        }
    }
    public function change_password()
    {
        return view('change_password');
    }
    public function submit_change_password(Request $req)
    {
        $validator = Validator::make($req->all(),[
            'oldpassword'=>'required',
            'newpass'=>'required',
            'cpass'=>'required',
            
        ]);
        if($validator->fails())
        {
            return redirect()->back()->with('error_msg', $validator->errors()->first());
        }else{
            $user_id=Auth::guard('admin')->user()->id;
            // Hash::make($req->oldpassword);
            // dd();
            if(Hash::check($req->oldpassword,Auth::guard('admin')->user()->password)){

                if($req->newpass==$req->cpass){
                    $update_pass=admin::where('id',$user_id)->update([
                        'password'=>Hash::make($req->newpass),
                    ]);
                    if($update_pass){
                        return redirect()->back()->with('success_msg', "password updated successfully");
                    }else{
                        return redirect()->back()->with('error_msg', "unable to update password");
                    }
                }else{
                    return redirect()->back()->with('error_msg', "new password and confirm password are not matched");
                }
            }else{
                return redirect()->back()->with('error_msg', "inccorrect old password");
            }
        }
    }
    public function add_property()
    {
        $investors=investors::get();
        return view('add_property',compact('investors'));
    }
    public function submit_add_property(Request $req)
    {
        $validator = Validator::make($req->all(),[
            'property_address'=>'required',
            'number_of_marla'=>'required',
            'property_type'=>'required',
            'number_of_sq_feet'=>'required',
            'purchase_price'=>'required',
            'purchase_date'=>'required',
            'primary_image'=>'required',
        ]);

        if($validator->fails())
        {
            return redirect()->back()->with('error_msg', $validator->errors()->first());
        }else{
            
            // dd($req->investment_amount);
            if($req->file('primary_image')!=null){
                
                $propertyImage=$req->file('primary_image')->store('Property_Images');
                $add_property=property::create([
                    'property_address'=>$req->property_address,
                    'property_image'=>$propertyImage, 
                    'property_type'=>$req->property_type, 
                    'num_of_marla'=>$req->number_of_marla, 
                    'sq_feet'=>$req->number_of_sq_feet, 
                    'purchased_amount'=>$req->purchase_price, 
                    'purchased_date'=>$req->purchase_date
                ]);
                if($add_property){
                    foreach($req->investor_id as $key=>$name){
                        if($req->investor_id[$key]!=null){
                            $add_investment=property_investment::create([
                                'property_id'=>$add_property->id,
                                'investors_id'=>$req->investor_id[$key],
                                'investment_amount'=>$req->investment_amount[$key],
                            ]);
                        }
                    }
                    return redirect::route('add_property_gallery',['property_id'=>$add_property->id]);
                }else{
                    return redirect()->back()->with('error_msg', 'Unable To add Property...');
                }
            }
            
        }

    }
   
    public function add_property_gallery($property_id)
    {
        return view('add_property_gallery',compact('property_id'));
    }
    public function submit_add_property_gallery(Request $req)
    {
        $response=['error'=>true];
        $validator = Validator::make($req->all(),[
            'property_id'=>'required',
        ]);
        if($validator->fails())
        {
            return redirect()->back()->with('error_msg', $validator->errors()->first());
        }else{
            if($req->file('file')!=null){
                
                foreach($req->file('file') as $key=>$name){
                    $propertyImage=$req->file('file')[$key]->store('Property_Gallery');
                    $add_property_gallery= new property_gallery;
                    $add_property_gallery->property_id=$req->property_id;
                    $add_property_gallery->property_image=$propertyImage;
                    $add_property_gallery->save();
                    
                }
                
                $response['error']=false;
                $response['msg']="Gallery uploaded";
                $response['type']="success";
                return response()->json($response);
            }
            
        }
    }

    public function add_property_docs($property_id)
    {
        return view('add_property_docs',compact('property_id'));
    }
    public function submit_add_property_docs(Request $req)
    {
        // dd($req);
        $validator = Validator::make($req->all(),[
            'property_id'=>'required',
            'doc_name'=>'required',
            'doc'=>'required'
        ]);
        if($validator->fails())
        {
            return redirect()->back()->with('error_msg', $validator->errors()->first());
        }else{
            if($req->file('doc')!=null){
                $add_property_docs=false;
                foreach($req->file('doc') as $key=>$name){
                    $propertydoc=$req->file('doc')[$key]->store('Property_Docs');
                    $add_property_docs= new property_docs;
                    $add_property_docs->property_id=$req->property_id;
                    $add_property_docs->doc_name=$req->doc_name[$key];
                    $add_property_docs->document=$propertydoc;
                    $add_property_docs->save();
                    
                }
                if($add_property_docs){
                    return redirect('/add_property')->with('success_msg',"Property Added Successfully");
                    // return redirect()->back()->with('success_msg', "Unable to upload Docs");
                }else{
                    return redirect()->back()->with('error_msg', "Unable to upload Docs");
                }
                
            }
            
        }
    }

    public function edit_property($property_id)
    {
        $property=property::where('id',$property_id)->first();
        $investors=investors::get();
        return view('edit_property',compact('property','investors'));
    }
    public function submit_edit_property(Request $req)
    {
        $validator = Validator::make($req->all(),[
            'property_id'=>'required',
            'property_address'=>'required',
            'number_of_marla'=>'required',
            'property_type'=>'required',
            'number_of_sq_feet'=>'required',
            'purchase_price'=>'required',
            'purchase_date'=>'required',
        ]);

        if($validator->fails())
        {
            return redirect()->back()->with('error_msg', $validator->errors()->first());
        }else{
            if($req->file('primary_image')!=null){
                // dd($req);
                $propertyImage=$req->file('primary_image')->store('Property_Images');
                $add_property=property::where('id',$req->property_id)->update([
                    'property_address'=>$req->property_address,
                    'property_image'=>$propertyImage, 
                    'property_type'=>$req->property_type, 
                    'num_of_marla'=>$req->number_of_marla, 
                    'sq_feet'=>$req->number_of_sq_feet, 
                    'purchased_amount'=>$req->purchase_price, 
                    'purchased_date'=>$req->purchase_date
                ]);
                if($add_property){
                    $delete_investment=property_investment::where('property_id',$req->property_id)->delete();
                    if($req->investor_id!=null){
                        foreach($req->investor_id as $key=>$name){
                            if($req->investor_id[$key]!=null){
                                $add_investment=property_investment::create([
                                    'property_id'=>$req->property_id,
                                    'investors_id'=>$req->investor_id[$key],
                                    'investment_amount'=>$req->investment_amount[$key],
                                ]);
                            }
                        }
                    }
                    
                    
                    return redirect::route('edit_property_gallery',['property_id'=>$req->property_id]);
                }else{
                    return redirect()->back()->with('error_msg', 'Unable To Update Property...');
                }
            }else{
                $add_property=property::where('id',$req->property_id)->update([
                    'property_address'=>$req->property_address,
                    'property_type'=>$req->property_type, 
                    'num_of_marla'=>$req->number_of_marla, 
                    'sq_feet'=>$req->number_of_sq_feet, 
                    'purchased_amount'=>$req->purchase_price, 
                    'purchased_date'=>$req->purchase_date
                ]);
                if($add_property){
                    $delete_investment=property_investment::where('property_id',$req->property_id)->delete();
                    if($req->investor_id!=null){
                        foreach($req->investor_id as $key=>$name){
                            if($req->investor_id[$key]!=null){
                                $add_investment=property_investment::create([
                                    'property_id'=>$req->property_id,
                                    'investors_id'=>$req->investor_id[$key],
                                    'investment_amount'=>$req->investment_amount[$key],
                                ]);
                            }
                        }
                    }
                    
                    return redirect::route('edit_property_gallery',['property_id'=>$req->property_id]);
                }else{
                    return redirect()->back()->with('error_msg', 'Unable To Updated Property...');
                }
            }
            
        }

    }
    public function edit_property_gallery($property_id)
    {   
        $property_gallery=property_gallery::where('property_id',$property_id)->get();
        return view('edit_property_gallery',compact(['property_id','property_gallery']));
    }
    public function submit_edit_property_gallery(Request $req)
    {
        $response=['error'=>true];
        $validator = Validator::make($req->all(),[
            'property_id'=>'required',
        ]);
        if($validator->fails())
        {
            return redirect()->back()->with('error_msg', $validator->errors()->first());
        }else{
            if($req->file('file')!=null){
                
              
                    $propertyImage=$req->file('file')->store('Property_Gallery');
                    $add_property_gallery= new property_gallery;
                    $add_property_gallery->property_id=$req->property_id;
                    $add_property_gallery->property_image=$propertyImage;
                    $add_property_gallery->save();
                    
                
                if($add_property_gallery){

                    $response['error']=false;
                    $response['msg']="Gallery uploaded";
                    $response['type']="success";
                    return response()->json($response);
                }else{
                    
                    $response['msg']="Unable to upload Gallery";
                    $response['type']="error";
                    return response()->json($response);

                }
            }
            
        }
    }
    public function edit_property_docs($property_id)
    {
        $docs=property_docs::where('property_id',$property_id)->get();
        return view('edit_property_docs',compact('property_id','docs'));
    }
    public function submit_edit_property_docs(Request $req)
    {
        $validator = Validator::make($req->all(),[
            'property_id'=>'required',
            'doc_name'=>'required'
        ]);
        if($validator->fails())
        {
            return redirect()->back()->with('error_msg', $validator->errors()->first());
        }else{
            // dd("asas");
            if($req->file('doc')!=null){
                $add_property_docs=false;
                foreach($req->file('doc') as $key=>$name){
                    $propertydoc=$req->file('doc')[$key]->store('Property_Docs');
                    $add_property_docs= new property_docs;
                    $add_property_docs->property_id=$req->property_id;
                    $add_property_docs->doc_name=$req->doc_name[$key];
                    $add_property_docs->document=$propertydoc;
                    $add_property_docs->save();
                    
                }
                if($add_property_docs){
                    // return redirect('/edit_property')->with('success_msg',"Property Added Successfully");
                    return redirect::route('edit_property',['property_id'=>$req->property_id])->with('success_msg',"Property Edited Successfully");
                    // return redirect()->back()->with('success_msg', "Unable to upload Docs");
                }else{
                    return redirect()->back()->with('error_msg', "Unable to upload Docs");
                }
                
            }
            return redirect::route('edit_property',['property_id'=>$req->property_id])->with('success_msg',"Property Edited Successfully");
            
        }
    }
    public function view_property()
    {
        // status=0 for unsold property
        $properties= property::where('status','0')->get();
        return view('view_property',compact('properties'));
    }
    public function property_detail($id)
    {
        $property=property::with(['docs','gallery','expense','investment'])->where('id',$id)->first();
        // dd($property);
        return view('property_detail_page',compact('property'));
    }

    public function add_expense($property_id)
    {
        $vendors=vendors::get();
        return view('add_expense',compact('property_id','vendors'));
    }

    // with file
    public function submit_add_expense(Request $req)
    {   
       
        $validator = Validator::make($req->all(),[
            'property_id'=>'required',
            'expense_name'=>'required',
            'vendor_id'=>'required',
            'expense_amount'=>'required',
            'expense_date'=>'required',
        ]);
        if($validator->fails())
        {
            $response['msg']=$validator->errors()->first();
            $response['type']="error";
            return response()->json($response);
            // return redirect()->back()->with('error_msg', $validator->errors()->first());
        }else{

            $add_expense=property_expenses::create([
                'name'=>$req->expense_name, 
                'expense_date'=>$req->expense_date, 
                'amount'=>$req->expense_amount, 
                'property_id'=>$req->property_id, 
                'vendor_id'=>$req->vendor_id, 
                'description'=>$req->description
            ]);

            if($add_expense){

                if($req->file('file')!=null){
                    $add_expense_docs=false;
                    foreach($req->file('file') as $key=>$name){
                        $propertydoc=$req->file('file')[$key]->store('Property_Expense_Docs');
                        $add_expense_docs= new expense_docs;
                        $add_expense_docs->property_expenses_id=$add_expense->id;
                        $add_expense_docs->document=$propertydoc;
                        $add_expense_docs->save();
                        
                    }
                    if($add_expense_docs){
                        $response['error']=false;
                        $response['msg']="Expense Added With Documents";
                        $response['type']="success";
                        return response()->json($response);
                    }else{
                        $response['error']=false;
                        $response['msg']="Expense Added Without Document";
                        $response['type']="success";
                        return response()->json($response);
                    }
                
                }else{
                    $response['error']=false;
                    $response['msg']="Expense Added Without Document";
                    $response['type']="success";
                    return response()->json($response);
                }
            }else{
                $response['msg']="Unable to Add Expense";
                $response['type']="error";
                return response()->json($response);
            }
            
        }
    }
    // without file
    public function submit_add_expense_without_file(Request $req)
    {   
       
        $validator = Validator::make($req->all(),[
            'property_id'=>'required',
            'expense_name'=>'required',
            'vendor_id'=>'required',
            'expense_amount'=>'required',
            'expense_date'=>'required',
        ]);
        if($validator->fails())
        {
            return redirect()->back()->with('error_msg', $validator->errors()->first());
        }else{

            $add_expense=property_expenses::create([
                'name'=>$req->expense_name, 
                'expense_date'=>$req->expense_date, 
                'amount'=>$req->expense_amount, 
                'property_id'=>$req->property_id, 
                'vendor_id'=>$req->vendor_id, 
                'description'=>$req->description
            ]);

            if($add_expense){
                return redirect()->back()->with('success_msg', "Expense Added Without Document");
            }else{
                return redirect()->back()->with('success_msg', "Unable to Add Expense");
            }
            
        }
    }
    


    public function expense_detail($expense_id)
    {
        $expense=property_expenses::with('expense_docs')->where('id',$expense_id)->first();
        
        return view('expense_detail',compact('expense'));
    }
    public function add_expense_docs(Request $req)
    {
        $response=['error'=>true];
        $validator = Validator::make($req->all(),[
            'expense_id'=>'required',
        ]);
        if($validator->fails())
        {
            $response['msg']=$validator->errors()->first();
            $response['type']="error";
            return response()->json($response);
        }else{
            if($req->file('file')!=null){

                $expenseDoc=$req->file('file')->store('Property_Expense_Docs');
                $expense_docs= new expense_docs;
                $expense_docs->property_expenses_id=$req->expense_id;
                $expense_docs->document=$expenseDoc;
                $expense_docs->save();
                
                if($expense_docs){
                    $response['error']=false;
                    $response['msg']="Document uploaded";
                    $response['type']="success";
                    return response()->json($response);
                }else{
                    $response['msg']="Unable to upload Document";
                    $response['type']="error";
                    return response()->json($response);

                }
            }else{
                $response['msg']="Document Not Found";
                $response['type']="error";
                return response()->json($response);
            }
            
        }
    }
    public function edit_expense($expense_id)
    {
        $vendors=vendors::get();
        $expense=property_expenses::where('id',$expense_id)->first();
        return view('edit_expense',compact('expense','vendors'));
    }
    public function submit_edit_expense(Request $req)
    {   
       
        $validator = Validator::make($req->all(),[
            'expense_id'=>'required',
            'expense_name'=>'required',
            'vendor_id'=>'required',
            'expense_amount'=>'required',
            'expense_date'=>'required',
        ]);
        if($validator->fails())
        {
            return redirect()->back()->with('error_msg', $validator->errors()->first());
        }else{

            $add_expense=property_expenses::where('id',$req->expense_id)->update([
                'name'=>$req->expense_name, 
                'expense_date'=>$req->expense_date, 
                'amount'=>$req->expense_amount,  
                'vendor_id'=>$req->vendor_id, 
                'description'=>$req->description
            ]);

            if($add_expense){
                return redirect()->back()->with('success_msg', "Expense Updated");
            }else{
                return redirect()->back()->with('success_msg', "Unable to Update Expense");
            }
            
        }
    }
    public function add_vendor()
    {
        $services=service_type::get();
        return view('add_vendor',compact('services'));
    }
    
    public function submit_add_vendor(Request $req)
    {
       
        $validator = Validator::make($req->all(),[
            'vendor_name'=>'required',
            'service_type'=>'required',
            'email'=>'required | email',
            'address'=>'required',
            'phone'=>'required'
        ]);
        if($validator->fails())
        {
            return redirect()->back()->with('error_msg', $validator->errors()->first());
        }else{
            $add_vendor=vendors::create([
                'name'=>$req->vendor_name,
                'vendor_type'=>$req->service_type,
                'email'=>$req->email,
                'address'=>$req->address,
                'phone'=> $req->phone
            ]);

            if($add_vendor){
                return redirect()->back()->with('success_msg', "Vendor Added Successfully");
            }else{
                return redirect()->back()->with('error_msg', "Unable to Add Vendor");
            }
            
        }
    }
    public function view_vendor()
    {
        $vendors=vendors::with('service_type')->get();
        return view('view_vendor',compact('vendors'));
    }
    public function edit_vendor($id)
    {
        $vendor=vendors::with('service_type')->where('id',$id)->first();
        $services=service_type::get();
        return view('edit_vendor',compact('vendor','services'));
    }
    public function submit_edit_vendor(Request $req)
    {
       
        $validator = Validator::make($req->all(),[
            'id'=>'required',
            'vendor_name'=>'required',
            'service_type'=>'required',
            'email'=>'required | email',
            'address'=>'required',
            'phone'=>'required'
        ]);
        if($validator->fails())
        {
            return redirect()->back()->with('error_msg', $validator->errors()->first());
        }else{
            $add_vendor=vendors::where('id',$req->id)->update([
                'name'=>$req->vendor_name,
                'vendor_type'=>$req->service_type,
                'email'=>$req->email,
                'address'=>$req->address,
                'phone'=> $req->phone
            ]);

            if($add_vendor){
                return redirect()->back()->with('success_msg', "Vendor Updated Successfully");
            }else{
                return redirect()->back()->with('error_msg', "Unable to Update Vendor");
            }
            
        }
    }
    public function vendor_detail($id)
    {
        $vendor=vendors::with('service_type')->where('id',$id)->first();
        return view('vendor_detail',compact('vendor'));
    }
    public function services()
    {
        $services=service_type::get();
        return view('services',compact('services'));
    }
    public function submit_add_services(Request $req)
    {
        
        $validator = Validator::make($req->all(),[
            'service_name'=>'required',
        ]);
        if($validator->fails())
        {
            return redirect()->back()->with('error_msg', $validator->errors()->first());
        }else{
            $add_service=service_type::create([
                'name'=>$req->service_name
            ]);

            if($add_service){
                return redirect()->back()->with('success_msg', "Service Type Added");
            }else{
                return redirect()->back()->with('error_msg', "Unable to Add Service Type");
            }
            
        }
    }
    public function submit_edit_services(Request $req)
    {
        $response=['error'=>true];
        $validator = Validator::make($req->all(),[
            'id'=>'required',
            'service_name'=>'required',
        ]);
        if($validator->fails())
        {
            return redirect()->back()->with('error_msg', $validator->errors()->first());
        }else{
            $add_service=service_type::where('id',$req->id)->update([
                'name'=>$req->service_name,
            ]);

            if($add_service){
                return redirect()->back()->with('success_msg', "Service Type Updated");
            }else{
                return redirect()->back()->with('error_msg', "Unable to Update Service Type");
            }
        }
    }
    public function sell_property($property_id)
    {

        $property=property::with('expense')->where('id',$property_id)->first();
        $total_expense=0.0;
        foreach($property->expense as $expense){
            $total_expense+= (float)$expense->amount;
        }
        $total_purchase_price_with_expense=(float)$property->purchased_amount+$total_expense;
        $buyers=buyer::get();


        return view('sell_property',compact('property','total_purchase_price_with_expense','buyers'));
    }

    public function submit_sell_property(Request $req)
    {
        
        $validator = Validator::make($req->all(),[
            'property_id'=>'required',
            'property_address'=>'required',
            'property_expense'=>'required',
            'property_profit'=>'required',
            'property_sale_expense'=>'required',
            'sale_type'=>'required',
            'buyer_id'=>'required',

        ]);
        if($validator->fails())
        {
            return redirect()->back()->with('error_msg', $validator->errors()->first());
        }else{

            if($req->buyer_id=='0'){
                $validator = Validator::make($req->all(),[
                    'buyer_name'=>'required',
                    'buyer_email'=>'required',
                    'buyer_cnic'=>'required',
                    'buyer_phone'=>'required',
                    'buyer_address'=>'required',
        
                ]);
                if($validator->fails())
                {
                    return redirect()->back()->with('error_msg', $validator->errors()->first());
                }else{
                    $add_buyer = buyer::create([
                        'name'=>$req->buyer_name,
                        'email'=>$req->buyer_email,
                        'cnic'=>$req->buyer_cnic,
                        'phone'=>$req->buyer_phone,
                        'address'=>$req->buyer_address,
                    ]);
                    if($add_buyer){

                        $sold_amount=(int)$req->property_expense+((int)$req->property_expense*((int)$req->property_profit/100));
                        $sold_amount=$sold_amount - (int)$req->property_sale_expense;

                        $current_date=date("Y-m-d h:i:s");
                        $sold_property=property_sold::create([
                            'property_id'=>$req->property_id, 
                            'buyer_id'=>$add_buyer->id,
                            'sold_date'=>$current_date,
                            'sold_amount'=>$sold_amount,  
                            'sold_type'=>$req->sale_type,
                        ]);
                        if($sold_property){
                            // changing status to 1 becuase status 1 is for sold properties
                            $mark_as_sold=property::where('id',$req->property_id)->update([
                                'status'=>'1',
                                'sale_amount'=>$sold_amount,
                                
                            ]);

                            if($req->sale_type=="Lease"){
                                $validator = Validator::make($req->all(),[
                                    'invoices_number'=>'required',
                        
                                ]);
                                if($validator->fails())
                                {
                                    return redirect()->back()->with('error_msg', $validator->errors()->first());
                                }
                                $add_invoice=false;
                                $price_per_invoice=$sold_amount/$req->invoices_number;
                                for($i=0;$i<$req->invoices_number;$i++){
                                    $add_invoice=invoices::create([
                                        'property_sold_id'=>$sold_property->id,
                                        'due_amount'=>$price_per_invoice,
                                    ]);
                                }
    
                                if($add_invoice){
                                    return redirect()->back()->with('success_msg', "Property Sold");
                                }else{
                                    return redirect()->back()->with('error_msg', "Property Sold But Unable to create Invoices");
                                }
    
                            }else{
                                // full payement
                                $add_invoice=invoices::create([
                                    'property_sold_id'=>$sold_property->id,
                                    'due_amount'=>$sold_amount,
                                ]);
                                if($add_invoice){
                                    return redirect()->back()->with('success_msg', "Property Sold");
                                }else{
                                    return redirect()->back()->with('error_msg', "Property Sold But Unable to create Invoices");
                                }
                            }
                        }else{
                            return redirect()->back()->with('error_msg', "Unable to Sale Property");
                        }
                        
                    }
                }
            }// buyer_id if
            else
            {
                // Buyer Already Exists

                $sold_amount=(int)$req->property_expense+((int)$req->property_expense*((int)$req->property_profit/100));
                $sold_amount=$sold_amount - (int)$req->property_sale_expense;


                $current_date=date("Y-m-d h:i:s");
                $sold_property=property_sold::create([
                    'property_id'=>$req->property_id, 
                    'buyer_id'=>$req->buyer_id, 
                    'sold_date'=>$current_date, 
                    'sold_amount'=>$sold_amount,  
                    'sold_type'=>$req->sale_type,
                ]);
                if($sold_property){
                    // changing status to 1 becuase status 1 is for sold properties
                    $mark_as_sold=property::where('id',$req->property_id)->update([
                        'status'=>'1',
                        'sale_amount'=>$sold_amount,
                    ]);

                    if($req->sale_type=="Lease"){
                        $validator = Validator::make($req->all(),[
                            'invoices_number'=>'required',
                
                        ]);
                        if($validator->fails())
                        {
                            return redirect()->back()->with('error_msg', $validator->errors()->first());
                        }
                        $add_invoice=false;
                        $price_per_invoice=$sold_amount/$req->invoices_number;
                        for($i=0;$i<$req->invoices_number;$i++){
                            $add_invoice=invoices::create([
                                'property_sold_id'=>$sold_property->id,
                                'due_amount'=>$price_per_invoice,
                            ]);
                        }
    
                        if($add_invoice){
                            return redirect()->back()->with('success_msg', "Property Sold");
                        }else{
                            return redirect()->back()->with('error_msg', "Property Sold But Unable to create Invoices");
                        }
    
                    }else{
                        // full payement
                        $add_invoice=invoices::create([
                            'property_sold_id'=>$sold_property->id,
                            'due_amount'=>$sold_amount,
                        ]);
                        if($add_invoice){
                            return redirect()->back()->with('success_msg', "Property Sold");
                        }else{
                            return redirect()->back()->with('error_msg', "Property Sold But Unable to create Invoices");
                        }
                    }
                }else{
                    return redirect()->back()->with('error_msg', "Unable to Sale Property");
                }
                
            }

        }
    }

    public function view_lease_properties()
    {
        $properties=property_sold::with('property','buyer')->where('sold_type','Lease')->get();
        return view('view_lease_properties',compact('properties'));
    }
    public function view_fullpayment_properties()
    {
        $properties=property_sold::with('property','buyer')->where('sold_type','Full Payment')->get();
        return view('view_fullpayment_properties',compact('properties'));
    }
    public function sold_property_detail($id)
    {
        $sold_property=property_sold::with('property','buyer','invoices')->where('id',$id)->first();
        return view('sold_property_detail',compact('sold_property'));
    }
    public function accept_payment($id,$amount,$sold_property_id)
    {
        $response=['error'=>true];
        $current_date=date('d-M-Y');
        $accept=invoices::where('id',$id)->update([
            'status'=>'1',
            'paid_date'=>$current_date,
            'received_amount'=>$amount,
        ]);

        if($accept){
            $sold_property=property_sold::where('id',$sold_property_id)->with('property')->first();
            $amount_recived=(float)$sold_property->amount_received+(float)$amount;

            $update_sold_property=property_sold::where('id',$sold_property_id)->update([
                'amount_received'=>$amount_recived,
            ]);

            $response['msg']="Payment Accepted";
            $response['type']="success";
            return response()->json($response);


        }else{
            $response['msg']="Unable to Accept Payment";
            $response['type']="error";
            return response()->json($response);
        }
    }

    public function add_investor()
    {
        return view('/add_investor');
    }

    public function submit_add_investor(Request $req)
    {
       
        $validator = Validator::make($req->all(),[
            'name'=>'required',
            'cnic'=>'required',
            'address'=>'required',
            'phone'=>'required'
        ]);
        if($validator->fails())
        {
            return redirect()->back()->with('error_msg', $validator->errors()->first());
        }else{
            $add_vendor=investors::create([
                'name'=>$req->name,
                'cnic'=>$req->cnic,
                'email'=>$req->email,
                'address'=>$req->address,
                'phone'=> $req->phone
            ]);

            if($add_vendor){
                return redirect()->back()->with('success_msg', "Investor Added Successfully");
            }else{
                return redirect()->back()->with('error_msg', "Unable to Add Investor");
            }
            
        }
    }
    public function view_investors()
    {   
        $investors=investors::get();
        return view('/view_investors',compact('investors'));
    }
    public function edit_investor($id)
    {   
        $investor=investors::where('id',$id)->first();
        return view('/edit_investor',compact('investor'));
    }
    public function submit_edit_investor(Request $req)
    {
       
        $validator = Validator::make($req->all(),[
            'id'=>'required',
            'name'=>'required',
            'cnic'=>'required',
            'address'=>'required',
            'phone'=>'required'
        ]);
        if($validator->fails())
        {
            return redirect()->back()->with('error_msg', $validator->errors()->first());
        }else{
            $update_vendor=investors::where('id',$req->id)->update([
                'name'=>$req->name,
                'cnic'=>$req->cnic,
                'email'=>$req->email,
                'address'=>$req->address,
                'phone'=> $req->phone
            ]);

            if($update_vendor){
                return redirect()->back()->with('success_msg', "Investor Updated Successfully");
            }else{
                return redirect()->back()->with('error_msg', "Unable to Update Investor");
            }
            
        }
    }
    public function investor_detail($id)
    {
        $investor=investors::with('investment')->where('id',$id)->first();
        // dd($investor);
        return view('investor_detail',compact('investor'));
    }
    public function delete_gallery($id)
    {
        $get_doc=property_gallery::where('id',$id)->first();
        $unlink_doc=Storage::delete($get_doc->property_image);
        if($unlink_doc){
            $get_doc->delete();
            if($get_doc){
                return response()->json([
                    'type' => 'success',
                    'msg'=> 'Gallery Image Deleted'
                ]);
            }else{
                return response()->json([
                    'type' => 'error',
                    'msg'=> 'Unable To Delete'
                ]);
            }
        }else{
            return response()->json([
                'type' => 'error',
                'msg'=> 'Gallery Image Not Found'
            ]);
        }
    }
    public function delete_doc($id)
    {
        $get_doc=property_docs::where('id',$id)->first();
        $unlink_doc=Storage::delete($get_doc->document);
        if($unlink_doc){
            $get_doc->delete();
            if($get_doc){
                return response()->json([
                    'type' => 'success',
                    'msg'=> 'Document Deleted'
                ]);
            }else{
                return response()->json([
                    'type' => 'error',
                    'msg'=> 'Unable To Delete'
                ]);
            }
        }else{
            return response()->json([
                'type' => 'error',
                'msg'=> 'Document Not Found'
            ]);
        }
    }
    public function delete_expense_doc($id)
    {
        $get_doc=expense_docs::where('id',$id)->first();
        $unlink_doc=Storage::delete($get_doc->document);
        if($unlink_doc){
            $get_doc->delete();
            if($get_doc){
                return response()->json([
                    'type' => 'success',
                    'msg'=> 'Document Deleted'
                ]);
            }else{
                return response()->json([
                    'type' => 'error',
                    'msg'=> 'Unable To Delete'
                ]);
            }
        }else{
            return response()->json([
                'type' => 'error',
                'msg'=> 'Document Not Found'
            ]);
        }
    }

    public function delete_service($id)
    {
        $service=service_type::where('id',$id)->first();
        try{
            $service->delete();
            if($service){
                return redirect()->back()->with('success_msg', "Service Deleted");
            }
        }catch(\Exception $ex){
            
            return redirect()->back()->with('error_msg', " This service is used by Vendors");
        }
        
    }
    public function delete_vendor($id)
    {
        $user=vendors::where('id',$id)->first();
        try{
            $user->delete();
            if($user){
                return redirect()->back()->with('success_msg', "Vendor Deleted");
            }
        }catch(\Exception $ex){
            
            return redirect()->back()->with('error_msg', " This Vendor is used in a Property Expense");
        }
        
    }
    public function delete_property($id)
    {
        $property=property::with('docs','gallery','expense.expense_docs')->where('id',$id)->first();
        // dd($property);
        foreach($property->gallery as $gallery){
            $unlink_doc=Storage::delete($gallery->property_image);
        }
        foreach($property->docs as $doc){
            $unlink_doc=Storage::delete($doc->document);
        }
        if(count($property->expense)>0){
            foreach($property->expense as $expense){
                foreach($expense->expense_docs as $doc){
                    $unlink_doc=Storage::delete($doc->document);
                }
            }
            
        }
        

        try{
            $property->delete();
            if($property){
                return redirect()->back()->with('success_msg', "Property Deleted");
            }
        }catch(\Exception $ex){
            
            return redirect()->back()->with('error_msg', " Something went wrong");
        }
        
    }
    public function delete_investor($id)
    {
        $investor=investors::where('id',$id)->first();
        try{
            $investor->delete();
            if($investor){
                return redirect()->back()->with('success_msg', "Investor Deleted");
            }
        }catch(\Exception $ex){
            
            return redirect()->back()->with('error_msg', " This Investor is used SomeWhere");
        }
        
    }
    public function delete_investment($id)
    {
        $investment=property_investment::where('id',$id)->first();
        try{
            $investment->delete();
            if($investment){
                return response()->json([
                    'type' => 'success',
                    'msg'=> 'Investment Deleted'
                ]);
            }
        }catch(\Exception $ex){
            return response()->json([
                'type' => 'error',
                'msg'=> 'This investment is used SomeWhere'
            ]);
        }
        
    }
}
