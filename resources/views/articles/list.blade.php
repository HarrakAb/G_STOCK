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
							<h4 class="content-title mb-0 my-auto">Categories</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/Tous les articles</span>
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
                                        <a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-scale" data-toggle="modal" href="#modaldemo8">Ajouter un Article </a>
                                    </div>
								</div>
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table class="table table-striped mg-b-0 text-md-nowrap">
										<thead>
											<tr>
												<th>#</th>
												<th>Reference</th>
                                                <th>Descritpion</th>
                                                <th>Categorie</th>
                                                <th>Détails</th>
												<th>Opération</th>
											</tr>
										</thead>
										<tbody>
											@foreach ($articles as $article)	
												<tr>
													<td>{{$article->id}}</td>
													<td>{{$article->reference}}</td>
													<td>{{$article->description}}</td>
													<td>{{$article->categorie->categorie_name}}</td>
													<td><a
														href="{{ url('detail') }}/{{ $article->reference }}"><i class="fas fa-eye mr-3"></i></a>
													</td>
													<td>
													
                                                    {{-- @can('modifie article') --}}
														<a class="modal-effect btn btn-sm btn-info" data-effect="effect-scale"
														data-article_id="{{$article->id}}" data-reference="{{$article->reference}}"
														data-categorie_name="{{$article->categorie->categorie_name}}"
														data-description="{{$article->description}}" data-toggle="modal" href="#exampleModal2"
														title="Edit"><i class="las la-pen"></i></a>
													{{-- @endcan --}}
													{{-- @can('supprime article') --}}
														<a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
														 data-article_id="{{$article->id}}" data-reference="{{$article->reference}}"
														 data-toggle="modal"
														 href="#modaldemo9" title="Delete"><i class="las la-trash"></i>
														</a>
													{{-- @endcan --}}
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
                                <h6 class="modal-title">Crée un Article</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
							</div>
                            <div class="modal-body">
                                <form action="{{route('articles.store')}}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label>Reference</label>
                                         <input name="reference" class="form-control" type="text">
									</div>
									<div class="form-group">
                                         <select name="categorie_id" id="categorie_id" class="form-control" type="text" required>
											<option value="" selected disabled>Choisir Categorie</option>
											 @foreach ($categories as $categorie)
										 		<option value="{{ $categorie->id }}">{{ $categorie->categorie_name }}</option>
											 @endforeach
										 </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Designation</label> 
                                        <textarea name="description" class="form-control" type="textarea"></textarea>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn ripple btn-primary btn ripple btn-success-gradient" id='swal-success' type="submit">Enregistrer</button>
                                        <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Fermer</button>
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
								<h5 class="modal-title" id="exampleModalLabel">Modifier Article</h5>
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
										<label for="recipient-name" class="col-form-label">Reference</label>
										<input class="form-control" name="reference" id="reference" type="text">
									</div>
									<label class="my-1 mr-2" for="inlineFormCustomSelectPref">Categories</label>
									<select name="categorie_name" id="categorie_name" class="custom-select my-1 mr-sm-2" required>
										@foreach ($categories as $categorie)
											<option>{{ $categorie->categorie_name }}</option>
										@endforeach
									</select>
									<div class="form-group">
										<label for="message-text" class="col-form-label">Description</label>
										<textarea class="form-control" id="description" name="description"></textarea>
									</div>
									</div>
									<div class="modal-footer">
										<button type="submit" class="btn btn-primary">Modifier</button>
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
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
								<h6 class="modal-title">Supprimer Categorie</h6><button aria-label="Close" class="close" data-dismiss="modal"
																			   type="button"><span aria-hidden="true">&times;</span></button>
							</div>
							<form action="articles/destroy" method="post">
								{{method_field('delete')}}
								{{csrf_field()}}
								<div class="modal-body">
									<p>Vous étes sure ?</p><br>
									<input type="hidden" name="article_id" id="article_id" value="">
									<input class="form-control" name="reference" id="reference" type="text" readonly>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
									<button type="submit" class="btn btn-danger">Confirmer</button>
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
		var categorie_name = button.data('categorie_name')
		var description = button.data('description')
		var modal = $(this)
		modal.find('.modal-body #reference').val(reference);
		modal.find('.modal-body #article_id').val(article_id);
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