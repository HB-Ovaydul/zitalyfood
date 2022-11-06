@extends('backend.layouts.app')
@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h4 class="card-title">All Roles</h4>
                <a class="text-danger" href="{{ route('role.trash') }}">Trash Page <i style="font-size: 14px;" class="fa fa-arrow-right"></i></a>
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
                                <th>Permission</th>
                                <th>Create_at</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($all_role as $role)
                            <tr>
                                <td>{{ $loop -> index +1 }}</td>
                                <td>{{ $role -> rname }}</td>
                                <td>{{ $role -> slug }}</td>
                                <td>
                                    <ul class="ui-table">
                                    @forelse (json_decode($role -> permission) as $permissions)
                                        <li><i class="fa fa-angle-right"></i> {{ $permissions }}</li>
                                    @empty
                                        No Permission
                                    @endforelse
                                    </ul>
                                </td>
                                <td>{{ $role -> created_at -> diffForhumans() }}</td>
                                <td>
                                    @if($role -> status)
                                       <span class="badge btn-success">Active</span>
                                       <a href="{{ route('role.status', $role -> id) }}"><i class="text-danger fa fa-times"></i></a> 
                                       @else
                                       <span class="badge btn-danger">Block</span>
                                       <a href="{{ route('role.status', $role -> id) }}"><i class="text-success fa fa-check"></i></a> 
                                    @endif
                                   </td>
                                   <td>
                                    <a class="btn btn-sm btn-warning" href="{{ route('role.edit', $role -> id) }}"><i class="fa fa-edit"></i></a>
                                    <a class="btn btn-sm btn-danger" href="{{ route('role.trash.update', $role -> id) }}"><i class="fa fa-trash"></i>
                                   </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @if ($form_type == 'create')
    <div class="col-xl-4 d-flex">
        <div class="card flex-fill">
            <div class="card-header">
                <h4 class="card-title">Add Role</h4>
            </div>

            @include('validation.form-validation')
            <div class="card-body">
                <form action="{{ route('role.store') }}" method="POST">
                    @csrf
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Name</label>
                        <div class="col-lg-9">
                            <input name="name" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <ul class="ui-form">
                            @forelse ($get_permission as $permission)
                            <li><input name="permission[]" type="checkbox" value="{{ $permission -> pname }}"> {{ $permission -> pname }}</li>
                            @empty
                                No Permission
                            @endforelse
                        </ul>
                    </div>

                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>  
        </div>
    </div>
    @endif
    
    {{-- Edit Form --}}
    @if ($form_type == 'edit')
    <div class="col-xl-4 d-flex">
        <div class="card flex-fill">
            <div class="card-header justify content between">
                <h4 class="card-title">Edit Role</h4>
                <a class="primary" href="{{ route('role.index') }}">Back</a>

            </div>
           
            @include('validation.form-validation')
            <div class="card-body">
                <form action="{{ route('role.update', $role_edit -> id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Name</label>
                        <div class="col-lg-9">
                            <input name="name" type="text" value="{{ $role_edit -> rname }}" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <ul class="ui-form">
                            @forelse (json_decode($get_permission) as $permission)
                            <li><input name="permission[]" type="checkbox" value="{{ $permission -> pname }}" @if(in_array($permission -> pname, json_decode($role_edit -> permission))) checked @endif> {{ $permission -> pname }}</li>
                            @empty
                                No Permission
                            @endforelse
                        </ul>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>  
        </div>
    </div>
    @endif
  
</div>

@endsection