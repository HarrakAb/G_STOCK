@extends('layouts.master')
@section('css')
<!---Internal Owl Carousel css-->
<link href="{{URL::asset('assets/plugins/owl-carousel/owl.carousel.css')}}" rel="stylesheet">
<!---Internal  Multislider css-->
<link href="{{URL::asset('assets/plugins/multislider/multislider.css')}}" rel="stylesheet">
<!--- Select2 css -->
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">

<style>
    @media print {
        #print_Button {
            display: none;
        }
      
    }
    .bor{
        padding: 5px 0 !important; 
    }
    .inpt {
        border: none;
        background: transparent;
    }
</style>
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">المخزن</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/المنتوجات</span>
						</div>
					</div>
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
				<!-- row -->
				<div class="row">
                    @if (session()->has('success'))
                        <div class="alert alert-success" role="alert">
                            {{session()->get('success')}}
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
                    <div class="col-xl-12">
						<div class="card">
							<div class="card-header pb-0">
								<a href="{{ url()->previous() }}" class="btn btn-primary  float-left mt-3 mr-2" id="print_Button"> <i
                                    class="fa fa-home ml-1"></i>رجوع</a>
                                <button class="btn btn-danger  float-left mt-3 mr-2" id="print_Button" onclick="printDiv()"> <i
                                    class="mdi mdi-printer ml-1"></i>طباعة</button>
								<div class="d-flex justify-content-between">
                                    <div class="col-sm-6 col-md-4 col-xl-3">
                                        <h4 class="text-primary">حالة المخزن</h4>
									</div>
								</div>
							</div>
							<div class="card-body">
                                <div class="row">
                                    <div class="col-sm-6 col-md-4 col-xl-3">
                                        <h4 class="text-primary"> القيمة الإجمالية للمحزن :</h4>
									</div>
                                    <div class="col-sm-6 col-md-4 col-xl-3">
                                        <h4 class="text-success" id="sum">

                                        </h4>
									</div>
                                </div>
								<div id="print" class="table-responsive">
									 <table id="example1" class="table key-buttons text-md-nowrap" data-page-length='10'style="text-align: center">

                                        <thead>
											<tr>
												<th>المنتوج</th>
												<th>الوصف</th>
                                                <th>القسم</th>
												<th>المتوفر</th>
												<th>القيمة الإجمالية للمنتوج في المخزن</th>
											</tr>
										</thead>
										<tbody >	
                                            @foreach ($articles as $article)                                           
                                                <tr class="bor test" id="test">
                                                    <td id="article" class="bor article">{{$article->reference}}</td>
                                                    <td class="bor">{{$article->description}}</td>
                                                    <td class="bor">{{$article->categorie->categorie_name}}</td>
                                                    <td id="stock" class="bor stock">{{$article->stock}}</td>
                                                    <td id="value" class="value">
                                                        {{ number_format($article->stock * $article->avg , 2  ,',' , '.') }}
                                                    </td>
                                                </tr>
                                            @endforeach																		
                                        </tbody>
									</table>
								</div><!-- bd -->
							</div><!-- bd -->
						</div><!-- bd -->
					</div>
				</div>
				<!-- row closed -->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
    <!-- Internal Data tables -->
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/vfs_fonts.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.html5.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.print.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js') }}"></script>
    <!--Internal  Datatable js -->
    <script src="{{ URL::asset('assets/js/table-data.js') }}"></script>


<!--Internal  Datepicker js -->
<script src="{{URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
<!-- Internal Select2 js-->
<script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
<!-- Internal Modal js-->
<script src="{{URL::asset('assets/js/modal.js')}}"></script>


<script type="text/javascript">

    function printDiv() {
        var printContents = document.getElementById('print').innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
        location.reload();
    }
    ///////
 
    $(function() {
        
        var TotalValue = 0;

        $("tr #value").each(function(index,value){
            currentRow = parseFloat($(this).text());
            TotalValue += currentRow
        });
        
        $("#sum").text(TotalValue+' درهم ');
        console.log(TotalValue);

    });

    /////////


    // $('.table tr').each(function(){
    //     $(this).each(function(){

    //         var article = $(this).find('#article').html();
    //         var stock = $(this).find('#stock').html();
    //         var value = $(this).find('#value');
    //         var url = "{{ URL::to('getAvg') }}/" + article;

    //         $.ajax({
    //             url: url,
    //             type: 'get',
    //             dataType: 'json',
    //             success: function(response){
    //                 if(response != null){
    //                     // $('#table tr').each(function(){

    //                         value.html((response * stock).toFixed(2) + '&nbsp;' +'  درهم  ')
    //                         //console.log((response * stock).toFixed(2));
    //                     // })
    //                     //console.log(article + '=>' +stock + '=>' + response);
    //                 }
    //             }
    //         });
            
    //     })
    // })

</script>

@endsection