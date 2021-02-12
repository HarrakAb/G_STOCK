<div>
    <div id="add_article">
        @foreach ($articles as $index => $article)                                 
            <div class="row" id="0">
                <div class="col-3">
                    <label for="inputName" class="control-label">القسم</label>
                    <select name="categorie" class="form-control SlectBox" onclick="console.log($(this).val())"
                        onchange="console.log('change is firing')">
                        <!--placeholder-->
                        <option value="" selected disabled>إختر القسم</option>
                        @foreach ($categories as $categorie)
                            <option value="{{ $categorie->id }}"> {{ $categorie->categorie_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col">
                    <label for="inputName" class="control-label">المنتوج</label>
                    <select id="article" name="article" class="form-control">
                    </select>
                </div>
                <div class="col">
                    <label for="inputName" class="control-label"> الكمية</label>
                    <input type="text" class="form-control form-control-lg" id="quantite"
                        name="quantite" title="Entrer la Quantité"
                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                        required>
                </div>
                <div class="col">
                    <label for="inputName" class="control-label">ثمن الوحدة</label>
                    <input type="text" class="form-control form-control-lg" id="prix_unitaire" name="prix_unitaire"
                        title="Entrer le prix unitaire"
                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                        onchange="myFunction()"
                        value=0 required>
                </div>

                <div class="col mb-4">
                    <label for="inputName" class="control-label"> المبلغ الإجمالي للمنتوج</label>
                    <input type="text" class="form-control" id="prix_total" name="prix_total" readonly>
                </div>

            </div>
        @endforeach
    </div>
    <div class="row">
        <div class="col">
           <button type="button" wire:click.prevent="addRow" class="btn btn-primary btn-sm float-left"><i class="fas fa-plus"></i>&nbsp; إظافة منتوج</button>
       </div>
   </div>
</div>


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
