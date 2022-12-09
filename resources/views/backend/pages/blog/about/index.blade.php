@extends('backend.layouts.app')
@section('names', 'About');
@section('content')
@include('backend.layouts.breadcrumb')
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h4 class="card-title">All About</h4>
                <a class="text-danger" href="{{ route('about.trash') }}">Trash Page <i style="font-size: 14px;" class="fa fa-arrow-right"></i></a>
            </div>
            @include('validation.table')
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table mb-0 data-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Photo</th>
                                <th>Create_at</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($all_about as $about)
                            <tr>
                                   <td>{{ $loop -> index + 1 }}</td>
                                   <td>
                                    <img style="width: 50px; height:50px;" src="{{ url('storage/about/'.$about -> photo) }}" alt="">
                                   </td>
                                   <td>{{ $about -> created_at ->diffForHumans() }}</td>
                                   <td>
                                    @if($about -> status)
                                       <span class="badge btn-success">Active</span>
                                       <a href="{{ route('about.status', $about -> id) }}"><i class="text-danger fa fa-times"></i></a> 
                                       @else
                                       <span class="badge btn-danger">Block</span>
                                       <a href="{{ route('about.status', $about -> id) }}"><i class="text-success fa fa-check"></i></a> 
                                    @endif
                                   </td>
                                   <td>
                                    <a class="btn btn-sm btn-warning" href="{{ route('about.edit', $about -> id) }}"><i class="fa fa-edit"></i></a>
                                    <a class="btn btn-sm btn-danger" href="{{ route('about.trash.update', $about -> id) }}"><i class="fa fa-trash"></i>
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
                <h4 class="card-title">Add About</h4>
            </div>

            @include('validation.form')
            <div class="card-body">
                <form action="{{ route('about.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Content</label>
                        <textarea name="dec" id="" cols="3" rows="3" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Name</label>
                        <img  style="max-width: 100%; max-height:100%; object-fit:cover" id="previews" src="" alt="">
                        <br>
                        <input id="photo_id" style="display: none;" name="photo" type="file" class="form-control"><br>
                        <label for="photo_id"><img style="width: 100px; height:100px;" src="{{ url('back-end/assets/img/slide1.png') }}" alt=""></label>
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
                <h4 class="card-title">Edit Permission</h4>
                <a class="primary" href="{{ route('about.index') }}">Back</a>
            </div>
           
            @include('validation.form')
            <div class="card-body">
                <form action="{{ route('about.update', $edit -> id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label>Content</label>
                        <textarea name="dec" id="" cols="3" rows="3" class="form-control">{{ $edit -> content }}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Name</label>
                        <img  style="max-width: 100%; max-height:100%; object-fit:cover" id="previews" src="{{ url('storage/about/'.$edit -> photo) }}" alt="">
                        <br>
                        <input name="old_photo" type="hidden" class="form-control"><br>
                        <input id="photo_id" name="new_photo" type="file" class="form-control"><br>
                        <label for="photo_id"><img style="width: 100px; height:100px;" src="{{ url('back-end/assets/img/slide1.png') }}" alt=""></label>
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