@extends('layouts.master')
@section('css')
    <!-- Internal Data table css -->
    <link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <!--Internal   Notify -->
    <link href="{{URL::asset('assets/plugins/notify/css/notifIt.css')}}" rel="stylesheet"/>
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">Bon de Sortie</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Tous les
                    Bon de Sortie</span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-xl-12">
            <!-- notification of deleteing -->
            @if (session()->has('success'))
                <script>
                    window.onload = function(){
                        notif({
                            msg : "Suppréssion avec succés",
                            type : "success"
                        })
                    }
                </script>
            @endif
            @if (session()->has('Add'))
                <script>
                    window.onload = function(){
                        notif({
                            msg : "Operation Done Successfully ",
                            type : "success"
                        })
                    }
                </script>
            @endif
            @if (session()->has('stock'))
                <script>
                    window.onload = function(){
                        notif({
                            msg : "Verfifié Votre Srock !!",
                            type : "success"
                        })
                    }
                </script>
            @endif
            <div class="card mg-b-20">
                <div class="card-header pb-0">
                    {{-- @can('add invoice') --}}
                    <a href="{{route('bonSorties.create')}}" class="modal-effect btn btn-sm btn-primary" style="color:white"><i
                            class="fas fa-plus"></i>&nbsp; Ajouter un Bon </a>
                    {{-- @endcan --}}
                    {{-- @can('export EXCEL') --}}
                    {{-- <a href="export_invoices" class="modal-effect btn btn-sm btn-success" style="color:white"><i
                        class="fas fa-file-download"></i>&nbsp; Export Excel 
                    </a> --}}
                    {{-- @endcan --}}
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example1" class="table key-buttons text-md-nowrap" data-page-length='10'style="text-align: center">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">#</th>
                                    <th class="border-bottom-0">Numéro du Bon</th>
                                    <th class="border-bottom-0">Date de Sortie</th>
                                    <th class="border-bottom-0">Article</th>
                                    <th class="border-bottom-0">Categorie</th>
                                    <th class="border-bottom-0">Quantité</th>
                                    <th class="border-bottom-0">Prix Unitaire</th>
                                    <th class="border-bottom-0">Prix Total</th>
                                    <th class="border-bottom-0">Crée Par</th>
                                    <th class="border-bottom-0">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if (empty($bonSorties))
                                <th class="border-bottom-0 text-bold"> Aucun bon n'est trouvé !!</th>
                            @else
                                @php
                                $i = 0 ;
                                @endphp
                                @foreach ($bonSorties as $bonSortie)
                                    @php
                                    $i++;
                                    @endphp
                                    <tr class="text-center">
                                        <td>{{ $bonSortie->id }}</td>
                                        <td>{{$bonSortie->bon_number}}</td>
                                        <td>{{$bonSortie->bon_date}}</td>
                                        <td>{{$bonSortie->article}}</td>
										{{-- <td><a
											href="{{ url('details') }}/{{ $invoice->id }}">{{ $invoice->categorie->categorie_name }}</a>
										</td> --}}
                                        <td>{{$bonSortie->categorie->categorie_name}}</td>
                                        <td>{{$bonSortie->quantite}}</td>
                                        <td>{{$bonSortie->prix_unitaire}}</td>
                                        <td>{{$bonSortie->prix_total}}</td>
                                        <td>{{$bonSortie->created_by}}</td>
                                        <td>	
											<div class="dropdown">
												<button aria-expanded="false" aria-haspopup="true" class="btn btn-sm btn-primary"
												data-toggle="dropdown" id="dropdownMenuButton" type="button">Menu<i class="fas fa-caret-down ml-1"></i></button>
												<div  class="dropdown-menu tx-md-10">
                                                    {{-- @can('modifie bon') --}}
													<a class="dropdown-item text-success btn-sm" 
                                                        href="{{route('bonSorties.edit',$bonSortie->id)}}">Edit</a>
                                                    {{-- @endcan --}}
                                                    {{-- @can('supprime bon') --}}
                                                    <a class="dropdown-item text-info btn-sm"
                                                        data-bon_id="{{$bonSortie->id}}"
                                                        data-toggle="modal"
                                                        data-target="#archive_bon"
                                                        href="#">Archive</a>
                                                    {{-- @endcan --}}
                                                    {{-- @can('archive bon') --}}
                                                    <a class="dropdown-item text-danger btn-sm"
                                                        data-bon_id="{{ $bonSortie->id }}"
                                                        data-toggle="modal"
                                                        data-target="#delete_bon"
                                                        href="#">Delete</a>
                                                    {{-- @endcan --}}
                                                    {{-- @can('print bon') --}}
                                                    <a class="dropdown-item text-primary btn-sm" 
                                                        href="{{route('print',$bonSortie->id)}}">Print</a>
                                                    {{-- @endcan --}}
												</div>
											</div>
										</td>                               
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
    <!-- Deleteing Model-->
    <div class="modal fade" id="delete_bon" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Suppression du bon</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('bonSorties.destroy',"test")}}" method="post">
                @method('DELETE')
                {{ csrf_field() }}
                <div class="modal-body">
                    <p class="text-center">
                    <h6 style="color:red">vous étes sure ?</h6>
                    </p>
                    
                    <input type="text" name="bon_id" id="bon_id" value="">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Confirmer</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Deleteing Model -->
<!-- Archiving Model-->
<div class="modal fade" id="archive_bon" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Suppression du bon</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('bonSorties.destroy',"test")}}" method="post">
                @method('DELETE')
                {{ csrf_field() }}
                <div class="modal-body">
                    <p class="text-center">
                    <h6 style="color:red">vous étes sure ?</h6>
                    </p>
                    <input type="text" name="page_id" id="page_id" value="2">
                    <input type="text" name="bon_id" id="bon_id" value="">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Confirmer</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Archiing Model -->
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




<script>
$('#delete_bon').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget)
    var bon_id = button.data('bon_id')
    var modal = $(this)
    modal.find('.modal-body #bon_id').val(bon_id);
})
</script>
<script>
$('#archive_bon').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget)
    var bon_id = button.data('bon_id')
    var modal = $(this)
    modal.find('.modal-body #bon_id').val(bon_id);
})
</script>
@endsection
