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
                <h4 class="content-title mb-0 my-auto">الطلبات</h4><!-- <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Tous lesBon de Sortie</span> -->
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
            @if (session()->has('delete'))
                <script>
                    window.onload = function(){
                        notif({
                            msg : "تمت عملية الحذف بنجاح",
                            type : "success"
                        })
                    }
                </script>
            @endif
            @if (session()->has('archive'))
                <script>
                    window.onload = function(){
                        notif({
                            msg : "تمت عملية الأرشفة بنجاح'",
                            type : "success"
                        })
                    }
                </script>
            @endif
            @if (session()->has('Add'))
                <script>
                    window.onload = function(){
                        notif({
                            msg : "تم الحفظ بنجاح",
                            type : "success"
                        })
                    }
                </script>
            @endif
            @if (session()->has('stock'))
                <script>
                    window.onload = function(){
                        notif({
                            msg : "المرجو التأكد من المخزن !!",
                            type : "success"
                        })
                    }
                </script>
            @endif
            @if (session()->has('edit'))
                <script>
                    window.onload = function(){
                        notif({
                            msg : "تم التعديل بنجاح",
                            type : "success"
                        })
                    }
                </script>
            @endif
   
            <div class="card mg-b-20">
                <div class="card-header pb-0">
                    @can('add commande')
                    <a href="{{route('commande.create')}}" class="modal-effect btn btn-sm btn-primary" style="color:white"><i
                            class="fas fa-plus"></i>&nbsp; إظافة طلب</a>
                    @endcan
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
                                    <th class="border-bottom-0">رقم الطلب</th>
                                    <th class="border-bottom-0">تاريخ الطلب</th>
                                    <th class="border-bottom-0">إسم الزبون</th>
                                    <th class="border-bottom-0">التفاصيل</th>
                                    <th class="border-bottom-0">العمليات</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if (empty($bonCommandes))
                                <th class="border-bottom-0 text-bold"> لا توجد طلبات !!</th>
                            @else
                                @foreach ($bonCommandes as $bonCommande)
                                    <tr class="text-center">
                                        <td>{{$bonCommande->bon_number}}</td>
                                        <td>{{$bonCommande->created_at}}</td>
                                        <td>{{$bonCommande->client_name}}</td>
										<td><a
                                            href="{{ route('commande.show' , $bonCommande->id ) }}"><i class="fas fa-eye mr-3"></i></a>
                                        </td>
                                        <td>	
											<div class="dropdown">
												<button aria-expanded="false" aria-haspopup="true" class="btn btn-sm btn-primary"
												data-toggle="dropdown" id="dropdownMenuButton" type="button">قائمة<i class="fas fa-caret-down ml-1"></i></button>
												<div  class="dropdown-menu tx-md-10">
                                                    @can('delete commande')
                                                    <a class="dropdown-item text-danger btn-sm"
                                                        data-bon_id="{{$bonCommande->id}}"
                                                        data-toggle="modal"
                                                        data-target="#delete_bon"
                                                        href="#">حذف</a>
                                                    @endcan
                                                    @can('print commande')
                                                    <a class="dropdown-item text-primary btn-sm" 
                                                        href="{{route('print',$bonCommande->id)}}">طباعة</a>
                                                    @endcan
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
                <h5 class="modal-title" id="exampleModalLabel">حذف الطلب</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('commande.destroy',"test")}}" method="post">
                @method('DELETE')
                {{ csrf_field() }}
                <div class="modal-body">
                    <p class="text-center">
                    <h6 style="color:red"> هل انت متاكد من عملية حذف الطلب ؟</h6>
                    </p>
                    
                    <input type="hidden" name="bon_id" id="bon_id" value="">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">الغاء</button>
                    <button type="submit" class="btn btn-danger">تاكيد</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Deleteing Model -->
<!-- Archiving Model-->
<div class="modal fade" id="delete_bon" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">أرشفة الطلب</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('commande.destroy',"test")}}" method="post">
                @method('DELETE')
                {{ csrf_field() }}
                <div class="modal-body">
                    <p class="text-center">
                    <h6 style="color:red">هل انت متاكد من عملية أرشفة الطلب ؟</h6>
                    </p>
                    <input type="hidden" name="page_id" id="page_id" value="2">
                    <input type="hidden" name="bon_id" id="bon_id" value="">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">الغاء</button>
                    <button type="submit" class="btn btn-danger">تاكيد</button>
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
