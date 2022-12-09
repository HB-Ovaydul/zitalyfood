@extends('backend.layouts.app')
@section('names', 'Post');
@section('content')
@include('backend.layouts.breadcrumb')
<div class="row">
    <div class="col-lg-9">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h4 class="card-title">All Post</h4>
                <a class="text-danger" href="{{ route('post.trash') }}">Trash Page <i style="font-size: 14px;" class="fa fa-arrow-right"></i></a>
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
                            @foreach ($all_post as $post)
                            <tr>
                                   <td>{{ $loop -> index + 1 }}</td>
                                   <td>{{ $post -> title }}</td>
                                   <td>{{ $post -> slug }}</td>
                                   <td>{{ $post -> created_at ->diffForHumans() }}</td>
                                   <td>
                                    @if($post -> status)
                                       <span class="badge btn-success">Active</span>
                                       <a href="{{ route('post.status', $post -> id) }}"><i class="text-danger fa fa-times"></i></a> 
                                       @else
                                       <span class="badge btn-danger">Block</span>
                                       <a href="{{ route('post.status', $post -> id) }}"><i class="text-success fa fa-check"></i></a> 
                                    @endif
                                   </td>
                                   <td>
                                    <a class="btn btn-sm btn-warning" href="{{ route('post.edit', $post -> id) }}"><i class="fa fa-edit"></i></a>
                                    <a class="btn btn-sm btn-danger" href="{{ route('post.trash.update', $post -> id) }}"><i class="fa fa-trash"></i>
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
                <h4 class="card-title">Add Post</h4>
            </div>

            @include('validation.form')
            <div class="card-body">
                <form action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Title</label>
                        <input name="title" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Content</label>
                        <textarea name="content" id="editor" cols="10" rows="5"></textarea>
                    </div>
                    <div class="form-group mb-0">
                        <label>Feature Image</label><br>
                        <img style="max-width: 100%; max-height:100%;" id="previews" src="" alt="">
                        <input id="photo_id" style="display: none;" name="feature" type="file" class="form-control">
                        <label for="photo_id"><img style="width: 80px; height:80px" src="{{ url('back-end/assets/img/slide1.png') }}" alt=""></label>
                    </div>
                    <div class="form-group">
                        <div class="gallery">
                            
                        </div><br>
                        <label>Gallery</label><br>
                        <input style="display: none;" id="gall_id" multiple name="gallery[]" type="file" class="form-control">
                      <label for="gall_id"><img style="width: 80px; height:80px" src="{{ url('back-end/assets/img/gallery.png') }}" alt=""></label>
                    </div>
                    <div class="form-group">
                        <label>Tag</label>
                        <select class="form-control ztfood"  name="tag[]" multiple id="">
                            @foreach ($tag as $item)
                            <option value="{{ $item -> id }}">{{ $item -> tname }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Price</label>
                        <input name="price" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Quote</label>
                        <input name="quote" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Heading-1</label>
                        <textarea class="form-control" name="head1" id="" cols="3" rows="2"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Heading-2</label>
                        <textarea class="form-control" name="head2" id="" cols="3" rows="2"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Heading-3</label>
                        <textarea class="form-control" name="head3" id="" cols="3" rows="2"></textarea>
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
                <h4 class="card-title">Edit Post</h4>
                <a class="primary" href="{{ route('post.index') }}">Back</a>
            </div>
           
            @include('validation.form')
            <div class="card-body">
                <form action="{{ route('post.update', $edit -> id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label>Title</label>
                        <input name="title" type="text" value="{{ $edit -> title }}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Content</label>
                        <textarea name="content" id="editor" cols="10" rows="5">{{ $edit -> content }}</textarea>
                    </div>
                    <div class="form-group mb-0">
                        <label>Feature Image</label><br>
                        <img style="max-width: 100%; max-height:100%;" id="previews" src="{{ url('storage/post_feature/'. $edit -> feature) }}" alt="">
                        <input name="old_feature" type="hidden" class="form-control">
                        <input id="photo_id" style="display: none;" name="new_feature" type="file" class="form-control">
                        <label for="photo_id"><img style="width: 80px; height:80px" src="{{ url('back-end/assets/img/slide1.png') }}" alt=""></label>
                    </div>
                    <div class="form-group">
                        <div class="gallery">
                            @foreach (json_decode($edit -> gallery) as $edit_item)
                                <img src="{{ url('storage/gell_image/'. $edit_item) }}" alt="">
                            @endforeach
                        </div><br>
                        <label>Gallery</label><br>
                        <input style="display: none;" id="gall_id" multiple name="gallery[]" type="file" class="form-control">
                      <label for="gall_id"><img style="width: 80px; height:80px" src="{{ url('back-end/assets/img/gallery.png') }}" alt=""></label>
                    </div>
                    <div class="form-group">
                        <label>Tag</label>
                        <select class="form-control ztfood"  name="tag[]" multiple id="">
                            @foreach (json_decode($edit -> tags) as $edit_tag)
                               @php
                                   $data[] = $edit_tag -> id;
                                   $data;
                               @endphp 
                            @endforeach
                            @foreach ($tag_post as $e_item)
                            <option  value="{{ $e_item -> id }}" {{ in_array($e_item -> id, $data) ? 'selected' : '' }}>{{ $e_item -> tname }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Price</label>
                        <input name="price" type="text" value="{{ $edit -> price }}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Quote</label>
                        <input name="quote" type="text" value="{{ $edit -> quote }}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Heading-1</label>
                        <textarea class="form-control" name="head1" id="" cols="3" rows="2">{{ $edit -> head1 }}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Heading-2</label>
                        <textarea class="form-control" name="head2" id="" cols="3" rows="2">{{ $edit -> head2 }}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Heading-3</label>
                        <textarea class="form-control" name="head3" id="" cols="3" rows="2">{{ $edit -> head3 }}</textarea>
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