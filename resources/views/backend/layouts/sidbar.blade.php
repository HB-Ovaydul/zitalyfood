			<!-- Sidebar -->
            <div class="sidebar" id="sidebar">
                <div class="sidebar-inner slimscroll">
					<div id="sidebar-menu" class="sidebar-menu">
						<ul>
							<li class="menu-title"> 
								<span>Main</span>
							</li>
							<li class="active"> 
								<a href="{{ route('dashboard.index') }}"><i class="fe fe-home"></i> <span>Dashboard</span></a>
							</li>
							@if ( in_array('Slider', json_decode(Auth::guard('admin')->user()->admin_role->permission)))
							<li>
								<a href="{{ route('slider.index') }}"><i class="fe fe-document"></i> Slider</a>
							</li>
							@endif
							@if ( in_array('Heading', json_decode(Auth::guard('admin')->user()->admin_role->permission)))
							<li>
								<a href="{{ route('heading.index') }}"><i class="fe fe-document"></i> Heading</a>
							</li>
							@endif
							@if ( in_array('Staff', json_decode(Auth::guard('admin')->user()->admin_role->permission)))
							<li>
								<a href="#"><i class="fe fe-document"></i> Staff</a>
							</li>
							@endif
							@if (in_array('Reservation', json_decode(Auth::guard('admin')->user()->admin_role->permission)))
							<li>
								<a href="#"><i class="fe fe-document"></i> Reservation</a>
							</li>
							
							@endif
							@if (in_array('Gallery', json_decode(Auth::guard('admin')->user()->admin_role->permission)))
							<li>
								<a href="#"><i class="fe fe-document"></i> Gallery</a>
							</li>
							@endif
							
							@if (in_array('Blog', json_decode(Auth::guard('admin')->user()->admin_role->permission)))
								<li class="submenu">
									<a href="#"><i class="fe fe-document"></i> <span>Blog</span> <span class="menu-arrow"></span></a>
								
									<ul style="display: none;">
										<li><a href="{{ route('post.index') }}">Post</a></li>
										<li><a href="{{ route('tag.index') }}">Tag</a></li>
										<li><a href="{{ route('about.index') }}">About</a></li>
									</ul>
								</li>
							@endif
							@if (in_array('User', json_decode(Auth::guard('admin')->user()->admin_role->permission)))	
							<li class="menu-title"> 
								<span>Admin Option</span>
							</li>
                            <li class="submenu">
								<a href="#"><i class="fe fe-document"></i> <span>Authentication</span> <span class="menu-arrow"></span></a>
								<ul style="display: none;">
									<li><a href="{{ route('user.index') }}">User</a></li>
									<li><a href="{{ route('permission.index') }}">Permission</a></li>
									<li><a href="{{ route('role.index') }}">Role</a></li>
								</ul>
							</li>
							@endif
						</ul>
					</div>
                </div>
            </div>
			<!-- /Sidebar -->