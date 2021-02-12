@extends('layouts.master')
@section('css')
    <!--- Internal Select2 css-->
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <!---Internal Fileupload css-->
    <link href="{{ URL::asset('assets/plugins/fileuploads/css/fileupload.css') }}" rel="stylesheet" type="text/css" />
    <!---Internal Fancy uploader css-->
    <link href="{{ URL::asset('assets/plugins/fancyuploder/fancy_fileupload.css') }}" rel="stylesheet" />
    <!--Internal Sumoselect css-->
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/sumoselect/sumoselect-rtl.css') }}">
    <!--Internal  TelephoneInput css-->
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/telephoneinput/telephoneinput-rtl.css') }}">


@endsection
@section('title')
تعديل فاتورة
@stop

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">فواتير الإستراد</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">
                    تعديل فاتورة</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')

    @if (session()->has('Add'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('Add') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <!-- row -->
    <div class="row">

        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">

                    <form id="bon" action="{{ route('bonEntrees.update' , $bonEntrees->id) }}" method="post" enctype="multipart/form-data"
                        autocomplete="off">
                        @csrf
                        @method('PUT')
                        {{-- 1 --}}
                        <div class="row mt-2">
                            <div class="col">
                                <label for="bon_number" class="control-label">رقم الفاتورة</label>
                                <input type="text" class="form-control" name="bon_number"
                                    title="entrée le numéro de votre bon" value="{{ old('bon_number' , $bonEntrees->bon_number )}}" required>
                            </div>
                            <div class="col">
                                <label>تاريخ الفاتورة</label>
                                <input class="form-control fc-datepicker" name="bon_date" placeholder="YYYY-MM-DD"
                                    type="text" value="{{ old('bon_date', $bonEntrees->bon_date ) }}"  required>
                            </div>
                            <div class="col">
                                <label for="client_name" class="control-label">إسم الزبون</label>
                                <input type="text" class="form-control" name="client_name" title="entrée le nom de client"
                                        value="{{ old('client_name', $bonEntrees->client_name ) }}"   required>
                            </div>

                        </div>
                        </br>
                        {{-- 2 --}}
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordred key-buttons text-md-nowrap"
                                data-page-length='10' style="text-align: center">
                                <thead>
                                    <tr>
                                        <th class="border-bottom-0"></th>
                                        <th class="border-bottom-0">المنتوج</th>
                                        <th class="border-bottom-0">الكمية</th>
                                        <th class="border-bottom-0">ثمن الوحدة</th>
                                        <th class="border-bottom-0"> المبلغ الإجمالي للمنتوج</th>
                                        <th class="border-bottom-0">
                                            <a href="#" class="btn btn-success btn-sm addRow"><i class="fa fa-plus"></i></a>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="addMoreArticle">
                                    @foreach ($bonEntrees->bons as $item)
              
                                    <tr>
                                        <td>
                                            1
                                        </td>
                                        <td>
                                            <select id="article" name="article[{{$loop->index}}]" class="form-control article" >
                                                <option value="" selected disabled>{{ $item->article}}</option>
                                                @foreach ($articles as $article)
                                                    <option value="{{ $article->reference }}">
                                                        {{ $article->reference}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td style="width:15%">
                                            <input type="number" name="quantite[{{$loop->index}}]" value="{{ old('quantite', $item->quantite ) }}" class="form-control quantite" id="quantite"/>
                                        </td>
                                        <td style="width:15%">
                                            <input type="number" name="prix_unitaire[{{$loop->index}}]" value="{{ old('prix_unitaire', $item->prix_unitaire ) }}"
                                                class="form-control prix_unitaire" id="prix_unitaire"/>
                                        </td>
                                        <td style="width:15%">
                                            <input type="number" name="prix_total[{{$loop->index}}]" value="{{ old('prix_total', $item->prix_total ) }}" class="form-control prix_total"
                                                readonly id="prix_total"/>
                                        </td>
                                        <td>
                                            <a href="#" class="btn btn-danger btn-sm"><i class="fa fa-times"></i></a>
                                        </td>

                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        {{-- 4 --}}

                        <div class="row">
                            <div class="col-8"></div>
                            <div class="col-4 float-right ">
                                <label for="inputName" class="control-label"> المبلغ الإجمالي للفاتورة</label>
                                <input type="text" class="form-control total" id="total" name="total" value="{{ old('total', $bonEntrees->total ) }}" readonly>
                            </div>
                        </div>

                        <div class="d-flex justify-content-center mt-2">
                            <button type="submit" class="btn btn-primary">تعديل</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    </div>

    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')

    <!-- Internal Select2 js-->
    <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <!--Internal Fileuploads js-->
    <script src="{{ URL::asset('assets/plugins/fileuploads/js/fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fileuploads/js/file-upload.js') }}"></script>
    <!--Internal Fancy uploader js-->
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.ui.widget.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.iframe-transport.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fancy-fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/fancy-uploader.js') }}"></script>
    <!--Internal  Form-elements js-->
    <script src="{{ URL::asset('assets/js/advanced-form-elements.js') }}"></script>
    <script src="{{ URL::asset('assets/js/select2.js') }}"></script>
    <!--Internal Sumoselect js-->
    <script src="{{ URL::asset('assets/plugins/sumoselect/jquery.sumoselect.js') }}"></script>
    <!--Internal  Datepicker js -->
    <script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <!--Internal  jquery.maskedinput js -->
    <script src="{{ URL::asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js') }}"></script>
    <!--Internal  spectrum-colorpicker js -->
    <script src="{{ URL::asset('assets/plugins/spectrum-colorpicker/spectrum.js') }}"></script>
    <!-- Internal form-elements js -->
    <script src="{{ URL::asset('assets/js/form-elements.js') }}"></script>

    <script>
        $(document).ready(function(){
            var categorie = $('.categorie').html();
            console.log(categorie);
        })
        // add Row function //

        $('.addRow').on('click', function() {
            var categorie = $('.categorie').html();
            var numberOfRow = ($('.addMoreArticle tr').length - 0) + 1;
            var tr = '<tr><td class="no">' + numberOfRow + '</td>' +
                '<td><select id="article" class="form-control SelectBox" name="article[]">' +
                ' onclick="console.log($(this).val())" '+
                '<option value="" selected disabled>إختر المنتوج</option>' + 
                ' @foreach ($articles as $article)' +
                '  <option value="{{ $article->reference }}"> '+
                ' {{ $article->reference }}</option> ' +
                ' @endforeach '+
                '</select></td>' +
                '<td style="width:15%"><input type="number" name="quantite[]" class="form-control quantite" id="quantite"/></td>' +
                '<td style="width:15%"><input type="number" name="prix_unitaire[]" class="form-control prix_unitaire" id="prix_unitaire"/></td>' +
                '<td style="width:15%"><input type="number" name="prix_total[]" class="form-control prix_total" value="0.00" id="prix_total" readonly/></td>' +
                '<td><a href="#" class="btn btn-danger btn-sm delete"><i class="fa fa-times"></i></a></td>';
            $('.addMoreArticle').append(tr);
        });

        // end add Row function //

        // delete function //

        $('.addMoreArticle').delegate('.delete', 'click', function() {
            $(this).parent().parent().remove();
        });

        //  end delete function //

        // Total and sub Total //
        //total//
        function TotalAmount() {

            var total = 0;
            $('.prix_total').each(function(i, e) {
                var amount = $(this).val() - 0;
                total += amount;
            });
            $('.total').val((total).toFixed(2));

        };
        //subTotal
        $(document).ready(function(){

            $('#bon').on('keyup blur', '.quantite, .prix_unitaire', function(){
                let row = $(this).closest('tr');
                let quantity = row.find('.quantite').val() || 0;
                let unit_price = row.find('.prix_unitaire').val() || 0;

                row.find('.prix_total').val((quantity * unit_price).toFixed(2));
                TotalAmount();
            });


        })


        // end Total and sub Total //

  
        // datePicker
        var date = $('.fc-datepicker').datepicker({
            dateFormat: 'yy-mm-dd'
        }).val();


        // AjAx method
        $(document).ready(function() {
            $('#categorie').on('change', function() {
                var categorieId = $(this).val();
                if (categorieId) {
                    $.ajax({
                        url: "{{ URL::to('categorie') }}/" + categorieId,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('#article').empty();
                            $.each(data, function(key, value) {
                                $('#article').append('<option value="' +
                                    value + '">' + value + '</option>');
                            });
                        },
                    });
                } else {
                    console.log('AJAX load did not work');
                }
            });
        });

    </script>
@endsection
