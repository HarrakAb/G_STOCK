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

<style>
     .ft{
            font-size: 20px;
            font-weight: bold;
        }
</style>
@endsection
@section('title')
    إظافة فاتورة
@stop

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">فواتير التصدير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">
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
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <!-- row -->
    <div class="row">

        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">

                    <form id="bon" action="{{ route('bonSorties.store') }}" method="post" enctype="multipart/form-data"
                        autocomplete="off">
                        {{ csrf_field() }}
                        {{-- 1 --}}
                        <div class="row mt-2">
                            <div class="col">
                                <label for="bon_number" class="control-label">رقم الفاتورة</label>
                                <input type="text" class="form-control" name="bon_number"
                                    title="entrée le numéro de votre bon" value="{{ $bon_number  }}" required readonly>
                                    @error('bon_number')<span class="help-block text-danger">{{ $message }}</span>@enderror

                            </div>
                            <div class="col">
                                <label>تاريخ الفاتورة</label>
                                <input class="form-control fc-datepicker" name="bon_date" placeholder="YYYY-MM-DD"
                                    type="text" value="{{ date('Y-m-d') }}" required>
                                    @error('bon_date')<span class="help-block text-danger">{{ $message }}</span>@enderror

                            </div>
                           
                            <div class="col">
                                <label>إسم الزبون</label>
                                
                                {{-- <select id="client_name" name="client_name" class="form-control form-control-lg client_name" required>
                                    <input type="text" class="form-control" name="client_name" placeholder="search">
                                    <option value="" selected disabled>إسم الزبون</option>
                                    @foreach ($clients as $client) 
                                    <option value="{{ $client->full_name }}">
                                        {{ $client->full_name }}</option>
                                        @endforeach
                                </select>  --}}
                                    <livewire:get-client-name>
                            </div>

                            <div>
                                <input  id="code" class="form-control"  name="code_client" type="hidden" required readonly> 
                                @error('client_address')<span class="help-block text-danger">{{ $message }}</span>@enderror     
                            </div>
                        
                            <div class="col-3" >
                                <label>عنوان الزبون</label>
                                <input  id="address" class="form-control"  name="client_address" type="text" required readonly> 
                                @error('client_address')<span class="help-block text-danger">{{ $message }}</span>@enderror     
                            </div>

                            <div class="col">
                                <label>هاتف الزبون</label>
                                <input id="phone" class="form-control"  name="client_phone" type="text"  readonly>
                                @error('client_phone')<span class="help-block text-danger">{{ $message }}</span>@enderror

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
                                        <th class="border-bottom-0">المتوفر</th>
                                        <th class="border-bottom-0">الوحدة</th>
                                        <th class="border-bottom-0">الكمية</th>
                                        <th class="border-bottom-0">إجمالي الكمية</th>
                                        <th class="border-bottom-0">ثمن الوحدة</th>
                                        <th class="border-bottom-0"> المبلغ الإجمالي للمنتوج</th>
                                        {{-- <th class="border-bottom-0">الباقي في المخزون</th> --}}
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
                                                {{-- <livewire:get-product-name> --}}
                                                @livewire('get-product-name')

                                                {{-- <div id="newSearch"></div>
                                                <select id="descriptionS1" class="form-control form-control-lg SelectBox description" name="description[]"> 
                                                    <option value="" selected disabled>إختر المنتوج</option>  
                                                </select>
                                                <div style="position:relative">
                                                    <input  class="form-control relative" type="text" id="ser" 
                                                    placeholder="search..." />
                                                </div> --}}

                                            {{-- <select style="overflow:scroll !important;" id="description" name="description[]" class="form-control form-control-lg description" required>
                                                <option value="" selected disabled>إختر المنتوج</option>
                                                @foreach ($articles as $article)
                                                    <option value="{{ $article->description }}">
                                                        {{ $article->description }}</option>
                                                @endforeach
                                            </select> --}}
                                            @error('description')<span class="help-block text-danger">{{ $message }}</span>@enderror
                                        </td>
                                        <td style="width:15%">
                                            <input type="hidden" name="article_id" class="article_id"  id="article_id" value="1">
                                            <input type="hidden" name="article[]" class="form-control article" id="article1" readonly required/>
                                            <input type="hidden" name="stock_id" class="stock_id"  id="stock_id" value="1">
                                            <input type="text" name="instock[]" class="form-control stock" id="stock1" readonly required/>
                                            @error('article')<span class="help-block text-danger">{{ $message }}</span>@enderror
                                        </td>
                                        <td style="width: 10%">
                                            <input type="number" name="unite_mesure" class="form-control unite_mesure" id="unite_mesure1" readonly required/>
                                        </td>
                                        <td style="width:10%">
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
                        
                        <div class="paid">                      
                            <div class="row">
                                <div class="col-9"></div>
                                <div class="col-3 float-right ">
                                    <label for="inputName" class="control-label"> المبلغ الإجمالي للفاتورة</label>
                                    <input type="text" class="form-control total" id="total" name="total" value="0.00" readonly>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-6"></div>
                                <div class="col-3 float-right ">
                                    <label for="inputName" class="control-label text-success"> الدفع</label>
                                    <input type="number" class="form-control" step="any" id="paid" name="paid" placeholder="الدفع">
                                </div>
                                <div class="col-3 float-right ">
                                    <label for="inputName" class="control-label text-danger">الباقي</label>
                                    <input type="number" class="form-control" step="any" id="rest" name="rest" placeholder="الباقي">
                                </div>
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
            var numberOfR= ($('.addMoreArticle tr').length - 0) + 1;
            // let numberOfR = 2;
            var tr = '<tr><td class="no">' + numberOfRow + '</td>' +
                '<td style="width:15%"> '+
                '<select id="descriptionS'+numberOfRow+'" name="descriptionn[]" class="form-control form-control-lg SelectBox description" >' +
                '</select>'+ 
                '<div style="position:relative">'+
                '<input  class="form-control relative" type="text" id="ser" '+
                'placeholder="search..." /></div>'+
                '</td>' +
                '<td style="width:15%"><input type="hidden" name="article_id" class="article_id"  id="article_id" value="'+numberOfRow+'"><input type="hidden" data-article_id="'+numberOfRow+'" name="article[]" class="form-control article" id="article'+numberOfRow+'" readonly required/>'+
                ' <input type="hidden" name="stock_id" class="stock_id"  id="stock_id" value="'+numberOfRow+'"><input type="text" name="instock[]" ata-stock_id="'+numberOfRow+'" class="form-control stock" id="stock'+numberOfRow+'" readonly required/>'+
                '@error("article")<span class="help-block text-danger">{{ $message }}</span>@enderror</td>'+
                '<td style="width:10%"><input type="number" name="unite_mesure" class="form-control unite_mesure" id="unite_mesure'+numberOfRow+'" readonly required/></td>'+
                '<td style="width:15%"><input type="number" name="quantite[]" class="form-control quantite" id="quantite"/><input type="hidden" name="unite_mesure_id" class="form-control unite_mesure_id" id="unite_mesure_id" value="'+numberOfRow+'" required/></td>' +
                '<td style="width:15%"><input type="number" value="0"  name="total_quantite[]" class="form-control total_quantite" id="total_quantite" readonly required/>@error("total_quantite")<span class="help-block text-danger">{{ $message }}</span>@enderror</td>'+
                '<td style="width:15%"><input type="number" name="prix_unitaire[]" step="any" class="form-control prix_unitaire" id="prix_unitaire"/></td>' +
                '<td style="width:15%"><input type="number" name="prix_total[]" class="form-control prix_total" value="0.00" id="prix_total" readonly/></td>' +
                '<td><a href="#" class="btn btn-danger btn-sm delete"><i class="fa fa-times"></i></a></td>';
            $('.addMoreArticle').append(tr);
        });

        //// delete row function

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
        $(document).ready(function(){
            $('#bon').on('keyup blur', '.quantite', function(){
                let row = $(this).closest('tr');
                let quantity = row.find('.quantite').val() || 0;
                let unite_mesure = row.find('.unite_mesure').val() || 0;

                row.find('.total_quantite').val((quantity * unite_mesure));
                TotalAmount();
            });
        });

        //paid and rest payment
        $(document).ready(function(){
            $('#paid').on('keyup blur', function(){
                let row = $(this).closest('.paid');
                let total = row.find('#total').val() || 0;
                let paid = row.find('#paid').val() || 0;
                row.find('#rest').val((total - paid).toFixed(2));
            });
        });
  
        // datePicker
        var date = $('.fc-datepicker').datepicker({
            dateFormat: 'yy-mm-dd'
        }).val();

    ///////////  get Address and Phone of Customer ////

        $('select[name="client_name"]').change(function(){
            var name = $(this).val();
            var url = "{{ URL::to('client') }}/" + name;
            $.ajax({
                url: url,
                type: 'get',
                dataType: 'json',
                success: function(response){
                    if(response != null){
                        $('#address').val(response.address);
                        $('#phone').val(response.phone);
                        $('#code').val(response.code_client);
                    }
                }
            });
        });

     ///////////  get Description of Product ////

     $(document).on('change', 'select[name="description[]"]', function(){

        let row = $(this).closest('tr');
        let inStock = " في المخزن "; 
        let article_id = row.find('#article_id').val();
        let stock_id = row.find('#stock_id').val();
        let unite_mesure_id = row.find('#unite_mesure_id').val();
        var description = $(this).val();
        var url = "{{ URL::to('article') }}/" + description;
        // console.log(description);
        $.ajax({
            url: url,
            type: 'get',
            dataType: 'json',
            success: function(response){
                if(response != null){
                    $('#article'+article_id).val(response.reference);
                    $('#stock'+stock_id).val(response.stock+' '+inStock );
                    $('#unite_mesure'+unite_mesure_id).val(response.unite_mesure);
                }
            }
        });
    });

    $(document).on('change', 'select[name="descriptionn[]"]', function(){

        let row = $(this).closest('tr');
        let inStock = " في المخزن "; 
        let article_id = row.find('#article_id').val();
        let stock_id = row.find('#stock_id').val();
        let unite_mesure_id = row.find('#unite_mesure_id').val();
        var id = $(this).val();
        var url = "{{ URL::to('searticle') }}/" + id;
        console.log(id);
        $.ajax({
            url: url,
            type: 'get',
            dataType: 'json',
            success: function(response){
                if(response != null){
                    $('#article'+article_id).val(response.reference);
                    $('#stock'+stock_id).val(response.stock+' '+inStock );
                    $('#unite_mesure'+unite_mesure_id).val(response.unite_mesure);
                }
            }
        });
    });

    // test search product
        $(document).on('change', '#ser', function(){
            var search = $(this).val();
            var url = "{{ URL::to('searcharticle') }}/" + search;
            $.ajax({
                url: url,              
                method: 'GET',
                dataType: 'json',
                success: function(response){
                    if(response != null){
                        var html = '<option value="" selected disabled>إختر المنتوج</option>';
                        var numberO= ($('.addMoreArticle tr').length - 0);
                        $.each(response, function(key, value) {
                            html += "<option value="+value.id+">" + value.description + "</option>";
                            // console.log(value.id)
                        });
                        $('#descriptionS'+numberO).html(html);
                    }
                }
            });
            // }
        });
        ///////////
    // });

    </script>
@endsection
