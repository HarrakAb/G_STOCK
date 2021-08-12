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
							<img alt="user-img" class="avatar avatar-xl brround" src="{{URL::asset('assets/img/faces/loggo.png')}}"><span class="avatar-status profile-status bg-green"></span>
						</div>
						@auth
						<div class="user-info">
							<h4 class="font-weight-semibold mt-3 mb-0">{{Auth::user()->name}}</h4>
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
					<li class="slide">
						<a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}">
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
							@can('stock etat')
							<li><a class="slide-item" href="{{ url('/' . $page='stock') }}">حالة المخزن</a></li>
							@endcan
							@can('stock value')
							<li><a class="slide-item" href="{{ url('/' . $page='stockValue') }}">قيمة المخزن</a></li>
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
							</ul>
						</li>
					@endcan
					@can('clients list')
					<li class="slide">
						<a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}">
							<i class="fas fa-user-tie"></i>
								<span class="side-menu__label mr-2"> نظام الزبناء</span>
								<i class="angle fe fe-chevron-down"></i>
							</a>
						<ul class="slide-menu">
							@can('clients')
							<li><a class="slide-item" href="{{ url('/' . $page='clients') }}">لائحة الزبناء</a></li>
							@endcan
							@can('fournisseurs')
							<li><a class="slide-item" href="{{ url('/' . $page='fournisseurs') }}">لائحة المورّدون</a></li>
							@endcan
						</ul>
					</li>
					@endcan
					@can('credit')
					<li class="slide">
						<a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}">
							<i class="fas fa-dollar-sign"></i>
								<span class="side-menu__label mr-2"> نظام الديون</span>
								<i class="angle fe fe-chevron-down"></i>
							</a>
						<ul class="slide-menu">
							{{-- @can('list des employes') --}}
							<li><a class="slide-item" href="{{ url('/' . $page='credits') }}">تتبع الديون</a></li>
							{{-- <li><a class="slide-item" href="{{ url('/' . $page='fournisseurs') }}">لائحة المورّدون</a></li> --}}
							{{-- @endcan --}}
						</ul>
					</li>
					<li class="slide">
						<a class="side-menu__item" href="{{ url('home/reports') }}">
							<i class="fas fa-chart-line"></i>
								<span class="side-menu__label mr-2">التقارير</span>
								<i class="angle fe fe-chevron-down"></i>
							</a>

					</li>
					@endcan
					@can('commande')		
					<li class="slide">
						<a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}">
							<i class="fas fa-clipboard-list"></i>
								<span class="side-menu__label mr-2"> نظام الطلبات</span>
								<i class="angle fe fe-chevron-down"></i>
							</a>
						<ul class="slide-menu">
							@can('add commande')
							<li><a class="slide-item" href="{{route('commande.create')}}">إظافة طلب</a></li>
							@endcan
							@can('voir commande')
							<li><a class="slide-item" href="{{route('commande.index')}}">لائحة الطلبات</a></li>
							@endcan
						</ul>
					</li>
					
					@endcan
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
