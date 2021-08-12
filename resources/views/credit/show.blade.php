@extends('layouts.master')
@section('css')
    <style>
        @media print {
            #print_Button {
                display: none;
            }
          
        }
        .bord{
            border:0.15rem solid rgb(7, 6, 6);
        }
        .bord-b{
            border-bottom:0.15rem solid rgb(7, 6, 6);
        }
        .bor{
            line-height:3px !important;
        }
        .titre{
            position: relative;
            left: -42%;margin-top: 8%;
        }
        .color{
            background-color: rgb(238, 237, 237);
            padding:0 8px;
            padding-top:10px; 
            text-color:black
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
                    <div class="card-body" >
                        <div class="invoice-header color">
                            <h1 class="mt-1">بيع المواد الغذائية</h1>
                            <h6 class="invoice-title titre">bon de Livraison / وصل التسليم </h6>
                            <div class="billed-from">
                                <label class="tx-gray-700">De / من :</label>
                                <p>DRISS</p>
                                <p>ERRAHMA<br>
                                    Tel No: +212638332717<br>
                                </p>
                            </div><!-- billed-from  من -->
                        </div><!-- invoice-header -->
                        <div class="row mg-t-20">
                            <div class="col-md">
                                <label class="tx-gray-700"> à / إلى : </label>
                                <div class="billed-to">
                                    <p>{{ $bon_sorties->client_name }}</p>
                                    <p>{{ $bon_sorties->client_address }}<br>
                                       <br>
                                    </p>
                                </div>
                            </div>
                            <div class="col-md">
                                <label class=""> Détails / تفاصيل الفاتورة</label>
                                <p class="invoice-info-row"><span> N° de Bon / رقم الفاتورة &nbsp;&nbsp;:</span>
                                    <span>{{ $bon_sorties->bon_number }}</span></p>
                                <p class="invoice-info-row"><span> Date Du Bon / تاريخ الفاتورة &nbsp;&nbsp;:</span>
                                    <span>{{ $bon_sorties->bon_date  }}</span>
                                </p>
                            </div>
                        </div>
                        <div class="table-responsive mg-t-40">
                            <table class="table table-invoice text-md-nowrap mb-0">
                                <thead class="bord">
                                    <tr style="background-color:rgb(238, 237, 237);">
                                        <th class="tx-center bord"> Produit / المنتوج</th>
                                        <th class="tx-center bord"> Designation / الوصف</th>
                                        <th class="tx-center bord">Quantité / الكمية</th>
                                        <th class="tx-center bord">Prix unitaire / ثمن الوحدة</th>
                                        <th class="tx-center bord">Sous-Total / المبلغ الإجمالي للمنتوج</th>
                                    </tr>
                                </thead>
                                <tbody class="bord">
                                    @foreach ($bon_sorties->bons as $item)
                                        <tr >
                                            <td class="tx-center bor">{{ $item->article }}</td>
                                            <td class="tx-center bor">{{ $item->description }}</td>
                                            <td class="tx-center bor">{{ $item->total_quantite }}</td>
                                            <td class="tx-center bor">{{ number_format($item->prix_unitaire, 2) }}</td>
                                            <td class="tx-center bor">{{ number_format($item->prix_total, 2) }}</td>
                                        </tr>             
                                    @endforeach
                                </tbody> 
                                <tfoot>
                                     <tr>
                                        <td class="valign-middle" colspan="2" rowspan="4">
                                            <div class="invoice-notes">
                                                <label class="main-content-label tx-13"></label>

                                            </div><!-- invoice-notes -->
                                        </td>
                                        <td style="margin-top: 3% !important; background-color:rgb(238, 237, 237);" class="tx-center bord bord-b">Total / الاجمالي للفاتورة</td>
                                        <td style="margin-top: 3%; background-color:rgb(238, 237, 237);" class="tx-center bord bord-b" colspan="2"> {{ number_format($bon_sorties->total, 2) }}&nbsp;&nbsp;درهم/DH </td>
                                    </tr>
                                    <td style="margin-top: 3% !important; background-color:rgb(238, 237, 237);" class="tx-center bord bord-b" colspan="1">الدفع  : {{ number_format($bon_sorties->paid, 2) }}&nbsp;&nbsp;درهم/DH</td>
                                    <td style="margin-top: 3%; background-color:rgb(238, 237, 237);" class="tx-center bord bord-b" colspan="2">الباقي :  {{ number_format($bon_sorties->rest, 2) }}&nbsp;&nbsp;درهم/DH </td>
                                </tfoot>
                            </table>
                            <hr class="mg-b-40">
                            <br><br>
                            <h5>توقيع  : </h5>
                        </div>


                        <button class="btn btn-danger  float-left mt-3 mr-2" id="print_Button" onclick="printDiv()"> <i
                                class="mdi mdi-printer ml-1"></i>طباعة</button>
                        <a href="{{ url()->previous() }}" class="btn btn-primary  float-left mt-3 mr-2" id="print_Button"> <i
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