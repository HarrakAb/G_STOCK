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
                        <div class="text-center color">
                            <h1 class="mt-1">Bon De Commande / الطلبات</h1>
                        </div><!-- invoice-header -->
                        @foreach ($clients as $client)
                            <h5 class="font-weight-bold mt-3">الزبون : {{$client->client}}</h5>                       
                        @endforeach
                        <div class="table-responsive mg-t-40">
                            <table class="table table-invoice text-md-nowrap mb-0">
                                <thead class="bord">
                                    <tr style="background-color:rgb(238, 237, 237);">
                                        <th class="tx-center bord">المنتوج</th>
                                        <th class="tx-center bord">ثمن الوحدة</th>
                                        <th class="tx-center bord">الوحدة / KG/Unité</th>
                                        <th class="tx-center bord">الكمية</th>
                                        <th class="tx-center bord"></th>
                                    </tr>
                                </thead>
                                <tbody class="bord">
                                    @foreach ($bonCommandes->bons as $item)
                                        <tr >
                                            <td class="tx-center bor">{{ $item->article }}</td>
                                            <td class="tx-center bor">{{ number_format($item->prix_unitaire,2) }}</td>
                                            <td class="tx-center bor">{{ $item->unite_mesure }}</td>
                                            <td class="tx-center bor">{{ $item->quantite }}</td>
                                            <td class="tx-center bor"><input type="checkbox"/></td>
                                        </tr>             
                                    @endforeach
                                </tbody> 
                                <tfoot>

                                </tfoot>
                            </table>
                        </div>
                        <hr class="mg-b-40">



                        <button class="btn btn-danger  float-left mt-3 mr-2" id="print_Button" onclick="printDiv()"> <i
                                class="mdi mdi-printer ml-1"></i>طباعة</button>
                        <a href="{{ url('/commande')}}" class="btn btn-primary  float-left mt-3 mr-2" id="print_Button"> <i
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