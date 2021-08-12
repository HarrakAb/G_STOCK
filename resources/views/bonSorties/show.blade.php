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
        .bord-l{
            border-left:0.15rem solid rgb(7, 6, 6);
        }
        .bor{
            line-height:3px !important;
        }
        .titre{
            position: relative;
            left: -42%;margin-top: 8%;
        }
        .color{
            background-color:white;
            padding:0 8px;
            padding-top:10px; 
            text-color:black
        }
        .top{
            margin-top: -6%;
            margin-left: -4%
        }
        .fl{
            left: -3% !important;
            position: relative;
        }
        .titr{
            margin-top:1.5%;
            color: #06334b
        }
        .titr1{
            margin-top: 1%;
            color: #06334b;
        }
        .font{
            font-size: 21px;
            font-weight: bold;
        }
        .fontt{
            font-size: 18px;
            
        }
        .ft-body{
            font-size: 21px;
            font-weight: bold;
        }
         .ft{
            font-size: 16px;
            font-weight: bold;
        }
        .fr{
            font-size:25px;
            font-weight: bold;
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
                        <div class="row" style="margin-bottom:6%">
                            <div class="col titr1">
                                <h5 class="">DRISS  ERRAHMA</h5>
                                <h5> Tel No: +212638332717</h5>
                                <h5> Tel No: +212634400411</h5>
                            </div>

                            <div class="col titr">
                                <h1 class="fl">بيع المواد الغذائية</h1>
                                <h5>وصل التسليم  /  bon de Livraison</h5>
                            </div>
                            <div class="col">
                                <div style="text-align: left" class="float-left top mt-3">
                                    <h6>برنامج تسيير المخزن من شركة : <span style="color: #070808">brm-informatique</span></h6>
                                    <a style="color: #070808" href="https://www.brm-informatique.net">www.brm-informatique.net</a>
                                    <p>
                                         0661327184 <i class="fas fa-phone-square-alt"></i>
                                    </p>
                                     <!-- <img alt="user-img"  src="log.png"> -->
                                </div>
                            </div>
                        </div>
                        <!-- invoice-header -->
                        <div class="row  mt-4" style="margin-bottom:-4%">
                            <div class="col-md">
                                <label class="font"> à / إلى : </label>
                                <div class="billed-to">
                                    <h4 class="font-weight-bold">{{ $bonSorties->client_name }}</h4>
                                    <h5 class="font-weight-bold">{{ $bonSorties->client_address }}<br>
                                    </h5>
                                </div>
                            </div>
                            <div class="col-md" style="position: relative;margin-left: -31%">
                                <label  style="position: relative; top: 13%" class="ft"> Détails / تفاصيل الفاتورة</label>
                                <p class="ft" style="position: relative; top: 10%"><span> N° de Bon / رقم الفاتورة &nbsp;&nbsp;:</span>
                                    <span class="ft"  style="position:relative;left: -3.5%">{{ $bonSorties->bon_number }}</span></p>
                                <p class="ft"><span> Date Du Bon / تاريخ الفاتورة &nbsp;&nbsp;:</span>
                                    <span class="ft">{{ $bonSorties->bon_date  }}</span>
                                </p>
                            </div>
                        </div>
                        <div class="table-responsive mg-t-40">
                            <table class="table table-invoice text-md-nowrap mb-0">
                                <thead class="bord">
                                    <tr style="background-color:rgb(238, 237, 237);" class="ft-body">
                                        <th class="tx-center " style="color:black; font-size: 23px;font-weight: bold;">Quantité / الكمية</th>
                                        <th class="tx-center bord" style="color:black; font-size: 23px;font-weight: bold;"> Designation / الوصف</th>
                                        <th class="tx-center bord" style="color:black; font-size: 23px;font-weight: bold;">Prix unitaire / ثمن الوحدة</th>
                                        <th class="tx-center bord" style="color:black; font-size: 23px;font-weight: bold;">Sous-Total / المبلغ الإجمالي للمنتوج</th>
                                    </tr>
                                </thead>
                                <tbody class="bord">
                                    @foreach ($bonSorties->bons as $item)
                                        <tr class="ft-body fx">
                                            <td style="font-size:25px;" class="tx-center bor">{{ $item->total_quantite }}</td>
                                            <td style="font-size:25px;width:40%;" class="tx-center bor">{{ $item->description }}</td>
                                            <td style="font-size:25px;" class="tx-center bor">{{ number_format($item->prix_unitaire, 2) }}</td>
                                            <td style="font-size:25px;" class="tx-center bor bord-l">{{ number_format($item->prix_total, 2) }}</td>
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
                                        <td style="margin-top: 3% !important; background-color:rgb(238, 237, 237);font-size:25px;" class="tx-center bord bord-b ft">Total / الاجمالي للفاتورة</td>
                                        <td style="margin-top: 3%; background-color:rgb(238, 237, 237);font-size:25px;" class="tx-center bord bord-b ft" colspan="2"> {{ number_format($bonSorties->total, 2) }}&nbsp;&nbsp;درهم/DH </td>
                                    </tr>
                                    <td style="margin-top: 3% !important; background-color:rgb(238, 237, 237);font-size:25px;" class="tx-center bord bord-b ft" colspan="1">الدفع  : {{ number_format($bonSorties->paid, 2) }}&nbsp;&nbsp;درهم/DH</td>
                                    <td style="margin-top: 3%; background-color:rgb(238, 237, 237);font-size:25px;" class="tx-center bord bord-b ft" colspan="">الباقي :  {{ number_format($bonSorties->rest, 2) }}&nbsp;&nbsp;درهم/DH </td>
                                    {{-- <tr>
                                        <td class="valign-middle" colspan="2" rowspan="4">
                                            <div class="invoice-notes">
                                                <label class="main-content-label tx-13"></label>

                                            </div><!-- invoice-notes -->
                                        </td>
                                        <td style="margin-top: 3% !important; background-color:rgb(238, 237, 237);color:black; font-size: 23px;font-weight: bold;" class="tx-center bord bord-b ft-body">الدفع  : {{ number_format($bonSorties->paid, 2) }}&nbsp;&nbsp;درهم/DH</td>
                                        <td style="margin-top: 3%; background-color:rgb(238, 237, 237);color:black; font-size: 23px;font-weight: bold;" step="any" class="tx-center bord bord-b ft" colspan="2">الباقي :  {{ number_format($bonSorties->rest, 2) }}&nbsp;&nbsp;درهم/DH </td>
                                    </tr> --}}
                                </tfoot>
                            </table>
                            <hr class="mg-b-40">
                            <br><br>
                            <h5>توقيع  : </h5>
                        </div>


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