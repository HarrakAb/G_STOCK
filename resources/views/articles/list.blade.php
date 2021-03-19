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
				<h4 class="content-title mb-0 my-auto">المنتوجات</h4><!-- <span class="text-muted mt-1 tx-13 mr-2 mb-0">/Tous les articles</span> -->
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
                                        <a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-scale" data-toggle="modal" href="#modaldemo8">إظافة منتوج</a>
                                    </div>
								</div>
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table id="example1" class="table key-buttons text-md-nowrap" data-page-length='10'style="text-align: center">
										<thead>
											<tr>
												<th>رمز المنتوج</th>
                                                <th>الوصف</th>
                                                <th>القسم</th>
                                                <th>التفاصيل</th>
												<th>العمليات</th>
											</tr>
										</thead>
										<tbody>
											@foreach ($articles as $article)	
												<tr>
													<td>{{$article->reference}}</td>
													<td>{{$article->description}}</td>
													<td>{{$article->categorie->categorie_name}}</td>
													<td><a
														href="{{ url('detail') }}/{{ $article->reference }}"><i class="fas fa-eye mr-3"></i></a>
													</td>
													<td>
													
                                                    @can('modifie article')
														<a class="modal-effect btn btn-sm btn-info" data-effect="effect-scale"
														data-article_id="{{$article->id}}" data-reference="{{$article->reference}}"
														data-categorie_name="{{$article->categorie->categorie_name}}"
														data-unite_mesure="{{$article->unite_mesure}}"
														data-description="{{$article->description}}" data-toggle="modal" href="#exampleModal2"
														title="Edit"><i class="las la-pen"></i></a>
													@endcan
													@can('supprime article')
														<a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
														 data-article_id="{{$article->id}}" data-reference="{{$article->reference}}"
														 data-toggle="modal"
														 href="#modaldemo9" title="Delete"><i class="las la-trash"></i>
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
				<!-- Adding Modal -->
                <div class="modal" id="modaldemo8">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content modal-content-demo">
                            <div class="modal-header">
                                <h6 class="modal-title">منتوج جديد</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
							</div>
                            <div class="modal-body">
                                <form action="{{route('articles.store')}}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label>رمز المنتوج</label>
                                         <input name="reference" class="form-control" type="text">
									</div>
									<div class="form-group">
                                         <select name="categorie_id" id="categorie_id" class="form-control" type="text" required>
											<option value="" selected disabled>القسم</option>
											 @foreach ($categories as $categorie)
										 		<option value="{{ $categorie->id }}">{{ $categorie->categorie_name }}</option>
											 @endforeach
										 </select>
									</div>
									<div class="form-group">
										<select name="unite_mesure" id="unite_mesure" class="form-control" type="text" required>
											<option value="" selected disabled>الوحدة</option>	
											<option value="5">5 KG</option>			
											<option value="10">10 KG</option>			
											<option value="15">15 KG </option>			
											<option value="20">20 KG </option>			
											<option value="25">25 KG </option>			
											<option value="1">Unité</option>			
										</select>
								   </div>
                                    <div class="form-group">
                                        <label>الوصف</label> 
                                        <textarea name="description" class="form-control" type="textarea"></textarea>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn ripple btn-primary btn ripple btn-success-gradient" id='swal-success' type="submit">حفظ</button>
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
								<h5 class="modal-title" id="exampleModalLabel">تعديل منتوج</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">

								<form action="articles/update" method="post" autocomplete="off">
									@method('patch')
									@csrf
									<div class="form-group">
										<input type="hidden" name="article_id" id="article_id" value="">
										<label for="recipient-name" class="col-form-label">رمز المنتوج</label>
										<input class="form-control" name="reference" id="reference" type="text">
									</div>
									<div class="form-group">
									<label class="my-1 mr-2" for="inlineFormCustomSelectPref">القسم</label>
									<select name="categorie_name" id="categorie_name" class="custom-select my-1 mr-sm-2" required>
										@foreach ($categories as $categorie)
											<option>{{ $categorie->categorie_name }}</option>
										@endforeach
									</select>
									</div>
									<div class="form-group">
										<select name="unite_mesure" id="unite_mesure" class="form-control" type="text" required>
											<option value="" selected disabled>الوحدة</option>	
											<option value="5">5 KG</option>			
											<option value="10">10 KG</option>			
											<option value="15">15 KG </option>			
											<option value="20">20 KG </option>			
											<option value="25">25 KG </option>			
											<option value="1">Unité</option>			
										</select>
								   </div>
									<div class="form-group">
										<label for="message-text" class="col-form-label">الوصف</label>
										<textarea class="form-control" id="description" name="description"></textarea>
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
								<h6 class="modal-title">حذف منتوج</h6><button aria-label="Close" class="close" data-dismiss="modal"
										type="button"><span aria-hidden="true">&times;</span></button>
							</div>
							<form action="articles/destroy" method="post">
								{{method_field('delete')}}
								{{csrf_field()}}
								<div class="modal-body">
									<p>هل أنت متأكد ؟</p><br>
									<input type="hidden" name="article_id" id="article_id" value="">
									<input class="form-control" name="reference" id="reference" type="text" readonly>
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
 <!--Internal  Notify js -->
 <script src="{{URL::asset('assets/plugins/notify/js/notifIt.js')}}"></script>
 <script src="{{URL::asset('assets/plugins/notify/js/notifit-custom.js')}}"></script>

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
		var reference = button.data('reference')
		var article_id = button.data('article_id')
		var unite_mesure = button.data('unite_mesure')
		var categorie_name = button.data('categorie_name')
		var description = button.data('description')
		var modal = $(this)
		modal.find('.modal-body #reference').val(reference);
		modal.find('.modal-body #article_id').val(article_id);
		modal.find('.modal-body #unite_mesure').val(unite_mesure);
		modal.find('.modal-body #categorie_name').val(categorie_name);
		modal.find('.modal-body #description').val(description);
	})
</script>

<!-- Delete script -->
<script>
	$('#modaldemo9').on('show.bs.modal', function(event) {
		var button = $(event.relatedTarget)
		var article_id = button.data('article_id')
		var reference = button.data('reference')
		var modal = $(this)
		modal.find('.modal-body #article_id').val(article_id);
		modal.find('.modal-body #reference').val(reference);
	})
</script>

@endsection