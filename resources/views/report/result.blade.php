
@extends('layouts.master')
@section('css')
<!---Internal Owl Carousel css-->
<link href="{{URL::asset('assets/plugins/owl-carousel/owl.carousel.css')}}" rel="stylesheet">
<!---Internal  Multislider css-->
<link href="{{URL::asset('assets/plugins/multislider/multislider.css')}}" rel="stylesheet">
<!--- Select2 css -->
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">التقارير المالية</h4><!-- <span class="text-muted mt-1 tx-13 mr-2 mb-0">/Tous les Categories</span> -->
						</div>
					</div>
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
				<!-- row -->
				<div class="row">
                    <div class="col-xl-12">
						<div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4"> <h3 class="card-title text-info">التاريخ :&nbsp;  {{$date}} </h3>
                                        <label>مجموع البيع</label>
                                        <input type="text" class="form-control text-success" value="{{$sumS}} &nbsp; درهم">
                                    </div>
                                    <div class="col-4">
                                        <div class="mt-2">

                                            <label class="mt-3">مجموع الشراء</label>
                                            <input type="text" class="form-control text-success" value="{{$sumE}} &nbsp; درهم">               
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="mt-2">

                                            <label class="mt-3">الأرباح</label>
                                            <input type="text" class="form-control text-success" value="{{  number_format($benifis, 2, '.', '')}} &nbsp; درهم">
                                        </div>
                                    </div>
                                </div>                               
                            </div>
							<div class="card-body">
								<p>عدد الفواتير :   {{ $sortiesC }}</p>
								<div class="table-responsive">
									<table id="example1" class="table key-buttons text-md-nowrap" data-page-length='10'style="text-align: center"> 
										<thead>
											<tr>
                                                <th>التاريخ</th>
												<th>إسم الزبون</th>
												<th>المجموع</th>
											</tr>
										</thead>
										<tbody>
											@foreach ($sorties as $sortie)
												<tr>
													<td>{{$sortie->bon_date}}</td>
                                                    <td>{{$sortie->client_name}}</td>
													<td>{{$sortie->total}}  درهم</td>
												</tr>										
											@endforeach
										</tbody>
									</table>
								</div><!-- bd -->
							</div><!-- bd -->
						</div><!-- bd -->
					</div>
                    
                   
				</div>
				<!-- End Delete Modal -->
				<!-- row closed -->
		<!-- main-content closed -->
@endsection
@section('js')


<!-- Internal Data tables -->
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
<script src="{{ URL::asset('assets/js/table-data.js') }}"></script>

<!--Internal  Datepicker js -->
<script src="{{URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
<!-- Internal Select2 js-->
<script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
<!-- Internal Modal js-->
<script src="{{URL::asset('assets/js/modal.js')}}"></script>



@endsection