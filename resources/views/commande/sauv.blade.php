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
                <h4 class="content-title mb-0 my-auto">الطلبات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">
                    إظافة طلب</span>
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

                    <form id="bon" action="{{ route('commande.store') }}" method="post" enctype="multipart/form-data"
                        autocomplete="off">
                        {{ csrf_field() }}
                        <div class="pere">
                             <div class="row mt-2">
                                <div class="col">
                                    <label for="bon_number" class="control-label">رقم الطلب</label>
                                    <input type="text" class="form-control" name="bon_number"
                                        title="entrée le numéro de votre bon" value="{{$bon_number}}" required readonly>
                                    @error('bon_number')<span class="help-block text-danger">{{ $message }}</span>@enderror

                                </div>                           
                                <div class="col">
                                    <label>إسم الزبون</label>
                                    <select id="client_name" name="client_name" class="form-control client_name" required>
                                        <option value="" selected disabled>إسم الزبون</option>
                                        @foreach ($clients as $client)
                                            <option value="{{ $client->code_client }}">
                                                {{ $client->full_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <input  id="code" class="form-control"  name="code_client" type="hidden" required readonly> 
                                    <input class="form-control" id="client" name="client" type="hidden" required> 
                                </div>
                                <div class="col">
                                    <label for="client_credit" class="control-label">دين الزبون</label>
                                    <input type="number" id="credit" class="form-control" name="credit_client" required readonly>
                                        @error('credit_client')<span
                                        class="help-block text-danger">{{ $message }}</span>@enderror
                                </div>                        
                            </div>
                        </div>
                        </br>
                        <hr>
                        <div class="row mb-2">
                            <div class="col-6">
                                <button class="btn btn-success btn-sm">
                                    <a class="addRow"><i class="fa fa-plus"></i>&nbsp;&nbsp;إظافة منتوج</a>
                                </button>
                            </div>
                        </div>
                        {{-- 2 --}}
                        <div class="container addMoreArticle">
                            <div class="row line" id="1">
                                <span class="mt-3">1</span>
                                <div class="col-md-6">
                                    <div class="row mt-2">
                                        <div class="col">
                                            <div class="input-group">
                                                <select id="article" name="article[]" class="form-control article" required>
                                                    <option value="" selected disabled>إختر المنتوج</option>
                                                    @foreach ($articles as $article)
                                                        <option value="{{ $article->description }}">
                                                            {{ $article->description }}</option>
                                                    @endforeach
                                                </select>
                                                @error('article')<span
                                                    class="help-block text-danger">{{ $message }}</span>@enderror
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="input-group">
                                                <input type="number" name="unite_mesure[]" class="form-control unite_mesure"
                                                    id="unite_mesure1" readonly required />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="row mt-2">
                                        <div class="col">
                                            <div class="input-group">
                                                <input type="hidden" name="prix_unitaire_id" class="prix_unitaire_id"
                                                    id="prix_unitaire_id" value="1">
                                                <input type="number" step="any" name="prix_unitaire[]" class="form-control prix_unitaire"
                                                    id="prix_unitaire1" value="{{ old('prix_unitaire[]') }}" placeholder="ثمن الوحدة" required />
                                                @error('prix_unitaire')<span
                                                    class="help-block text-danger">{{ $message }}</span>@enderror
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="input-group">
                                                <input type="hidden" name="unite_mesure_id"
                                                    class="form-control unite_mesure_id" id="unite_mesure_id" value="1"
                                                    required />
                                                <input type="number" value="{{ old('quantite[]') }}" name="quantite[]"
                                                    class="form-control quantite" id="quantite" placeholder="الكمية" required />
                                                @error('quantite')<span
                                                    class="help-block text-danger">{{ $message }}</span>@enderror
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="input-group">
                                                <input type="hidden" name="stock_id" class="form-control stock" id="stock_id" value="1" required />
                                                <input type="text" name="stock[]" class="form-control stock border border-success" id="stock1" readonly required />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-auto">
                                    <button class="btn btn-danger btn-sm">
                                        <a><i class="fa fa-times" id="1"></i>&nbsp;&nbsp;حذف منتوج</a>
                                    </button>
                                </div>
                            </div>
                            <hr id="hr1">

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
        $(document).ready(function() {
            var categorie = $('.categorie').html();
            console.log(categorie);
        })
        // add Row function //

        $('.addRow').on('click', function() {
            var categorie = $('.categorie').html();
            var numberOfRow = ($('.addMoreArticle span').length - 0) + 1;
            var div = '<div class="row line" id="' + numberOfRow + '">' +
                '<span>' + numberOfRow + '</span>' +
                '<div class="col-md-6">' +
                '<div class="row mt-2">' +
                '<div class="col">' +
                '<div class="input-group">' +
                '<select id="article" name="article[]" class="form-control article" required>' +
                '<option value="" selected disabled>إختر المنتوج</option>' +
                ' @foreach ($articles as $article)' +
                '<option value="{{ $article->description }}"> ' +
                '{{ $article->description }}</option> ' +
                '@endforeach ' +
                '</select>' +
                '</div>' +
                '</div>' +

                '<div class="col">' +
                '<div class="input-group">' +
                '<input type="number" name="unite_mesure[]" class="form-control unite_mesure" id="unite_mesure' +
                numberOfRow + '" readonly required/>' +
                '</div>' +
                '</div>' +

               
                '</div>' +
                '</div>' +

                '<div class="col-md-5">' +
                '<div class="row mt-2">' +
                '<div class="col">' +
                '<div class="input-group">' +
                '<input type="hidden" name="prix_unitaire_id" class="prix_unitaire_id"  id="prix_unitaire_id" value="'+numberOfRow+'">' +
                '<input type="number" step="any" data-prix_unitaire_id="' + numberOfRow +
                '" name="prix_unitaire[]" class="form-control prix_unitaire" id="prix_unitaire' + numberOfRow +
                '" value="{{ old("prix_unitaire[]") }}" placeholder="ثمن الوحدة" required/>' +
                '@error("prix_unitaire ")<span class="help-block text-danger">{{ $message }}</span>@enderror' +
                '</div>' +
                '</div>' +

                '<div class="col">' +
                '<div class="input-group">' +
                '<input type="number" name="quantite[]" class="form-control quantite" id="quantite" placeholder="الكمية"/>' +
                '<input type="hidden" name="unite_mesure_id" class="form-control unite_mesure_id" id="unite_mesure_id" value="' +
                numberOfRow + '" required/>' +
                '</div>' +
                '</div>' +
                '<div class="col">'+
                '<div class="input-group">'+
                '<input type="hidden" name="stock_id" class="form-control stock" id="stock_id" value="'+numberOfRow+'" required />'+
                '<input type="text" name="stock[]" class="form-control stock border border-success" id="stock'+numberOfRow+'" readonly required />'+
                '</div>'+
                '</div>'+
                '</div>' +
                '</div>' +
                '</div>' +
                '<div class="row mt-1">' +
                '<div class="col-auto">' +
                '<button class="btn btn-danger btn-sm">' +
                '<a class="delete" id="' + numberOfRow + '"><i class="fa fa-times"></i>&nbsp;&nbsp;حذف منتوج</a>' +
                '</button>' +
                '</div>' +
                '</div>' +
                '<hr id="hr' + numberOfRow + '">';
            $('.addMoreArticle').append(div);
        });

        // end add Row function //

        // delete function //

        $('.addMoreArticle').delegate('.delete', 'click', function() {

            let row = $(this).closest('.addMoreArticle');
            let line = this.id;
            // console.log(line);
            $('.addMoreArticle').find(('#' + line)).remove();
            $('.container').find(('#hr' + line)).remove();
            $(this).parent().parent().parent().remove();
        });

        //  end delete function //

        ///////////  get Description of Product ////

        $(document).on('change', 'select[name="article[]"]', function() {
            var numberOfRow = ($('.addMoreArticle span').length - 0) + 1;
            let row = $(this).closest('.line');
            //let prix_unitaire_id = row.find('#prix_unitaire_id').val();
            let unite_mesure_id = row.find('#unite_mesure_id').val();
            let inStock = " في المخزن "; 
            let stock_id = row.find('#stock_id').val();
            var reference = $(this).val();
            var url = "{{ URL::to('article') }}/" + reference;
            //console.log(description_id);
            $.ajax({
                url: url,
                type: 'get',
                dataType: 'json',
                success: function(response) {
                    if (response != null) {
                        //$('#prix_unitaire' + description_id).val(response.reference);
                        $('#unite_mesure' + unite_mesure_id).val(response.unite_mesure);
                        $('#stock' + stock_id).val(response.stock +' '+ inStock);
                    }
                }
            });
        });


        // get Credit Client

        $('select[name="client_name"]').change(function(){
            var code = $(this).val();
            var url = "{{ URL::to('credit') }}/" + code;
            //url = url.replace(':id', id);
 
            $.ajax({
                url: url,
                type: 'get',
                dataType: 'json',
                success: function(response){
                    if(response != null){
                        $('#credit').val((response.credit).toFixed(2));
                        $('#client').val(response.client_name);
                    }
                }
            });
        });


    </script>
@endsection
