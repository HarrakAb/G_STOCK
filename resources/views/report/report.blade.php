
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