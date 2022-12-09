@extends('backend.layouts.app')
@section('names', 'Home');
@section('content')
@include('backend.layouts.breadcrumb')
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h4 class="card-title">All Slider</h4>
                <a class="text-danger" href="{{ route('slider.trash') }}">Trash Page <i style="font-size: 14px;" class="fa fa-arrow-right"></i></a>
            </div>
            @include('validation.table')
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table mb-0 data-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Photo</th>
                                <th>Create_at</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sliders as $slider)
                                <tr>
                                    <td>{{ $loop -> index +1 }}</td>
                                    <td>{{ $slider -> title }}</td>
                                    <td>
                                        <img style="width: 50px; height:50px;" src="{{ url('storage/slider/'.$slider -> photo) }}" alt="">
                                    </td>
                                    <td>{{ $slider -> created_at -> diffForHumans() }}</td>
                                    <td>
                                        @if($slider -> status)
                                           <span class="badge btn-success">Active</span>
                                           <a href="{{ route('slider.status', $slider -> id) }}"><i class="text-danger fa fa-times"></i></a> 
                                           @else
                                           <span class="badge btn-danger">Block</span>
                                           <a href="{{ route('slider.status', $slider -> id) }}"><i class="text-success fa fa-check"></i></a> 
                                        @endif
                                       </td>
                                       <td>
                                        <a class="btn btn-sm btn-warning" href="{{ route('slider.edit', $slider -> id) }}"><i class="fa fa-edit"></i></a>
                                        <a class="btn btn-sm btn-danger" href="{{ route('slider.trash.update', $slider -> id) }}"><i class="fa fa-trash"></i>
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
                <h4 class="card-title">Add Slider</h4>
            </div>

            @include('validation.form')
            <div class="card-body">
                <form action="{{ route('slider.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Title</label>
                        <input name="title" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Secription</label>
                        <textarea class="form-control" name="dec" id="" cols="10" rows="5"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Photo</label><br>
                        <img  style="max-width: 100%; max-height:100%; object-fit:cover" id="previews" src="" alt="">
                        <br>
                        <input style="display: none;" id="photo_id" name="photo" type="file">
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
                <h4 class="card-title">Edit Slider</h4>
                <a class="primary" href="{{ route('permission.index') }}">Back</a>
            </div>
           
            @include('validation.form')
            <div class="card-body">
                <form action="{{ route('slider.update', $edit -> id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label>Title</label>
                        <input name="title" type="text" value="{{ $edit -> title }}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Secription</label>
                        <textarea class="form-control" name="dec" id="" cols="10" rows="5">{{ $edit -> subtitle }}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Photo</label><br>
                        <input name="old_photo" type="hidden" class="form_control">
                        <input style="display: none;" id="photo_id" name="new_photo" type="file" class="form_control">
                        <img style="max-width: 100%; max-height:100%; object-fit:cover" id="previews" src="{{ url('storage/slider/'.$edit -> photo) }}" alt="">
                        <br>
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