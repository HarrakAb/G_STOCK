<!-- main-header opened -->
			<div class="main-header sticky side-header nav nav-item">
				<div class="container-fluid">
					<div class="main-header-left ">
						
						<div class="app-sidebar__toggle" data-toggle="sidebar">
							<a class="open-toggle" href="#"><i class="header-icon fe fe-align-left" ></i></a>
							<a class="close-toggle" href="#"><i class="header-icons fe fe-x"></i></a>
						</div>
					</div>
					<div class="main-header-right">					
						<div class="nav nav-item  navbar-nav-right ml-auto">
							<div class="dropdown nav-item main-header-notification">

									<a class="new nav-link" href="#">
										<svg xmlns="http://www.w3.org/2000/svg" class="header-icon-svgs" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>
										@foreach(auth()->user()->unreadNotifications as $notification)
											@if (auth()->user()->unreadNotifications && $notification->type =='App\Notifications\CheckStock')
												<span class=" pulse-danger"></span>										
											@endif
										@endforeach
									</a>

								<div class="dropdown-menu">
									<div class="menu-header-content bg-primary text-right">
										<div class="d-flex">
											<h6 class="dropdown-title mb-1 tx-15 text-white font-weight-semibold">Notifications</h6>
											<span class="badge badge-pill badge-warning mr-auto my-auto float-left"><a href="\MarkAsRead_all">Marqué Comme Lu</a></span>
										</div>
										<p class="dropdown-title-text subtext mb-0 text-white op-6 pb-0 tx-12 ">Notifications Non Lu : <span style="color: yellow; font-size:16px; text-style:bold">{{ auth()->user()->unreadNotifications->where('type' , 'App\Notifications\CheckStock')->count() }} </span></p>
									</div>
										@foreach(auth()->user()->unreadNotifications as $notification)
											@if (auth()->user()->unreadNotifications && $notification->type =='App\Notifications\CheckStock')
												<div class="main-notification-list Notification-scroll">
													<a class="d-flex p-3 border-bottom" href="{{ url('details') }}">
														<div class="notifyimg bg-pink">
															<i class="fas fa-boxes"></i>
														</div>
														{{-- @foreach ($notification as $item)
															
														@endforeach --}}
														<div class="mr-3">
															<h5 class="notification-label mb-1"> المرجو التأكد من المخزن</h5>
															{{-- <div class="notification-label mb-1">{{ $notification->data['stock'] }} : Est </div> --}}
														</div>
														<div class="mr-auto" >
															<i class="las la-angle-left text-left text-muted"></i>
														</div>
													</a>
												</div>
											@endif
										@endforeach
									
									@if (auth()->user()->unreadNotifications->count() != 0)
										<div class="dropdown-footer">
											<a href="">VOIR TOUS</a>
										</div>		
									@endif
								</div>
							</div>
							{{-- Commande Notification --}}
							<div class="dropdown nav-item main-header-notification">

									<a class="new nav-link" href="#">
										<svg xmlns="http://www.w3.org/2000/svg" class="header-icon-svgs" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
										@foreach(auth()->user()->unreadNotifications as $notification)
											@if (auth()->user()->unreadNotifications && $notification->type =='App\Notifications\CommandeNotif')
												<span class=" pulse"></span>										
											@endif
										@endforeach
									</a>

								<div class="dropdown-menu">
									<div class="menu-header-content bg-primary text-right">
										<div class="d-flex">
											<h6 class="dropdown-title mb-1 tx-15 text-white font-weight-semibold">Notifications</h6>
											<span class="badge badge-pill badge-warning mr-auto my-auto float-left"><a href="\MarkAsRead">Marqué Comme Lu</a></span>
										</div>
										<p class="dropdown-title-text subtext mb-0 text-white op-6 pb-0 tx-12 ">Notifications Non Lu : <span style="color: yellow; font-size:16px; text-style:bold">{{ auth()->user()->unreadNotifications->where('type' , 'App\Notifications\CommandeNotif')->count() }} </span></p>
									</div>
										@foreach(auth()->user()->unreadNotifications as $notification)
											@if (auth()->user()->unreadNotifications && $notification->type =='App\Notifications\CommandeNotif')
												<div class="main-notification-list Notification-scroll">
													<a class="d-flex p-3 border-bottom" href="{{ url('commandeDetail') }}/{{ $notification->data['commande'] }}">												
															<i style="margin-top: -4%;" class="fas fa-envelope-open-text mb-2"></i>
															تفاصيل الطلب
													</a>
												</div>
											@endif
										@endforeach
									
										@if (auth()->user()->unreadNotifications->count() != 0)
											<div class="dropdown-footer">
												<a href="">VOIR TOUS</a>
											</div>		
										@endif
								</div>
							</div>
							<div class="nav-item full-screen fullscreen-button">
								<a class="new nav-link full-screen-link" href="#"><svg xmlns="http://www.w3.org/2000/svg" class="header-icon-svgs" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-maximize"><path d="M8 3H5a2 2 0 0 0-2 2v3m18 0V5a2 2 0 0 0-2-2h-3m0 18h3a2 2 0 0 0 2-2v-3M3 16v3a2 2 0 0 0 2 2h3"></path></svg></a>
							</div>
							<div class="dropdown main-profile-menu nav nav-item nav-link">
								<a class="profile-user d-flex" href=""><img alt="" src="{{URL::asset('assets/img/faces/6.jpg')}}"></a>
								<div class="dropdown-menu">
									<div class="main-header-profile bg-primary p-3">
										<div class="d-flex wd-100p">
											<div class="main-img-user"><img alt="" src="{{URL::asset('assets/img/faces/6.jpg')}}" class=""></div>
											@auth
											<div class="mr-3 my-auto">
												<h6>{{Auth::user()->name}}</h6><span>{{Auth::user()->email}}</span>
											</div>
											@endauth
										</div>
									</div>
									<a class="dropdown-item" href=""><i class="bx bx-user-circle"></i>Profile</a>
									{{-- <a class="dropdown-item" href=""><i class="bx bx-cog"></i> Edit Profile</a>
									<a class="dropdown-item" href=""><i class="bx bxs-inbox"></i>Inbox</a>
									<a class="dropdown-item" href=""><i class="bx bx-envelope"></i>Messages</a>
									<a class="dropdown-item" href=""><i class="bx bx-slider-alt"></i> Account Settings</a> --}}
									<a class="dropdown-item" href="{{ route('logout') }}"
									onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i
									class="bx bx-log-out"></i>Log-Out</a>
									<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
									@csrf
									</form>
								</div>
							</div>
							
							{{-- <div class="dropdown main-header-message right-toggle">
								<a class="nav-link pr-0" data-toggle="sidebar-left" data-target=".sidebar-left">
									<svg xmlns="http://www.w3.org/2000/svg" class="header-icon-svgs" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>
								</a>
							</div> --}}
						</div>
					</div>
				</div>
			</div>
<!-- /main-header -->
