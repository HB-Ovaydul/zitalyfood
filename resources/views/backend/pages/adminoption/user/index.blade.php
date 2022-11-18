@extends('backend.layouts.app')
@section('names', 'User')
@section('content')
@include('backend.layouts.breadcrumb')
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h4 class="card-title">All Users</h4>
                <a class="text-danger" href="{{ route('user.trash') }}">Trash Page <i style="font-size: 14px;" class="fa fa-arrow-right"></i></a>
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
                                <th>Photo</th>
                                <th>Create_at</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($admins as $admin)
                            <tr>
                                    <td>{{ $loop -> index + 1 }}</td>
                                    <td>{{ $admin -> name }}</td>
                                    <td>{{ $admin -> email }}</td>
                                    <td>
                                        @if (isset($admin -> admin_role -> rname))
                                            {{ $admin -> admin_role -> rname }}
                                        @else
                                               No Roles
                                        @endif
                                    </td>
                                    <td>
                                        @if ($admin -> photo == 'avater.png')
                                        <img style="width: 50px; height: 50px; object-fit: cover;" src="https://www.genocideresearchhub.org.rw/wp-content/uploads/2021/12/1024px-User-avatar.svg_.png'" alt="">
                                        @else
                                        <img style="width: 50px; height: 50px; object-fit: cover;" src="{{ url('storage/admin/'. $admin -> photo) }}" alt="">
                                        @endif
                                    </td>
                                    <td>{{ $admin -> created_at -> DiffForHumans()}}</td>
                                    <td>
                                        @if($admin -> status)
                                           <span class="badge btn-success">Active</span>
                                           <a href="{{ route('user.status', $admin -> id) }}"><i class="text-danger fa fa-times"></i></a> 
                                           @else
                                           <span class="badge btn-danger">Block</span>
                                           <a href="{{ route('user.status', $admin -> id) }}"><i class="text-success fa fa-check"></i></a> 
                                        @endif
                                       </td>
                                       <td>
                                        <a class="btn btn-sm btn-warning" href="{{ route('user.edit', $admin -> id) }}"><i class="fa fa-edit"></i></a>
                                        <a class="btn btn-sm btn-danger" href="{{ route('user.trash.update', $admin -> id) }}"><i class="fa fa-trash"></i>
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
                <h4 class="card-title">Create Account</h4>
            </div>
            @include('validation.form')
            <div class="card-body">
                <form action="{{ route('user.store') }}" method="POST">
                    @csrf
                    <div class="form-group row">
                        <div class="col-6">
                            <label for="">Name</label>
                            <input name="name" type="text" class="form-control">
                        </div>
                        <div class="col-6">
                            <label for="">UserName</label>
                            <input name="username" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Eamil</label>
                        <input name="email" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Phone</label>
                        <input name="phone" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Select Role</label>
                        <select class="form-control" name="role_id" id="">
                            <option value="">-Select-</option>
                            @foreach ($role_id as $role)
                            <option value="{{ $role -> id }}">{{ $role -> rname }}</option>
                            @endforeach
                        </select>
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
            <div class="card-header d-flex justify-content-between">
                <h4 class="card-title">Edit User</h4>
                <a class="primary" href="{{ route('user.index') }}">Back</a>
            </div>
           
            @include('validation.form')
            <div class="card-body">
                <form action="{{ route('user.update', $edit_user -> id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group row">
                        <div class="col-6">
                            <label for="">Name</label>
                            <input name="name" type="text" value="{{ $edit_user -> name }}" class="form-control">
                        </div>
                        <div class="col-6">
                            <label for="">UserName</label>
                            <input name="username" type="text" value="{{ $edit_user -> username }}" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Eamil</label>
                        <input name="email" type="text" value="{{ $edit_user -> email }}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Phone</label>
                        <input name="phone" type="text" value="{{ $edit_user -> cell }}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Select Role</label>
                        {{-- <select class="form-control" name="role_id" id="">
                            @foreach ($role_id as $user)
                            <option value="{{ $user -> id }}" {{ @if($role_id -> id) ? 'selected' : '' @endif }}>{{ $user -> rname }}</option>
                            @endforeach
                        </select> --}}
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