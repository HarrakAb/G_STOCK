@extends('layouts.master')
@section('css')
<!--  Owl-carousel css-->
<link href="{{URL::asset('assets/plugins/owl-carousel/owl.carousel.css')}}" rel="stylesheet" />
<!-- Maps css -->
<link href="{{URL::asset('assets/plugins/jqvmap/jqvmap.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/notify/css/notifIt.css')}}" rel="stylesheet"/>

@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="left-content">
						<div>
						  <h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1">مرحباً</h2>
						  <p class="mg-b-0">نظام تسيير المخزن</p>
						</div>
					</div>
					<div class="main-dashboard-header-right">
						<div>
							<label class="tx-13">المبيعات</label>
							<div class="main-star">
								<i class="typcn typcn-star active"></i> <i class="typcn typcn-star active"></i> <i class="typcn typcn-star active"></i> <i class="typcn typcn-star active"></i> <i class="typcn typcn-star"></i> <span>(14,873)</span>
							</div>
						</div>
						<div>
							<label class="tx-13">المبيعات شهريا</label>
							<h5>00,00</h5>
						</div>
						<div>
							<label class="tx-13">المبيعات سنويا</label>
							<h5>00,00</h5>
						</div>
					</div>
				</div>
				
				<!-- /breadcrumb -->
@endsection
@section('content')

				<!-- row -->
				<div class="row row-sm">

					@if (session()->has('stock'))
						<div class="alert alert-danger" role="alert">
							{{session()->get('stock')}}
						</div>
					@endif
					<div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
						<div class="card overflow-hidden sales-card bg-primary-gradient">

							<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
								<div class="">
									<h6 class="mb-3 tx-12 text-white">جميع الفواتير</h6>
								</div>
								<div class="pb-0 mt-0">
									<div class="d-flex">
										<div class="">
											{{-- @if (number_format(\App\Models\BonEntree::count() + \App\Models\BonSortie::count()) != 0 )
												<h4 class="tx-20 font-weight-bold mb-1 text-white">
													{{ number_format(\App\Models\BonEntree::count() + \App\Models\BonSortie::count()) }}
												</h4>								
											@endif --}}
										</div>
										<span class="float-right my-auto mr-auto">
											<i class="fas fa-arrow-circle-up text-white"></i>
											<span class="text-white op-7">100%</span>
										</span>
									</div>
								</div>
							</div>
							<span id="compositeline" class="pt-1">5,9,5,6,4,12,18,14,10,15,12,5,8,5,12,5,12,10,16,12</span>
						</div>
					</div>
					<div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
						<div class="card overflow-hidden sales-card bg-danger-gradient">
							<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
								<div class="">
									<h6 class="mb-3 tx-12 text-white">مجموع الصادرات</h6>
								</div>
								<div class="pb-0 mt-0">
									<div class="d-flex">
										<div class="">
											{{-- @if (number_format(\App\Models\BonSortie::count()) != 0 )
												<h4 class="tx-20 font-weight-bold mb-1 text-white">
													{{ number_format(\App\Models\BonSortie::count()) }}
												</h4>		
											@endif --}}
										</div>
										<span class="float-right my-auto mr-auto">
											<i class="fas fa-arrow-circle-down text-white"></i>
											{{-- @if (number_format( \App\Models\BonEntree::count() /( \App\Models\BonEntree::count() + \App\Models\BonSortie::count() ) * 100 ) != 0)
												<span class="text-white op-7">{{ number_format( \App\Models\BonEntree::count() /( \App\Models\BonEntree::count() + \App\Models\BonSortie::count() ) * 100 )}}%</span>												
											@endif --}}
										</span>
									</div>
								</div>
							</div>
							<span id="compositeline2" class="pt-1">3,2,4,6,12,14,8,7,14,16,12,7,8,4,3,2,2,5,6,7</span>
						</div>
					</div>
					<div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
						<div class="card overflow-hidden sales-card bg-success-gradient">
							<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
								<div class="">
									<h6 class="mb-3 tx-12 text-white">مجموع الواردات</h6>
								</div>
								<div class="pb-0 mt-0">
									<div class="d-flex">
										<div class="">
											{{-- @if (number_format(\App\Models\BonEntree::count()))
												<h4 class="tx-20 font-weight-bold mb-1 text-white">{{ number_format(\App\Models\BonEntree::count())  }}</h4>												
											@endif --}}
										</div>
										<span class="float-right my-auto mr-auto">
											<i class="fas fa-arrow-circle-up text-white"></i>
											{{-- @if ( number_format( \App\Models\BonSortie::count() /( \App\Models\BonEntree::count() + \App\Models\BonSortie::count() ) * 100 ) != 0)
												<span class="text-white op-7">{{  number_format( \App\Models\BonSortie::count() /( \App\Models\BonEntree::count() + \App\Models\BonSortie::count() ) * 100 )}}%</span>												
											@endif --}}
										</span>
									</div>
								</div>
							</div>
							<span id="compositeline3" class="pt-1">5,10,5,20,22,12,15,18,20,15,8,12,22,5,10,12,22,15,16,10</span>
						</div>
					</div>
					<div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
						<div class="card overflow-hidden sales-card bg-warning-gradient">
							<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
								<div class="">
									<h6 class="mb-3 tx-12 text-white">الدخل السنوي</h6>
								</div>
								<div class="pb-0 mt-0">
									<div class="d-flex">
										<div class="">
											{{-- <h4 class="tx-20 font-weight-bold mb-1 text-white">{{ number_format(\App\Models\Invoice::where('Value_Status', '=' , 3)->sum('Total'),2) }}</h4> --}}
											{{-- <p class="mb-0 tx-12 text-white op-7">{{ \App\Models\Invoice::where('Value_Status', '=' , 1)->count() }}</p> --}}
										 </div>
										<span class="float-right my-auto mr-auto">
											<i class="fas fa-arrow-circle-down text-white"></i>
											{{-- <span class="text-white op-7">{{ \App\Models\Invoice::where('Value_Status', '=' , 3)->count() / \App\Models\Invoice::count() * 100 }}%</span> --}}
										</span>
									</div>
								</div>
							</div>
							<span id="compositeline4" class="pt-1">5,9,5,6,4,12,18,14,10,15,12,5,8,5,12,5,12,10,16,12</span>
						</div>
					</div>
				</div>
				<!-- row closed -->


				<div class="row">

                    <div class="col md-4">
                        <div class="card">
                          <div class="card-body">
                            <h3 class="card-title text-info">بحث بالأيام</h3>
                          </div>
                        </div>
                    <hr>
                        <div class="card-body">
                            <form action="{{ route('checkReports') }}" method="POST">
                                @csrf
                                <label for="">إختر اليوم</label>
                                <input class="form-control" type="date" name="day" id="" required>
                                <button class="btn btn-primary mt-3" type="submit">بحث</button>
                            </form>
                      </div>
                    </div>
                    <div class="col md-4">
                        <div class="card">
                          <div class="card-body">
                            <h3 class="card-title text-info">بحث بالشهور</h3>
                          </div>
                        </div>
                    <hr>
                        <div class="card-body">
                            <form action="{{ route('checkReports') }}" method="POST">
                                @csrf
                                <label for="">إختر الشهر</label>
                                <select name="month" class="form-control">
                                    <option value="" selected disabled>الشهور</option>
                                    <option value="01">01</option>
                                    <option value="02">02</option>
                                    <option value="03">03</option>
                                    <option value="04">04</option>
                                    <option value="05">05</option>
                                    <option value="06">06</option>
                                    <option value="07">07</option>
                                    <option value="08">08</option>
                                    <option value="09">09</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                </select>
                                <label for="">إختر السنة</label>
                                <select name="year" class="form-control">
                                    <option value="" selected disabled>السنوات</option>
                                    <option value="2020">2020</option>
                                    <option value="2021">2021</option>
                                    <option value="2022">2022</option>
                                    <option value="2023">2023</option>
                                </select>
                                <button class="btn btn-primary mt-3" type="submit">بحث</button>
                            </form>
                      </div>
                    </div>
                    <div class="col md-4">
                        <div class="card">
                          <div class="card-body">
                            <h3 class="card-title text-info">بحث بالسنوات</h3>
                          </div>
                        </div>
                    <hr>
                        <div class="card-body">
                            <form action="{{ route('checkReports') }}" method="POST">
                                @csrf
                                <label for="">إختر السنة</label>
                                <select name="year" class="form-control">
                                    <option value="" selected disabled>السنوات</option>
                                    <option value="2020">2020</option>
                                    <option value="2021">2021</option>
                                    <option value="2022">2022</option>
                                    <option value="2023">2023</option>
                                </select>
                                <button class="btn btn-primary mt-3" type="submit">بحث</button>
                            </form>
                      </div>
                    </div>
                   
				</div>
					<!-- Container closed -->
@endsection

@section('js')
<!--Internal  Chart.bundle js -->
<script src="{{URL::asset('assets/plugins/chart.js/Chart.bundle.min.js')}}"></script>
<!-- Moment js -->
<script src="{{URL::asset('assets/plugins/raphael/raphael.min.js')}}"></script>
<!--Internal  Flot js-->
<script src="{{URL::asset('assets/plugins/jquery.flot/jquery.flot.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jquery.flot/jquery.flot.pie.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jquery.flot/jquery.flot.resize.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jquery.flot/jquery.flot.categories.js')}}"></script>
<script src="{{URL::asset('assets/js/dashboard.sampledata.js')}}"></script>
<script src="{{URL::asset('assets/js/chart.flot.sampledata.js')}}"></script>
<!--Internal Apexchart js-->

    {{-- <!-- Internal Data tables -->
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/vfs_fonts.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.html5.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.print.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js') }}"></script>
    <!--Internal  Datatable js -->
    <script src="{{ URL::asset('assets/js/table-data.js') }}"></script> --}}


{{-- <script src="{{URL::asset('assets/js/apexcharts.js')}}"></script> --}}
<!-- Internal Map -->
<script src="{{URL::asset('assets/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
<script src="{{URL::asset('assets/js/modal-popup.js')}}"></script>
<!--Internal  index js -->
<script src="{{URL::asset('assets/js/index.js')}}"></script>
<script src="{{URL::asset('assets/js/jquery.vmap.sampledata.js')}}"></script>	


<!--Internal  Notify js -->
<script src="{{URL::asset('assets/plugins/notify/js/notifIt.js')}}"></script>
<script src="{{URL::asset('assets/plugins/notify/js/notifit-custom.js')}}"></script>

<script type = "text/JavaScript">
	
	window.setTimeout(function () {
		window.location.reload();
	}, 180000);
	
 </script>

@endsection