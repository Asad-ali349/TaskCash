@extends('layouts.master')

@section('styling')
<link href="{{ asset('public/assets/plugins/bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css') }}" rel="stylesheet" />
@endsection

@section('content')
@section('header', 'All Businesses')
@if(session('success')) <h3 class="alert alert-success">{{ session('success') }}</h3> @endif
<div class="container">
        <div class="row">
            <div class="col-sm-12 ">
                <div class="card m-b-30">
                    <div class="card-body">
                        
                    {{-- TAbles --}}
                    <div id="datatable_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                            <table id="datatable" class="table table-bordered table-hover table-striped dataTable no-footer" role="grid" aria-describedby="datatable_info">
                                <thead>
                                    <tr>
                                        <th>No.s</th>
                                        <th>Business Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody class="text-center">
                                    @foreach($buss as $bus)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $bus->name }}</td>
                                        <td>{{ $bus->email }}</td>
                                        <td>{{ $bus->phone }}</td>
                                        <td>
                                            <input type="checkbox" id="switch+{{ $loop->iteration }}" class="switch"  switch="none" data-id="{{ $bus->id }}"  @if($bus->status == 1) checked @endif/>
                                                <label for="switch+{{ $loop->iteration }}" data-on-label="On"
                                                       data-off-label="Off"></label>
                                        </td>
                                        <form action="{{ route('business.edit', $bus->id) }}" method="post" onsubmit="return confirm('Are you Sure To Delete this?')">
                                            @csrf @method('DELETE')
                                        <td>
                                            <a href="{{ route('business.detail', $bus->id) }}" class="btn btn-info btn-sm">Detail</a>
                                        </td>
                                        </form>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div> <!-- end col -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="{{ asset('public/assets/plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js') }}" type="text/javascript"></script>
<script>
    $(function(){
       $('.switch').change(function(){
       {
           var id = $(this).data('id')
           console.log(id)
           var url = "{{ route('business.status.change', 'id') }}"
           url = url.replace('id', id)
           $.post(url).then(result => {
               alert('Business status Changed!');
           })
       }
        
    })
})
    

</script>

@endpush