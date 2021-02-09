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
                <h4 class="content-title mb-0 my-auto">Invoices</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ All
                    Invoinces</span>
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
                            msg : "Deleted Successfully ",
                            type : "success"
                        })
                    }
                </script>
            @endif
            @if (session()->has('paiment'))
                <script>
                    window.onload = function(){
                        notif({
                            msg : "Operation Done Successfully ",
                            type : "success"
                        })
                    }
                </script>
            @endif
            <div class="card mg-b-20">
                <div class="card-header pb-0">
                    {{-- @can('add invoice') --}}
                    <a href="invoices/create" class="modal-effect btn btn-sm btn-primary" style="color:white"><i
                            class="fas fa-plus"></i>&nbsp; Add Invoice </a>
                    {{-- @endcan --}}
                    {{-- @can('export EXCEL') --}}
                    <a href="export_invoices" class="modal-effect btn btn-sm btn-success" style="color:white"><i
                        class="fas fa-file-download"></i>&nbsp; Export Excel </a>
                    {{-- @endcan --}}
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example1" class="table key-buttons text-md-nowrap" data-page-length='50'style="text-align: center">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">#</th>
                                    <th class="border-bottom-0">Invoice_number</th>
                                    <th class="border-bottom-0">Invoice_date</th>
                                    <th class="border-bottom-0">Due_date</th>
                                    <th class="border-bottom-0">Article</th>
                                    <th class="border-bottom-0">Categorie/th>
                                    <th class="border-bottom-0">Discount</th>
                                    <th class="border-bottom-0">Rate_vat</th>
                                    <th class="border-bottom-0">Value_vat</th>
                                    <th class="border-bottom-0">Total</th>
                                    <th class="border-bottom-0">Status</th>
                                    <th class="border-bottom-0">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if (empty($invoices))
                                <th class="border-bottom-0 text-bold"> No Invoices Yet !!</th>
                            @else
                                @php
                                $i = 0 ;
                                @endphp
                                @foreach ($invoices as $invoice)
                                    @php
                                    $i++;
                                    @endphp
                                    <tr class="text-center">
                                        <td>{{ $i }}</td>
                                        <td>{{$invoice->invoice_number}}</td>
                                        <td>{{$invoice->invoice_Date}}</td>
                                        <td>{{$invoice->Due_date}}</td>
                                        <td>{{$invoice->article}}</td>
										{{-- <td class="text-info"><a href="{{ route('details',['id' => $invoice->section_id]) }}">
											{{$invoice->section->section_name}}</a>
										</td> --}}
										<td><a
											href="{{ url('details') }}/{{ $invoice->id }}">{{ $invoice->categorie->categorie_name }}</a>
										</td>
                                        <td>{{$invoice->Discount}}</td>
                                        <td>{{$invoice->Rate_VAT}}</td>
                                        <td>{{$invoice->Value_VAT}}</td>
                                        <td>{{$invoice->Total}}</td>
										<td>
											@if ($invoice->Value_Status == 1)
											<a class="badge badge-success" href="#">Payed</a>
											@elseif  ($invoice->Value_Status == 2) 
												<a class="badge badge-danger" href="#"> Not Payed</a>
											@else
												<a class="badge badge-warning" href="#">Payed partial</a>
											@endif
										</td>
                                        <td>	
											<div class="dropdown">
												<button aria-expanded="false" aria-haspopup="true" class="btn btn-sm btn-primary"
												data-toggle="dropdown" id="dropdownMenuButton" type="button">Menu<i class="fas fa-caret-down ml-1"></i></button>
												<div  class="dropdown-menu tx-md-10">
                                                    {{-- @can('invoice edit') --}}
													<a class="dropdown-item text-success btn-sm" 
                                                        href="{{route('invoices.edit',$invoice->id)}}">Edit</a>
                                                    {{-- @endcan --}}
                                                    {{-- @can('delete invoice') --}}
                                                    <a class="dropdown-item text-danger btn-sm"
                                                        data-invoice_id="{{ $invoice->id }}"
                                                        data-toggle="modal"
                                                        data-target="#delete_invoice"
                                                        href="#">Delete</a>
                                                    {{-- @endcan --}}
                                                    {{-- @can('payment edit') --}}
                                                    <a class="dropdown-item text-orange btn-sm" 
                                                        href="{{URL::route('status_show',$invoice->id)}}">Payment Edit</a>
                                                    {{-- @endcan --}}
                                                    {{-- @can('archive invoice') --}}
                                                    <a class="dropdown-item text-info btn-sm"
                                                        data-invoice_id="{{ $invoice->id }}"
                                                        data-toggle="modal"
                                                        data-target="#archive_invoice"
                                                        href="#">Archive</a>
                                                    {{-- @endcan --}}
                                                    {{-- @can('print invoice') --}}
                                                    <a class="dropdown-item text-primary btn-sm" 
                                                        href="{{route('print',$invoice->id)}}">Print</a>
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
        <div class="modal fade" id="delete_invoice" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">حذف المرفق</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{route('invoices.destroy',"test")}}" method="post">
                        @method('DELETE')
                        {{ csrf_field() }}
                        <div class="modal-body">
                            <p class="text-center">
                            <h6 style="color:red"> هل انت متاكد من عملية حذف المرفق ؟</h6>
                            </p>
                            
                            <input type="hidden" name="invoice_id" id="invoice_id" value="">
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
        <div class="modal fade" id="archive_invoice" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">حذف المرفق</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{route('invoices.destroy',"test")}}" method="post">
                        @method('DELETE')
                        {{ csrf_field() }}
                        <div class="modal-body">
                            <p class="text-center">
                            <h6 style="color:red"> هل انت متاكد من عملية حذف المرفق ؟</h6>
                            </p>
                            <input type="hidden" name="page_id" id="page_id" value="2">
                            <input type="hidden" name="invoice_id" id="invoice_id" value="">
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
        $('#delete_invoice').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var invoice_id = button.data('invoice_id')
            var modal = $(this)
            modal.find('.modal-body #invoice_id').val(invoice_id);
        })
    </script>
     <script>
        $('#archive_invoice').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var invoice_id = button.data('invoice_id')
            var modal = $(this)
            modal.find('.modal-body #invoice_id').val(invoice_id);
        })
    </script>
@endsection
