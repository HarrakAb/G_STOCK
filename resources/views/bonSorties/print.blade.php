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
    Consultation de l'impression
@stop
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">Les bons de sortie</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    Consultation de l'impression</span>
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
                                <h6>Bouskoura</h6>
                                <p>DR LAAMAMRA OULED SALEH<br>
                                    Tel No: 06.14.24.36.21<br>
                                    Email: abdoharrak940@gmail.com</p>
                            </div><!-- billed-from -->
                        </div><!-- invoice-header -->
                        <div class="row mg-t-20">
                            <div class="col-md">
                                <label class="tx-gray-600">Envoyer à :</label>
                                <div class="billed-to">
                                    <h6>HARRAK ABDELILAH</h6>
                                    <p>CASABLANCA , CENTRE VILLE<br>
                                        Tel No: 06.14.24.36.21<br>
                                        Email: abdoharrak940@gmail.com</p>
                                </div>
                            </div>
                            <div class="col-md">
                                <label class="tx-gray-600">Bon Details</label>
                                <p class="invoice-info-row"><span>N° du Bon</span>
                                    <span>{{ $bonSorties->bon_number }}</span></p>
                                <p class="invoice-info-row"><span>Date d'Entree</span>
                                    <span>{{ $bonSorties->bon_date  }}</span></p>
                                <p class="invoice-info-row"><span>القسم</span>
                                    <span>{{ $bonSorties->categorie->categorie_name }}</span></p>
                            </div>
                        </div>
                        <div class="table-responsive mg-t-40">
                            <table class="table table-invoice border text-md-nowrap mb-0">
                                <thead>
                                    <tr>
                                        <th class="wd-20p">#</th>
                                        <th class="wd-40p">Article</th>
                                        <th class="tx-center">Quantité</th>
                                        <th class="tx-right">Prix Unitaire</th>
                                        <th class="tx-right">Prix Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   <tr>
                                        <td>{{ $bonSorties->id }}</td>
                                        <td class="tx-12">{{ $bonSorties->article }}</td>
                                        <td class="tx-center">{{ $bonSorties->quantite }}</td>
                                        <td class="tx-right">{{ number_format($bonSorties->prix_unitaire, 2) }}</td>
                                        <td class="tx-right">{{ number_format($bonSorties->prix_total, 2) }}</td>
                                    </tr>

                                     {{-- <tr>
                                        <td class="valign-middle" colspan="2" rowspan="4">
                                            <div class="invoice-notes">
                                                <label class="main-content-label tx-13">#</label>

                                            </div><!-- invoice-notes -->
                                        </td>
                                        <td class="tx-right">الاجمالي</td>
                                        <td class="tx-right" colspan="2"> {{ number_format($total, 2) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="tx-right">نسبة الضريبة ({{ $invoices->Rate_VAT }})</td>
                                        <td class="tx-right" colspan="2">287.50</td>
                                    </tr>
                                    <tr>
                                        <td class="tx-right">قيمة الخصم</td>
                                        <td class="tx-right" colspan="2"> {{ number_format($invoices->Discount, 2) }}</td>

                                    </tr>
                                    <tr>
                                        <td class="tx-right tx-uppercase tx-bold tx-inverse">الاجمالي شامل الضريبة</td>
                                        <td class="tx-right" colspan="2">
                                            <h4 class="tx-primary tx-bold">{{ number_format($invoices->Total, 2) }}</h4>
                                        </td>
                                    </tr> --}}
                                </tbody> 
                            </table>
                        </div>
                        <hr class="mg-b-40">



                        <button class="btn btn-danger  float-left mt-3 mr-2" id="print_Button" onclick="printDiv()"> <i
                                class="mdi mdi-printer ml-1"></i>Imprimer</button>
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