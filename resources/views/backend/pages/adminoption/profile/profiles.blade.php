@extends('backend.layouts.app')
@section('names', 'Profile')
@section('content')
@include('backend.layouts.breadcrumb')
<div class="row">
    <div class="col-md-12">
        <div class="profile-header">
            <div class="row align-items-center">
                <div class="col-auto profile-image">
                    <a href="#">
                        <img style="object-fit: cover;" class="rounded-circle back-porf2" alt="User Image" src="{{ url('storage/admin/'.Auth::guard('admin')->user()->photo) }}">
                    </a>
                </div>
                <div class="col ml-md-n2 profile-user-info">
                    <h4 class="user-name mb-0">{{ Auth::guard('admin')->user()->name }}</h4>
                    <h6 class="text-muted">{{ Auth::guard('admin')->user()->email }}</h6>
                    <div class="user-Location"><i class="fa fa-map-marker"></i> {{ Auth::guard('admin')->user()->location }}, {{ Auth::guard('admin')->user()->adderss }}</div>
                    <div class="about-text">{{ Auth::guard('admin')->user()->bio }}</div>
                </div>
                <div class="col-auto profile-btn">
                    
                    <a href="#" class="btn btn-primary">
                        Edit
                    </a>
                </div>
            </div>
        </div>
        <div class="profile-menu">
            <ul class="nav nav-tabs nav-tabs-solid">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#per_details_tab">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#password_tab">Password</a>
                </li>
            </ul>
        </div>	
        <div class="tab-content profile-tab-cont">
            
            <!-- Personal Details Tab -->
            <div class="tab-pane fade show active" id="per_details_tab">
            
                <!-- Personal Details -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title d-flex justify-content-between">
                                    <span>Personal Details</span> 
                                    <a class="edit-link" data-toggle="modal" href="#edit_personal_details"><i class="fa fa-edit mr-1"></i>Edit</a>
                                </h5>
                                {{-- {{ route('admin.edit.profile', Auth::guard('admin')->user()->id) }} --}}
                                <div class="row">
                                    <p class="col-sm-2 text-muted text-sm-right mb-0 mb-sm-3">Name</p>
                                    <p class="col-sm-10">{{ Auth::guard('admin')->user()->name }}</p>
                                </div>
                                <div class="row">
                                    <p class="col-sm-2 text-muted text-sm-right mb-0 mb-sm-3">Date of Birth</p>
                                    <p class="col-sm-10">{{ Auth::guard('admin')->user()->dob }}</p>
                                </div>
                                <div class="row">
                                    <p class="col-sm-2 text-muted text-sm-right mb-0 mb-sm-3">Email ID</p>
                                    <p class="col-sm-10">{{ Auth::guard('admin')->user()->email }}</p>
                                </div>
                                <div class="row">
                                    <p class="col-sm-2 text-muted text-sm-right mb-0 mb-sm-3">Mobile</p>
                                    <p class="col-sm-10">{{ Auth::guard('admin')->user()->cell }}</p>
                                </div>
                                <div class="row">
                                    <p class="col-sm-2 text-muted text-sm-right mb-0">Address</p>
                                    <p class="col-sm-10 mb-0">{{ Auth::guard('admin')->user()->location }},<br>
                                    {{ Auth::guard('admin')->user()->adderss }}.</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Edit Details Modal -->
                        <div class="modal fade" id="edit_personal_details" aria-hidden="true" role="dialog">
                            <div class="modal-dialog modal-dialog-centered" role="document" >
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Personal Details</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('admin.update.profile', Auth::guard('admin')->user()->id) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            {{-- @method('PUT') --}}
                                            <div class="row form-row">
                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group">
                                                        <label>Name</label>
                                                        <input name="name" type="text" class="form-control" value="{{ Auth::guard('admin')->user()->name }}">
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group">
                                                        <label>UserName</label>
                                                        <input name="username" type="text"  class="form-control" value="{{ Auth::guard('admin')->user()->username }}">
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label>Date of Birth</label>
                                                        <div class="cal-icon">
                                                            <input name="dath_of_birth" type="text" class="form-control" value="{{ Auth::guard('admin')->user()->dob }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label>About</label>
                                                        <textarea name="about" id="" cols="5" rows="3" class="form-control">{{ Auth::guard('admin')->user()->bio }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group">
                                                        <label>Email ID</label>
                                                        <input name="email" type="text" class="form-control" value="{{ Auth::guard('admin')->user()->email }}">
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group">
                                                        <label>Mobile</label>
                                                        <input name="phone" type="text" value="{{ Auth::guard('admin')->user()->cell }}" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <h5 class="form-title"><span>Address</span></h5>
                                                </div>
                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group">
                                                    <label>Address</label>
                                                        <input name="address" type="text" class="form-control" value="{{ Auth::guard('admin')->user()->address }}">
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group">
                                                        <label>City</label>
                                                        <input name="city" type="text" class="form-control" value="{{ Auth::guard('admin')->user()->location }}">
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <br>
                                                        <img style="max-width: 100%;max-height:100%;" id="preview" src="" alt="">
                                                        <br>
                                                        <input id="photos" style="display: none;" name="photo" type="file" class="form-control">
                                                        <label for="photos"><img style="width: 80px; height:80px" src="{{ url('back-end/assets/img/slide1.png') }}" alt=""></label>
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary btn-block">Save Changes</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /Edit Details Modal -->
                        
                    </div>

                
                </div>
                <!-- /Personal Details -->

            </div>
            <!-- /Personal Details Tab -->
            
            <!-- Change Password Tab -->
            @include('backend.pages.adminoption.profile.password')
            <!-- /Change Password Tab -->
            
        </div>
    </div>
</div>
@endsection


