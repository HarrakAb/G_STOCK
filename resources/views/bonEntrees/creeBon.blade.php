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
    إظافة فاتورة
@stop

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">فواتير الإستراد</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">
                    إظافة فاتورة</span>
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

                    <form id="bon" action="{{ route('bonEntrees.store') }}" method="post" enctype="multipart/form-data"
                        autocomplete="off">
                        @csrf
                        {{-- 1 --}}
                        <div class="row mt-2">
                            <div class="col">
                                <label for="bon_number" class="control-label">رقم الفاتورة</label>
                                <input type="text" class="form-control" name="bon_number"
                                    value="{{ $bon_number  }}"   title="entrée le numéro de votre bon" required readonly>
                                    @error('bon_number')<span class="help-block text-danger">{{ $message }}</span>@enderror

                            </div>
                            <div class="col">
                                <label>تاريخ الفاتورة</label>
                                <input class="form-control fc-datepicker" name="bon_date" placeholder="YYYY-MM-DD"
                                      type="text" value="{{ date('Y-m-d') }}" required>
                                    @error('bon_date')<span class="help-block text-danger">{{ $message }}</span>@enderror

                            </div>
                            <div class="col">
                                <label for="client_name" class="control-label">إسم المورّد</label>
                                <select id="client_name" name="client_name" class="form-control custom_select client_name" required>
                                    <option value="" selected disabled>إسم المورّد</option>
                                        @foreach ($fournisseurs as $fournisseur)
                                            <option value="{{ $fournisseur->full_name }}">
                                                {{ $fournisseur->full_name }}</option>
                                        @endforeach
                                </select>
                                {{-- <input type="text" class="form-control" name="client_name" title="entrée le nom de client"
                                        value="{{ old('client_name') }}"  required>
                                    @error('client_name')<span class="help-block text-danger">{{ $message }}</span>@enderror --}}

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
                                        <th class="border-bottom-0">الوصف</th>
                                        <th class="border-bottom-0">الوحدة</th>
                                        <th class="border-bottom-0">الكمية</th>
                                        <th class="border-bottom-0">إجمالي الكمية</th>
                                        <th class="border-bottom-0">ثمن الوحدة</th>
                                        <th class="border-bottom-0"> المبلغ الإجمالي للمنتوج</th>
                                        <th class="border-bottom-0">
                                            <a href="#" class="btn btn-success btn-sm addRow"><i class="fa fa-plus"></i></a>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="addMoreArticle">
                                    <tr>
                                        <td>
                                            1
                                        </td>
                                        <td style="width:15%"> 
                                            <select id="article" name="article[]" class="form-control article" required>
                                                <option value="" selected disabled>إختر المنتوج</option>
                                                @foreach ($articles as $article)
                                                    <option value="{{ $article->reference }}">
                                                        {{ $article->reference }}</option>
                                                @endforeach
                                            </select>
                                            @error('article')<span class="help-block text-danger">{{ $message }}</span>@enderror

                                        </td>
                                        <td style="width:15%">
                                            <input type="hidden" name="description_id" class="description_id"  id="description_id" value="1">
                                            <input type="text" name="description[]" class="form-control description" id="description1" readonly required/>
                                            @error('description')<span class="help-block text-danger">{{ $message }}</span>@enderror
                                        </td>
                                        <td style="width:10%">
                                            <input type="number" name="unite_mesure" class="form-control unite_mesure" id="unite_mesure1" readonly required/>
                                        </td>            
                                        <td style="width:15%">
                                            <input type="hidden" name="unite_mesure_id" class="form-control unite_mesure_id" id="unite_mesure_id" value="1" required/>
                                            <input type="number" value="{{ old('quantite[]') }}"  name="quantite[]" class="form-control quantite" id="quantite" required/>
                                            @error('quantite')<span class="help-block text-danger">{{ $message }}</span>@enderror                           
                                        </td>
                                        <td style="width:15%">
                                            <input type="number" value="0" name="total_quantite[]" class="form-control total_quantite" id="total_quantite" readonly required/>
                                            @error('total_quantite')<span class="help-block text-danger">{{ $message }}</span>@enderror
                                        </td>
                                        <td style="width:15%">
                                            <input type="number" name="prix_unitaire[]" step="any" value="{{ old('prix_unitaire[]') }}" 
                                                class="form-control prix_unitaire" id="prix_unitaire" required/>
                                                @error('prix_unitaire')<span class="help-block text-danger">{{ $message }}</span>@enderror

                                        </td>
                                        <td style="width:15%">
                                            <input type="number" name="prix_total[]" value="0.00" class="form-control prix_total"
                                                readonly id="prix_total"/>
                                        </td>
                                        <td>
                                            <a href="#" class="btn btn-danger btn-sm"><i class="fa fa-times"></i></a>
                                        </td>

                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        {{-- 4 --}}

                        <div class="row">
                            <div class="col-8"></div>
                            <div class="col-4 float-right ">
                                <label for="inputName" class="control-label"> المبلغ الإجمالي للفاتورة</label>
                                <input type="text" class="form-control total" id="total" name="total" value="0.00" readonly>
                            </div>
                        </div>

                        <div class="d-flex justify-content-center mt-2">
                            <button type="submit" class="btn btn-primary">حفظ</button>
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
                '<td style="width:15%"><select id="article" class="form-control SelectBox article" name="article[]">' +
                '<option value="" selected disabled>إختر المنتوج</option>' + 
                ' @foreach ($articles as $article)' +
                '  <option value="{{ $article->reference }}"> '+
                ' {{ $article->reference }}</option> ' +
                ' @endforeach '+
                '</select></td>' +
                '<td style="width:15%"><input type="hidden" name="description_id" class="description_id"  id="description_id" value="'+numberOfRow+'"><input type="text" data-description_id="'+numberOfRow+'" name="description[]" class="form-control description" id="description'+numberOfRow+'" readonly required/>@error("description")<span class="help-block text-danger">{{ $message }}</span>@enderror</td>'+
                '<td style="width:10%"><input type="number" name="unite_mesure" class="form-control unite_mesure" id="unite_mesure'+numberOfRow+'" readonly required/></td>'+
                '<td style="width:15%"><input type="number" name="quantite[]" class="form-control quantite" id="quantite"/><input type="hidden" name="unite_mesure_id" class="form-control unite_mesure_id" id="unite_mesure_id" value="'+numberOfRow+'" required/></td>' +
                '<td style="width:15%"><input type="number" value="0"  name="total_quantite[]" class="form-control total_quantite" id="total_quantite" readonly required/>@error("total_quantite")<span class="help-block text-danger">{{ $message }}</span>@enderror</td>'+
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
        $(document).ready(function(){

            $('#bon').on('keyup blur', '.quantite', function(){
                let row = $(this).closest('tr');
                let quantity = row.find('.quantite').val() || 0;
                let unite_mesure = row.find('.unite_mesure').val() || 0;

                row.find('.total_quantite').val((quantity * unite_mesure));
                TotalAmount();
            });


        });


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

             ///////////  get Description and Unite_mesure of Product ////

             $(document).on('change', 'select[name="article[]"]', function(){

                let row = $(this).closest('tr');
                let description_id = row.find('#description_id').val();
                let unite_mesure_id = row.find('#unite_mesure_id').val();
                var reference = $(this).val();
                var url = "{{ URL::to('article') }}/" + reference;
                //console.log(description_id);
                $.ajax({
                    url: url,
                    type: 'get',
                    dataType: 'json',
                    success: function(response){
                        if(response != null){
                            $('#description'+description_id).val(response.description);
                            $('#unite_mesure'+unite_mesure_id).val(response.unite_mesure);
                        }
                    }
                });
            });

    </script>
@endsection
