@extends('backend.layouts.app')
@section('names', 'Permission');
@section('content')
@include('backend.layouts.breadcrumb')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h4 class="card-title">All permissions</h4>
                <a class="text-danger" href="{{ route('heading.index') }}">Back<i style="font-size: 14px;" class="fa fa-arrow-right"></i></a>
            </div>
            @include('validation.table')
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table mb-0 data-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Create_at</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($all_trash as $trash)
                            <tr>
                                   <td>{{ $loop -> index + 1 }}</td>
                                   <td>{{ $trash -> pname }}</td>
                                   <td>{{ $trash -> slug }}</td>
                                   <td>{{ $trash -> created_at ->diffForHumans() }}</td>
                                   <td>
                                    @if($trash -> status)
                                       <span class="badge btn-success">Active</span>
                                       <a href="{{ route('permission.status', $trash -> id) }}"><i class="text-danger fa fa-times"></i></a> 
                                       @else
                                       <span class="badge btn-danger">Block</span>
                                       <a href="{{ route('permission.status', $trash -> id) }}"><i class="text-success fa fa-check"></i></a> 
                                    @endif
                                   </td>
                                   <td class="d-flex justify-content-between">
                                    <a href="{{ route('heading.trash.update', $trash -> id) }}"><button class="btn btn-sm btn-info"><span class="btn btn-sm btn-info badge badge-info">Restore!</span></button></i></a>
                                    <form action="{{ route('heading.destroy', $trash -> id) }}" method="POST">
                                       @csrf
                                       @method('DELETE')
                                       <button class="confirm-delete btn btn-sm btn-danger"><span class="badge badge-danger">Permanently Delete</span></button>
                                    </form>
                                   </td>
                            </tr>
                               @endforeach 
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection