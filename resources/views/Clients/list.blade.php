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
							<h4 class="content-title mb-0 my-auto">الزبناء</h4><!-- <span class="text-muted mt-1 tx-13 mr-2 mb-0">/Tous les Categories</span> -->
						</div>
					</div>
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
				<!-- row -->
				<div class="row">

                    @if (session()->has('success'))
                        <div class="alert alert-success" role="alert">
                            {{session()->get('success')}}
                        </div>
                    @endif
					@if ($errors->any())
						<div class="alert alert-danger">
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif
                    <div class="col-xl-12">
						<div class="card">
							<div class="card-header pb-0">
								<div class="d-flex justify-content-between">
                                    <div class="col-sm-6 col-md-4 col-xl-3">
                                        <a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-scale" data-toggle="modal" href="#modaldemo8">إظافة زبون</a>
                                    </div>
								</div>
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table id="example1" class="table key-buttons text-md-nowrap" data-page-length='10'style="text-align: center"> 

										<thead>
											<tr>
												<th>الإسم الكامل</th>
												<th>العنوان</th>
												<th>الهاتف</th>
                                                <th>البريد الإلكتروني</th>
                                                <th>رمز الزبون</th>
												<th>العمليات</th>
											</tr>
										</thead>
										<tbody>
											@foreach ($clients as $client)
												<tr>
													<td>{{$client->full_name}}</td>
													<td>{{$client->address}}</td>
													<td>{{$client->phone}}</td>
													<td>{{$client->email}}</td>
													<td>{{$client->code_client}}</td>
													<td>
													@can('edit client')
														<a class="modal-effect btn btn-sm btn-info" data-effect="effect-scale"
														   data-id="{{ $client->id }}" 
														   data-full_name="{{ $client->full_name }}"
														   data-address="{{ $client->address }}"
														   data-phone="{{ $client->phone }}"
														   data-email="{{ $client->email }}"
														   data-toggle="modal" href="#exampleModal2"
														   title="Edit"><i class="las la-pen"></i></a>
													@endcan
													@can('delete client')
														<a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
														   data-id="{{ $client->id }}" data-full_name="{{ $client->full_name }}" data-toggle="modal"
														   href="#modaldemo9" title="Delete"><i class="las la-trash"></i></a>
													@endcan
												</td>
												</tr>										
											@endforeach
										</tbody>
									</table>
								</div><!-- bd -->
							</div><!-- bd -->
						</div><!-- bd -->
					</div>
				</div>
				<!-- Adding Modal -->
                <div class="modal" id="modaldemo8">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content modal-content-demo">
                            <div class="modal-header">
                                <h6 class="modal-title">إظافة زبون جديد</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
							</div>
                            <div class="modal-body">
                                <form action="{{route('clients.store')}}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label>الإسم الكامل</label>
                                         <input name="full_name" class="form-control" type="text">
                                    </div>
                                    <div class="form-group">
                                        <label>العنوان</label>
                                         <input name="address" class="form-control" type="text">
                                    </div>
                                    <div class="form-group">
                                        <label>الهاتف</label>
                                         <input name="phone" class="form-control" type="text">
                                    </div>
                                    <div class="form-group">
                                        <label>البريد الإلكتروني</label>
                                         <input name="email" class="form-control" type="email">
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn ripple btn-primary" type="submit">حفظ</button>
                                        <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">رجوع</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
				</div>
				<!-- End Adding Modal -->
				<!-- Updating Modal -->
				<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
						aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel">تعديل الزبون</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">

								<form action="clients/update" method="post" autocomplete="off">
									@method('patch')
									@csrf
									<div class="form-group">
										<input type="hidden" name="id" id="id" value="">
										<label for="recipient-name" class="col-form-label">الإسم الكامل</label>
										<input class="form-control" name="full_name" id="full_name" type="text">
                                    </div>
                                    <div class="form-group">
										<label for="recipient-name" class="col-form-label">العنوان</label>
										<input class="form-control" name="address" id="address" type="text">
                                    </div>
                                    <div class="form-group">
										<label for="recipient-name" class="col-form-label">الهاتف</label>
										<input class="form-control" name="phone" id="phone" type="text">
                                    </div>
                                    <div class="form-group">
										<label for="recipient-name" class="col-form-label">البريد الإلكتروني</label>
										<input class="form-control" name="email" id="email" type="email">
									</div>
									</div>
									<div class="modal-footer">
										<button type="submit" class="btn btn-primary">تعديل</button>
										<button type="button" class="btn btn-secondary" data-dismiss="modal">رجوع</button>
									</div>
							</form>
						</div>
					</div>
				</div>
				<!--End Updating Modal -->
				   <!-- delete -->
				   <div class="modal" id="modaldemo9">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content modal-content-demo">
							<div class="modal-header">
								<h6 class="modal-title">حذف زبون</h6><button aria-label="Close" class="close" data-dismiss="modal"
									type="button"><span aria-hidden="true">&times;</span></button>
							</div>
							<form action="clients/destroy" method="post">
								{{method_field('delete')}}
								@csrf
								<div class="modal-body">
									<p>هل أنت متأكد ؟</p><br>
									<input type="hidden" name="id" id="id" value="">
									<input class="form-control" name="full_name" id="full_name" type="text" readonly>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">رجوع</button>
									<button type="submit" class="btn btn-danger">تأكيد</button>
								</div>
						</div>
						</form>
					</div>
				</div>
				<!-- End Delete Modal -->
				<!-- row closed -->
			</div>
			<!-- Container closed -->
		</div>
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



<!-- Update script -->
<script>
	$('#exampleModal2').on('show.bs.modal', function(event) {
		var button = $(event.relatedTarget)
		var id = button.data('id')
		var full_name = button.data('full_name')
		var address = button.data('address')
		var phone = button.data('phone')
		var email = button.data('email')
		var modal = $(this)
		modal.find('.modal-body #id').val(id);
		modal.find('.modal-body #full_name').val(full_name);
		modal.find('.modal-body #address').val(address);
		modal.find('.modal-body #phone').val(phone);
		modal.find('.modal-body #email').val(email);
	})
</script>

<!-- Delete script -->
<script>
	$('#modaldemo9').on('show.bs.modal', function(event) {
		var button = $(event.relatedTarget)
		var id = button.data('id')
		var full_name = button.data('full_name')
		var modal = $(this)
		modal.find('.modal-body #id').val(id);
		modal.find('.modal-body #full_name').val(full_name);
	})
</script>

@endsection