
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
							<h4 class="content-title mb-0 my-auto">الديون</h4><!-- <span class="text-muted mt-1 tx-13 mr-2 mb-0">/Tous les Categories</span> -->
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
							<div class="card-body">
								<div class="table-responsive">
									<table id="example1" class="table key-buttons text-md-nowrap" data-page-length='10'style="text-align: center"> 
										<thead>
											<tr>
												<th>إسم الزبون</th>
												<th>رمز الزبون</th>
												<th> باقي الدين</th>
												<th>تعديل الدين</th>
												<th>التفاصيل</th>
											</tr>
										</thead>
										<tbody>
											@foreach ($credits as $credit)
												<tr>
													<td>{{$credit->client_name}}</td>
													<td>{{$credit->code_client}}</td>
													<td>{{$credit->credit}}  درهم</td>
													<td>
                                                        @can('edit credit')
                                                            {{-- <a class="modal-effect mr-3 btn btn-sm btn-success" data-effect="effect-scale"
                                                            data-id="{{ $credit->id }}" 
                                                            data-client_name="{{ $credit->client_name }}"
                                                            data-credit="{{ $credit->credit }}"
                                                            data-toggle="modal" href="#exampleModal2"
															title="Edit"><i class="las la-pen"></i></a> --}}
															<a class="btn btn-success btn-sm" href="{{route('credits.edit' , $credit->id)}}" title="Edit"><i class="las la-pen"></i></a>
                                                        @endcan
                                                    </td>
                                                    <td>
														@can('suivi credit')
															<a class="dropdown-item text-primary btn-sm" 
																href="{{ url('suivi') }}/{{ $credit->code_client }}">
																<i class="fas fa-eye mr-3"></i>
															</a>
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
				<!-- Updating Modal -->
				<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
						aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel">تعديل الدين</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">

								<form action="/credits/update" method="post" autocomplete="off">
									@method('patch')
									@csrf
									<div class="form-group">
										<input type="hidden" name="id" id="id" value="">
										<label for="recipient-name" class="col-form-label">إسم الزبون</label>
										<input class="form-control" name="client_name" id="client_name" type="text">
                                    </div>
                                    <div class="form-group">
										<label for="recipient-name" class="col-form-label">باقي الدين</label>
										<input class="form-control" step="any" name="credit" id="credit" type="number">
                                    </div>
                                    <div class="form-group">
										<label for="recipient-name" class="col-form-label">الدفع</label>
										<input class="form-control" step="any" name="paid" id="paid" type="number">
                                    </div>
                                    <div class="form-group">
										<label for="recipient-name" class="col-form-label">الباقي</label>
										<input class="form-control" name="rest" step="any" id="rest" type="number" readonly>
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
								<h6 class="modal-title">حذف قسم</h6><button aria-label="Close" class="close" data-dismiss="modal"
									type="button"><span aria-hidden="true">&times;</span></button>
							</div>
							<form action="categories/destroy" method="post">
								{{method_field('delete')}}
								{{csrf_field()}}
								<div class="modal-body">
									<p>هل أنت متأكد ؟</p><br>
									<input type="hidden" name="id" id="id" value="">
									<input class="form-control" name="categorie_name" id="categorie_name" type="text" readonly>
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
		var client_name = button.data('client_name')
		var credit = button.data('credit')
		var modal = $(this)
		modal.find('.modal-body #id').val(id);
		modal.find('.modal-body #client_name').val(client_name);
		modal.find('.modal-body #credit').val((credit).toFixed(2));
    })
    


        //paid and rest payment
        $(document).ready(function(){

            $('#paid').on('keyup blur', function(){
                let row = $(this).closest('form');
                let credit = row.find('#credit').val() || 0;
                let paid = row.find('#paid').val() || 0;
                row.find('#rest').val((credit - paid).toFixed(2));
            });

        })
</script>

@endsection