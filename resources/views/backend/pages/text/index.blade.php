@extends('backend.layouts.app')
@section('names', 'Heading');
@section('content')
@include('backend.layouts.breadcrumb')
<div class="row">
    <div class="col-lg-9">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h4 class="card-title">All heading</h4>
                <a class="text-danger" href="{{ route('heading.trash') }}">Trash Page <i style="font-size: 14px;" class="fa fa-arrow-right"></i></a>
            </div>
            @include('validation.table')
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table mb-0 data-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Create_at</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($heading as $heade)
                            <tr>
                                   <td>{{ $loop -> index + 1 }}</td>
                                   <td>{{ $heade -> heading }}</td>
                                   <td>{{ $heade -> created_at ->diffForHumans() }}</td>
                                   <td>
                                    @if($heade -> status)
                                       <span class="badge btn-success">Active</span>
                                       <a href="{{ route('heading.status', $heade -> id) }}"><i class="text-danger fa fa-times"></i></a> 
                                       @else
                                       <span class="badge btn-danger">Block</span>
                                       <a href="{{ route('heading.status', $heade -> id) }}"><i class="text-success fa fa-check"></i></a> 
                                    @endif
                                   </td>
                                   <td>
                                    <a class="btn btn-sm btn-warning" href="{{ route('heading.edit', $heade -> id) }}"><i class="fa fa-edit"></i></a>
                                    <a class="btn btn-sm btn-danger" href="{{ route('heading.trash.update', $heade -> id) }}"><i class="fa fa-trash"></i>
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
    <div class="col-xl-3 d-flex">
        <div class="card flex-fill">
            <div class="card-header">
                <h4 class="card-title">Add Heading</h4>
            </div>

            @include('validation.form')
            <div class="card-body">
                <form action="{{ route('heading.store') }}" method="POST">
                    @csrf
                    <div class="form-group row">
                        <label>Title</label>
                        <input name="title" type="text" class="form-control">
                    </div>
                    <div class="form-group row">
                        <label>Decription</label>
                        <textarea name="dec" id="" cols="5" rows="3" class="form-control"></textarea>
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
    <div class="col-xl-3 d-flex">
        <div class="card flex-fill">
            <div class="card-header d-flex justify-content-between">
                <h4 class="card-title">Edit Heading</h4>
                <a class="primary" href="{{ route('heading.index') }}">Back</a>
            </div>
           
            @include('validation.form')
            <div class="card-body">
                <form action="{{ route('heading.update', $edit -> id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group row">
                        <label>Title</label>
                        <input name="title" type="text" value="{{ $edit -> heading }}" class="form-control">
                    </div>
                    <div class="form-group row">
                        <label>Decription</label>
                        <textarea name="dec" id="" cols="5" rows="3" class="form-control">{{ $edit -> subheading }}</textarea>
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