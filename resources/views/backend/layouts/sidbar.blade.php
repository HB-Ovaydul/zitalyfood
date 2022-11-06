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
							<li class="menu-title"> 
								<span>Admin Option</span>
							</li>
                            <li class="submenu">
								<a href="#"><i class="fe fe-document"></i> <span>Authentication</span> <span class="menu-arrow"></span></a>
								<ul style="display: none;">
									<li><a href="invoice-report.html">User</a></li>
									<li><a href="{{ route('permission.index') }}">Permission</a></li>
									<li><a href="{{ route('role.index') }}">Role</a></li>
								</ul>
							</li>
						</ul>
					</div>
                </div>
            </div>
			<!-- /Sidebar -->