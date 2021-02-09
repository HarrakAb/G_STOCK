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
    Modification du Bon
@stop

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">Les Bon de sortie</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    Modification du bon</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')

    @if (session()->has('edit'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('edit') }}</strong>
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

                    <form action="{{ route('bonSorties.update' ,$bonSorties->id  )}}" method="post" autocomplete="off">
                        {{ method_field('patch') }}
                        {{ csrf_field() }}
                        {{-- 1 --}}
                        <div class="row">
                            <div class="col">
                                <label for="inputName" class="control-label">Numéro du Bon</label>
                                <input type="hidden" name="bonSortie_id" value="{{ $bonSorties->id }}">
                                <input type="text" class="form-control" id="inputName" name="bon_number"
                                    title="veuillez entré le numéro du bon" value="{{ $bonSorties->bon_number }}" required>
                            </div>

                            <div class="col">
                                <label>Date de sortie</label>
                                <input class="form-control fc-datepicker" name="bon_date" placeholder="YYYY-MM-DD"
                                    type="text" value="{{ $bonSorties->bon_date }}" required>
                            </div>


                        </div>

                        {{-- 2 --}}
                        <div class="row">
                            <div class="col">
                                <label for="inputName" class="control-label">Catégorie</label>
                                <select name="categorie" class="form-control SlectBox" onclick="console.log($(this).val())"
                                    onchange="console.log('change is firing')">
                                    <!--placeholder-->
                                    <option value=" {{ $bonSorties->categorie->id }}">
                                        {{ $bonSorties->categorie->categorie_name }}
                                    </option>
                                    @foreach ($categories as $categorie)
                                        <option value="{{ $categorie->id }}"> {{ $categorie->categorie_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">Article</label>
                                <select id="article" name="article" class="form-control">
                                    <option value="{{ $bonSorties->article }}"> {{ $bonSorties->article }}</option>
                                </select>
                            </div>

                        </div>


                        {{-- 3 --}}

                        <div class="row">

                            <div class="col">
                                <label for="inputName" class="control-label">Quantité</label>
                                <input type="text" class="form-control form-control-lg" id="quantite"
                                    name="quantite" title="veuillez entré la quantité"
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                    value="{{ $bonSorties->quantite }}" required>
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">Prix Unitaire</label>
                                <input type="text" class="form-control form-control-lg" id="prix_unitaire" name="prix_unitaire"
                                    title="veuillez entré le prix unitaire"
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                    value="{{ $bonSorties->prix_unitaire }}" onchange="myFunction()" required>
                            </div>

                        </div>

                        {{-- 4 --}}

                        <div class="row">
                            <div class="col">
                                <label for="inputName" class="control-label">Prix Total</label>
                                <input type="text" class="form-control" id="prix_total" name="prix_total"
                                    value="{{ $bonSorties->prix_total }}" readonly>
                            </div>
                        </div>

                        <div class="d-flex justify-content-center mt-2">
                            <button type="submit" class="btn btn-primary">Sauvegarder</button>
                        </div>
                      
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- row closed -->

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
        var date = $('.fc-datepicker').datepicker({
            dateFormat: 'yy-mm-dd'
        }).val();
    </script>

    <script>
        $(document).ready(function() {
            $('select[name="categorie"]').on('change', function() {
                var categorieId = $(this).val();
                if (categorieId) {
                    $.ajax({
                        url: "{{ URL::to('categorie') }}/" + categorieId,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('select[name="article"]').empty();
                            $.each(data, function(key, value) {
                                $('select[name="article"]').append('<option value="' +
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


<script>
    function myFunction() {
        var quantite = parseFloat(document.getElementById("quantite").value);
        var prix_unitaire = parseFloat(document.getElementById("prix_unitaire").value);
        var prix_total = parseFloat(document.getElementById("prix_total").value);
        if (typeof quantite === 'undefined' || !quantite) {
            alert('entrée la quantité !');
        } else {

            sumq = parseFloat(quantite * prix_unitaire).toFixed(2);
            document.getElementById("prix_total").value = sumq;
        }
    }
</script>


@endsection