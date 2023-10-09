@extends('layouts.master')

@section('styling')
<link href="{{ asset('public/assets/plugins/bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css') }}" rel="stylesheet" />
@endsection

@section('content')
@section('header', 'Pending Tasks')
@if(session('success')) <h3 class="alert alert-success">{{ session('success') }}</h3> @endif
<div class="container">
        <div class="row">
            <div class="col-sm-12 ">
                <div class="card m-b-30">
                    <div class="card-body">
                        
                    {{-- TAbles --}}
                    <h5 class="card-title ml-5 text-success">UnApproved Tasks</h5>
                    <div id="datatable_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                        <table id="datatable-buttons" class="table table-bordered table-hover table-striped dataTable no-footer" role="grid" aria-describedby="datatable_info">
                            <thead>
                                <tr>
                                    <th>No.s</th>
                                    <th>Business Name</th>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Activities</th>
                                    <th>Status</th>
                                    <th>Till</th>
                                    <th>Created At</th>
                                </tr>
                                </thead>
                                <tbody class="text-center">
                                    @foreach($tasks as $task)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $task->business->name }}</td>
                                        <td><a href="{{ route('task.detail', $task->id) }}">{{ $task->title }}</a></td>
                                        <td>{{ $task->category->name }}</td>
                                        <td> 
                                            @foreach($task->activities as $key=>$act)
                                                <span>{{ $act->act->name }} |</span>
                                            @endforeach
                                        </td>
                                        <td>
                                            <input type="checkbox" id="switch+{{ $loop->iteration }}" class="switch"  switch="none" data-id="{{ $task->id }}"  @if($task->status == 1) checked @endif/>
                                                <label for="switch+{{ $loop->iteration }}" data-on-label="Approved"
                                                       data-off-label="UnApproved"></label>
                                        </td>
                                        <td>{{ $task->till->format('M') }} {{ $task->till->format('d') }}, {{ $task->till->format('Y') }}.</td>
                                        <td>{{ $task->created_at->diffForHumans() }}</td>
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
            var url = "{{ route('task.approve', 'id') }}"
            url = url.replace('id', id)
            $.post(url).then(result => {
                alert('Task status Changed!');
            })
        }
    })
})
    

</script>

@endpush