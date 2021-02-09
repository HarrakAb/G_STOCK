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
							<h4 class="content-title mb-0 my-auto">STOCK</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/Article</span>
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
                                        <h4 class="text-primary">L'état de Stock</h4>
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
                                                <th>Categorie</th>
                                                <th>Entrée</th>
												<th>Sortie</th>
												<th>Stock</th>
											</tr>
										</thead>
										<tbody>	
                                            <tr>
                                                <td>{{$article->id}}</td>
                                                <td>{{$article->reference}}</td>
                                                <td>{{$article->categorie->categorie_name}}</td>
                                                <td>{{$entrees}}</td>
                                                <td>{{$sorties}}</td>
                                                <td>
                                                    @if ($article->stock  > 50 )
                                                    <a class="badge badge-success" href="#">{{$article->stock }}</a>
                                                    @elseif  ($article->stock  <= 10) 
                                                        <a class="badge badge-danger" href="#">{{$article->stock }}</a>
                                                    @else
                                                        <a class="badge badge-warning" href="#">{{$article->stock }}</a>
                                                    @endif                                              
                                                </td>
                                            </tr>																		
										</tbody>
									</table>
								</div><!-- bd -->
							</div><!-- bd -->
						</div><!-- bd -->
					</div>
				</div>
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

@endsection