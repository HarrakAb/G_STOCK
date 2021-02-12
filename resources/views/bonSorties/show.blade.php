@extends('layouts.master')
@section('css')
    <style>
        @media print {
            #print_Button {
                display: none;
            }
        }
    </style>
@endsection
@section('title')
طباعة فاتورة
@stop
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">فواتير التصدير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    طباعة فاتورة</span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row row-sm">
        <div class="col-md-12 col-xl-12">
            <div class=" main-content-body-invoice" id="print">
                <div class="card card-invoice">
                    <div class="card-body">
                        <div class="invoice-header">
                            <h1 class="invoice-title">Bon de sortie</h1>
                            <div class="billed-from">
                                <label class="tx-gray-600">من :</label>
                                <h6>Nom du Magasin</h6>
                                <p>Address<br>
                                    Tel No: 0600000000<br>
                                </p>
                            </div><!-- billed-from  من -->
                        </div><!-- invoice-header -->
                        <div class="row mg-t-20">
                            <div class="col-md">
                                <label class="tx-gray-600">إلى :</label>
                                <div class="billed-to">
                                    <h6>{{ $bonSorties->client_name }}</h6>
                                    <p>{{ $bonSorties->client_address }}<br>
                                        Tel No: {{ $bonSorties->client_phone }}<br>
                                    </p>
                                </div>
                            </div>
                            <div class="col-md">
                                <label class="tx-gray-600">تفاصيل الفاتورة</label>
                                <p class="invoice-info-row"><span>رقم الفاتورة</span>
                                    <span>{{ $bonSorties->bon_number }}</span></p>
                                <p class="invoice-info-row"><span>تاريخ الفاتورة</span>
                                    <span>{{ $bonSorties->bon_date  }}</span>
                                </p>
                            </div>
                        </div>
                        <div class="table-responsive mg-t-40">
                            <table class="table table-invoice border text-md-nowrap mb-0">
                                <thead>
                                    <tr  style="background-color:rgb(209, 205, 205);">
                                        <th class="tx-center">المنتوج</th>
                                        <th class="tx-center">الكمية</th>
                                        <th class="tx-right">ثمن الوحدة</th>
                                        <th class="tx-center">المبلغ الإجمالي للمنتوج</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($bonSorties->bons as $item)
                                        <tr>
                                            <td class="tx-center">{{ $item->article }}</td>
                                            <td class="tx-center">{{ $item->quantite }}</td>
                                            <td class="tx-right">{{ number_format($item->prix_unitaire, 2) }}</td>
                                            <td class="tx-center">{{ number_format($item->prix_total, 2) }}</td>
                                        </tr>             
                                    @endforeach

                                     <tr>
                                        <td class="valign-middle" colspan="2" rowspan="4">
                                            <div class="invoice-notes">
                                                <label class="main-content-label tx-13"></label>

                                            </div><!-- invoice-notes -->
                                        </td>
                                        <td style="margin-top: 3% !important; background-color:rgb(209, 205, 205);" class="tx-right">الاجمالي للفاتورة</td>
                                        <td style="margin-top: 3%; background-color:rgb(209, 205, 205);" class="tx-right bg-gray" colspan="2"> {{ number_format($bonSorties->total, 2) }}</td>
                                    </tr>
                                </tbody> 
                            </table>
                        </div>
                        <hr class="mg-b-40">



                        <button class="btn btn-danger  float-left mt-3 mr-2" id="print_Button" onclick="printDiv()"> <i
                                class="mdi mdi-printer ml-1"></i>طباعة</button>
                        <a href="{{ url('/bonSorties')}}" class="btn btn-primary  float-left mt-3 mr-2" id="print_Button"> <i
                                    class="fa fa-home ml-1"></i>رجوع</a>
                    </div>
                </div>
            </div>
        </div><!-- COL-END -->
    </div>
    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    <!--Internal  Chart.bundle js -->
    <script src="{{ URL::asset('assets/plugins/chart.js/Chart.bundle.min.js') }}"></script>


    <script type="text/javascript">
        function printDiv() {
            var printContents = document.getElementById('print').innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
            location.reload();
        }
    </script>

@endsection