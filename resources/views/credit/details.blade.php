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

    <style>
        .sum{
            width: 15%;
            height: 50% !important;
            margin-right: 72%;
            margin-bottom: 6px;
        }
        .back{
            margin-right: 10%;
            height: 60%;
        }
    </style>
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">فواتير التصدير</h4><!-- <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Tous lesBon de Sortie</span> -->
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
                <div class="card-body">
                    <div class="row">
                        <a href="{{ url('/credits')}}" class="btn btn-primary back float-left mt-3 mr-2" id="print_Button">
                             <i class="fa fa-home ml-1"></i>
                             رجوع
                        </a>
                        <div class="sum">
                            <label for="inputName" class="control-label text-danger">مجموع الباقي</label>
                            <input style="height: 60% !important;" type="text" class="form-control" id="rest" value="{{ number_format($sum ,2). ' درهم '}}" name="rest" readonly>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="example1" class="table key-buttons text-md-nowrap" data-page-length='10'style="text-align: center">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">رقم الفاتورة</th>
                                    <th class="border-bottom-0">تاريخ الفاتورة</th>
                                    <th class="border-bottom-0">إسم الزبون</th>
                                    <th class="border-bottom-0">عنوان الزبون</th>
                                    <th class="border-bottom-0">المبلغ الإجمالي للفاتورة</th>
                                    <th class="border-bottom-0">الدفع</th>
                                    <th class="border-bottom-0">الباقي</th>
                                    <th class="border-bottom-0">التفاصيل</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if (empty($bon_sorties))
                                <th class="border-bottom-0 text-bold"> لا توجد فاتير !!</th>
                            @else
                                @foreach ($bon_sorties as $bonSortie)
                                    <tr class="text-center">
                                        <td>{{$bonSortie->bon_number}}</td>
                                        <td>{{$bonSortie->bon_date}}</td>
                                        <td>{{$bonSortie->client_name}}</td>
                                        <td>{{$bonSortie->client_address}}</td>
                                        <td>{{$bonSortie->total}}</td>
                                        <td>{{$bonSortie->paid}}</td>
                                        <td>{{$bonSortie->rest}}</td>
										<td><a
                                            href="{{ url('suiviDetails') }}/{{ $bonSortie->id }}"><i class="fas fa-eye mr-3"></i></a>
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
    {{-- <div class="modal fade" id="delete_bon" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">حذف الفاتورة</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('bonSorties.destroy',"test")}}" method="post">
                @method('DELETE')
                {{ csrf_field() }}
                <div class="modal-body">
                    <p class="text-center">
                    <h6 style="color:red"> هل انت متاكد من عملية حذف الفاتورة ؟</h6>
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
</div> --}}
<!-- End Deleteing Model -->
<!-- Archiving Model-->
{{-- <div class="modal fade" id="archive_bon" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">أرشفة الفاتورة</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('bonSorties.destroy',"test")}}" method="post">
                @method('DELETE')
                {{ csrf_field() }}
                <div class="modal-body">
                    <p class="text-center">
                    <h6 style="color:red">هل انت متاكد من عملية أرشفة الفاتورة ؟</h6>
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
</div> --}}
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




{{-- <script>
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
</script> --}}
@endsection