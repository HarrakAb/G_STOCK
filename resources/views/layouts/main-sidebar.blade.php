<!-- main-sidebar -->
		<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
		<aside class="app-sidebar sidebar-scroll">
			<div class="main-sidebar-header active">
				<a class="desktop-logo logo-light active" href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('assets/img/brand/logo.png')}}" class="main-logo" alt="logo"></a>
				<a class="desktop-logo logo-dark active" href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('assets/img/brand/logo-white.png')}}" class="main-logo dark-theme" alt="logo"></a>
				<a class="logo-icon mobile-logo icon-light active" href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('assets/img/brand/favicon.png')}}" class="logo-icon" alt="logo"></a>
				<a class="logo-icon mobile-logo icon-dark active" href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('assets/img/brand/favicon-white.png')}}" class="logo-icon dark-theme" alt="logo"></a>
			</div>
			<div class="main-sidemenu">
				<div class="app-sidebar__user clearfix">
					<div class="dropdown user-pro-body">
						<div class="">
							<img alt="user-img" class="avatar avatar-xl brround" src="{{URL::asset('assets/img/faces/6.jpg')}}"><span class="avatar-status profile-status bg-green"></span>
						</div>
						@auth
						<div class="user-info">
							<h4 class="font-weight-semibold mt-3 mb-0">{{Auth::user()->name}}</h4>
							{{-- <span class="mb-0 text-muted">{{Auth::user()->email}}</span> --}}
						</div>
						@endauth
					</div>
				</div>
				<ul class="side-menu">
					<li class="side-item side-item-category">نظام تسيير المخزن</li>
					<li class="slide">
						<a class="side-menu__item" href="{{ url('/' . $page='home') }}">
							<i class="fas fa-tachometer-alt"></i>
							<span class="side-menu__label mr-2">لوحة التحكم</span>
						</a>
					</li>
					{{-- @can('produits')
					<li class="side-item side-item-category">تنظيم المنتجات</li>
					@endcan --}}
					<li class="slide">
						<a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}">
							{{-- <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24" ><path d="M0 0h24v24H0z" fill="none"/><path d="M12 4c-4.41 0-8 3.59-8 8s3.59 8 8 8c.28 0 .5-.22.5-.5 0-.16-.08-.28-.14-.35-.41-.46-.63-1.05-.63-1.65 0-1.38 1.12-2.5 2.5-2.5H16c2.21 0 4-1.79 4-4 0-3.86-3.59-7-8-7zm-5.5 9c-.83 0-1.5-.67-1.5-1.5S5.67 10 6.5 10s1.5.67 1.5 1.5S7.33 13 6.5 13zm3-4C8.67 9 8 8.33 8 7.5S8.67 6 9.5 6s1.5.67 1.5 1.5S10.33 9 9.5 9zm5 0c-.83 0-1.5-.67-1.5-1.5S13.67 6 14.5 6s1.5.67 1.5 1.5S15.33 9 14.5 9zm4.5 2.5c0 .83-.67 1.5-1.5 1.5s-1.5-.67-1.5-1.5.67-1.5 1.5-1.5 1.5.67 1.5 1.5z" opacity=".3"/><path d="M12 2C6.49 2 2 6.49 2 12s4.49 10 10 10c1.38 0 2.5-1.12 2.5-2.5 0-.61-.23-1.21-.64-1.67-.08-.09-.13-.21-.13-.33 0-.28.22-.5.5-.5H16c3.31 0 6-2.69 6-6 0-4.96-4.49-9-10-9zm4 13h-1.77c-1.38 0-2.5 1.12-2.5 2.5 0 .61.22 1.19.63 1.65.06.07.14.19.14.35 0 .28-.22.5-.5.5-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.14 8 7c0 2.21-1.79 4-4 4z"/><circle cx="6.5" cy="11.5" r="1.5"/><circle cx="9.5" cy="7.5" r="1.5"/><circle cx="14.5" cy="7.5" r="1.5"/><circle cx="17.5" cy="11.5" r="1.5"/></svg><span class="side-menu__label"> --}}
								<i class="fas fa-truck-loading"></i>
								<span class="side-menu__label mr-2">قائمة المنتوجات</span>
								<i class="angle fe fe-chevron-down"></i>
						</a>
						<ul class="slide-menu">
							@can('categories')
							<li><a class="slide-item" href="{{ url('/' . $page='categories') }}">الأقسام</a></li>
							@endcan
							@can('articles')
							<li><a class="slide-item" href="{{ url('/' . $page='articles') }}">المنتوجات</a></li>
							@endcan
							@can('articles')
							<li><a class="slide-item" href="{{ url('/' . $page='stock') }}">حالة المخزن</a></li>
							@endcan
						</ul>
					</li>
					@can('bons menu')
						<li class="slide">
							<a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}">
								<i class="fas fa-file-alt"></i>
								<span  class="side-menu__label mr-2"> قائمة الفواتير</span>
								<i class="angle fe fe-chevron-down"></i>
							</a>
							<ul class="slide-menu">
								@can('bon entree')
								<li><a class="slide-item" href="{{ url('/' . $page='bonEntrees') }}">فواتير الإستراد</a></li>
								@endcan
								@can('bon sortie')
								<li><a class="slide-item" href="{{ url('/' . $page='bonSorties') }}">فواتير التصدير</a></li>
								@endcan
								@can('invoices not payed')
								<li><a class="slide-item" href="{{ url('/' . $page='unpaid') }}">Invoices not Payed</a></li>
								@endcan
								@can('invoices payed partial')
								<li><a class="slide-item" href="{{ url('/' . $page='partial') }}">Invoives  Payed Partial</a></li>
								@endcan
								@can('archived invoices')
								<li><a class="slide-item" href="{{ url('/' . $page='archive') }}">Archived Invoices</a></li>
								@endcan
							</ul>
						</li>
					@endcan
					{{-- <li><a class="slide-item" href="{{ url('/' . $page='clients') }}">لائحة الزبناء</a></li> --}}
					{{-- @can('employes') --}}
					<li class="slide">
						<a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}">
							<i class="fas fa-user-tie"></i>
								<span class="side-menu__label mr-2"> نظام الزبناء</span>
								<i class="angle fe fe-chevron-down"></i>
							</a>
						<ul class="slide-menu">
							{{-- @can('list des employes') --}}
							<li><a class="slide-item" href="{{ url('/' . $page='clients') }}">لائحة الزبناء</a></li>
							<li><a class="slide-item" href="{{ url('/' . $page='fournisseurs') }}">لائحة المورّدون</a></li>
							{{-- @endcan --}}
						</ul>
					</li>
					<li class="slide">
						<a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}">
							<i class="fas fa-user-tie"></i>
								<span class="side-menu__label mr-2"> نظام الطلبات</span>
								<i class="angle fe fe-chevron-down"></i>
							</a>
						<ul class="slide-menu">
							{{-- @can('list des employes') --}}
							<li><a class="slide-item" href="{{route('commande.create')}}">إظافة طلب</a></li>
							<li><a class="slide-item" href="{{route('commande.index')}}">لائحة الطلبات</a></li>
							{{-- @endcan --}}
						</ul>
					</li>
					{{-- @endcan --}}
					{{-- @can('rpt')
					<li class="side-item side-item-category">Rapports</li>
					<li class="slide">
						<a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}"><svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M4 12c0 4.08 3.06 7.44 7 7.93V4.07C7.05 4.56 4 7.92 4 12z" opacity=".3"/><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.94-.49-7-3.85-7-7.93s3.05-7.44 7-7.93v15.86zm2-15.86c1.03.13 2 .45 2.87.93H13v-.93zM13 7h5.24c.25.31.48.65.68 1H13V7zm0 3h6.74c.08.33.15.66.19 1H13v-1zm0 9.93V19h2.87c-.87.48-1.84.8-2.87.93zM18.24 17H13v-1h5.92c-.2.35-.43.69-.68 1zm1.5-3H13v-1h6.93c-.04.34-.11.67-.19 1z"/></svg><span class="side-menu__label">Rapports Menu</span><i class="angle fe fe-chevron-down"></i></a>
						<ul class="slide-menu">
							@can('invoices rapports')
							<li><a class="slide-item" href="{{ url('/' . $page='invoices_report') }}">Invoices Rapports</a></li>
							@endcan
							@can('employers rapports')
							<li><a class="slide-item" href="{{ url('/' . $page='customers_report') }}">Clients Rapports</a></li>
							@endcan
						</ul>
					</li>
					@endcan --}}
					@can('employes')
					<li class="slide">
						<a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}">
							<i class="fas fa-users"></i>
								<span class="side-menu__label mr-2"> نظام العمال</span>
								<i class="angle fe fe-chevron-down"></i>
							</a>
						<ul class="slide-menu">
							@can('list des employes')
							<li><a class="slide-item" href="{{ url('/' . $page='users') }}">لائحة العمال</a></li>
							@endcan
							@can('permissions des employes')
							<li><a class="slide-item" href="{{ url('/' . $page='roles') }}">صلاحيات العمال</a></li>
							@endcan
						</ul>
					</li>
					@endcan
				</ul>
			</div>
		</aside>
<!-- main-sidebar -->
