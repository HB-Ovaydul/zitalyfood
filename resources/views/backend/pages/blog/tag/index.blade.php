@extends('backend.layouts.app')
@section('names', 'Tag');
@section('content')
@include('backend.layouts.breadcrumb')
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h4 class="card-title">All Tag</h4>
                <a class="text-danger" href="{{ route('tag.trash') }}">Trash Page <i style="font-size: 14px;" class="fa fa-arrow-right"></i></a>
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
                            @foreach ($all_tag as $tag)
                            <tr>
                                   <td>{{ $loop -> index + 1 }}</td>
                                   <td>{{ $tag -> tname }}</td>
                                   <td>{{ $tag -> slug }}</td>
                                   <td>{{ $tag -> created_at ->diffForHumans() }}</td>
                                   <td>
                                    @if($tag -> status)
                                       <span class="badge btn-success">Active</span>
                                       <a href="{{ route('tag.status', $tag -> id) }}"><i class="text-danger fa fa-times"></i></a> 
                                       @else
                                       <span class="badge btn-danger">Block</span>
                                       <a href="{{ route('tag.status', $tag -> id) }}"><i class="text-success fa fa-check"></i></a> 
                                    @endif
                                   </td>
                                   <td>
                                    <a class="btn btn-sm btn-warning" href="{{ route('tag.edit', $tag -> id) }}"><i class="fa fa-edit"></i></a>
                                    <a class="btn btn-sm btn-danger" href="{{ route('tag.trash.update', $tag -> id) }}"><i class="fa fa-trash"></i>
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
                <h4 class="card-title">Add Tag</h4>
            </div>

            @include('validation.form')
            <div class="card-body">
                <form action="{{ route('tag.store') }}" method="POST">
                    @csrf
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Name</label>
                        <div class="col-lg-9">
                            <input name="tname" type="text" class="form-control">
                        </div>
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
                <h4 class="card-title">Edit Tag</h4>
                <a class="primary" href="{{ route('tag.index') }}">Back</a>
            </div>
           
            @include('validation.form')
            <div class="card-body">
                <form action="{{ route('tag.update', $edit -> id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Name</label>
                        <div class="col-lg-9">
                            <input name="tname" type="text" value="{{ $edit -> tname }}" class="form-control">
                        </div>
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