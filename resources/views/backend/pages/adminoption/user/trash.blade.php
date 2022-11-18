@extends('backend.layouts.app')
@section('names', 'User')
@section('content')
@include('backend.layouts.breadcrumb')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h4 class="card-title">All User</h4>
                <a class="text-danger" href="{{ route('user.index') }}">Back<i style="font-size: 14px;" class="fa fa-arrow-right"></i></a>
            </div>
            @include('validation.table')
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table mb-0 data-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Create_at</th>
                                <th>Photo</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($all_trash as $trash)
                            <tr>
                                <td>{{ $loop -> index + 1 }}</td>
                                <td>{{ $trash -> name }}</td>
                                <td>{{ $trash -> email }}</td>
                                <td>
                                    @if (isset($trash -> admin_role -> rname))
                                        {{ $trash -> admin_role -> rname }}
                                    @else
                                           No Roles
                                    @endif
                                </td>
                                <td>{{ $trash -> photo }}</td>
                                <td>{{ $trash -> created_at -> DiffForHumans()}}</td>
                                <td>
                                    @if($trash -> status)
                                       <span class="badge btn-success">Active</span>
                                       <a href="{{ route('user.status', $trash -> id) }}"><i class="text-danger fa fa-times"></i></a> 
                                       @else
                                       <span class="badge btn-danger">Block</span>
                                       <a href="{{ route('user.status', $trash -> id) }}"><i class="text-success fa fa-check"></i></a> 
                                    @endif
                                   </td>
                                   <td class="d-flex justify-content-between">
                                    <a href="{{ route('user.trash.update', $trash -> id) }}"><button class="btn btn-sm btn-info"><span class="btn btn-sm btn-info badge badge-info">Restore!</span></button></i></a>
                                    <form action="{{ route('user.destroy', $trash -> id) }}" method="POST">
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