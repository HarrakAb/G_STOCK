@extends('layouts.master')
@section('css')
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">Invoice</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    Details</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="panel panel-primary tabs-style-2">
            <div class=" tab-menu-heading">
                <div class="tabs-menu1">
                    <!-- Tabs -->
                    <ul class="nav panel-tabs main-nav-line">
                        <li><a href="#tab4" class="nav-link active text-success" data-toggle="tab">Invoice</a></li>
                        <li><a href="#tab5" class="nav-link" data-toggle="tab">Details</a></li>
                        <li><a href="#tab6" class="nav-link" data-toggle="tab">Attachements</a></li>
                    </ul>
                </div>
            </div>
            <div class="panel-body tabs-menu-body main-content-body-right border">
                <div class="tab-content">
                    <div class="tab-pane active" id="tab4">
                        <div class="table-responsive">
                            <table id="example1" class="table key-buttons text-md-nowrap" data-page-length='50'
                                style="text-align: center">
                                <thead>
                                    <tr>
                                        <th class="border-bottom-0">Invoice_number</th>
                                        <th class="border-bottom-0">Invoice_date</th>
                                        <th class="border-bottom-0">Due_date</th>
                                        <th class="border-bottom-0">Article</th>
                                        <th class="border-bottom-0">Categorie</th>
                                        <th class="border-bottom-0">Discount</th>
                                        <th class="border-bottom-0">Rate_vat</th>
                                        <th class="border-bottom-0">Value_vat</th>
                                        <th class="border-bottom-0">Total</th>
                                        <th class="border-bottom-0">Status</th>
                                        <th class="border-bottom-0">Notes</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $invoices->invoice_number }}</td>
                                        <td>{{ $invoices->invoice_Date }}</td>
                                        <td>{{ $invoices->Due_date }}</td>
                                        <td>{{ $invoices->article }}</td>
                                        <td class="text-info"><a href="{{ url('details', $invoices->categorie_id) }}">
                                                {{ $invoices->categorie->categorie_name }}</a>
                                        </td>
                                        <td>{{ $invoices->Discount }}</td>
                                        <td>{{ $invoices->Rate_VAT }}</td>
                                        <td>{{ $invoices->Value_VAT }}</td>
                                        <td>{{ $invoices->Total }}</td>
                                        <td>
                                            @if ($invoices->Value_Status == 1)
                                                <a class="badge badge-success" href="#">Payed</a>
                                            @elseif ($invoices->Value_Status == 2)
                                                <a class="badge badge-danger" href="#"> Not Payed</a>
                                            @else
                                                <a class="badge badge-warning" href="#">Payed partial</a>
                                            @endif
                                        </td>
                                        <td>{{ $invoices->note }}</td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab5">
                        <div class="table-responsive">
                            <table id="example1" class="table key-buttons text-md-nowrap" data-page-length='50'
                                style="text-align: center">
                                <thead>
                                    <tr>
                                        <th class="border-bottom-0">Invoice_number</th>
                                        <th class="border-bottom-0">Article</th>
                                        <th class="border-bottom-0">SCategorie</th>
                                        <th class="border-bottom-0">Status</th>
                                        <th class="border-bottom-0">Value_Status</th>
                                        <th class="border-bottom-0">Payment_Date</th>
                                        <th class="border-bottom-0">note</th>
                                        <th class="border-bottom-0">user</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($details as $x)
                                        <tr>
                                            <td>{{ $x->invoice_number }}</td>
                                            <td>{{ $x->product }}</td>
                                            <td>{{ $invoices->categorie->categorie_name }}</td>
                                            <td>
                                                @if ($x->Value_Status == 1)
                                                    <a class="badge badge-success" href="#">Payed</a>
                                                @elseif ($x->Value_Status == 2)
                                                    <a class="badge badge-danger" href="#"> Not Payed</a>
                                                @else
                                                    <a class="badge badge-warning" href="#">Payed partial</a>
                                                @endif
                                            </td>
                                            <td>{{ $x->Value_Status }}</td>
                                            <td>{{ $x->Payment_Date }}</td>
                                            <td>{{ $x->note }}</td>
                                            <td>{{ $x->user }}</td>
                                        </tr>
                                    @endforeach
                                    {{-- @php
                                    $i = 0;
                                    @endphp
                                    @foreach ($details as $x)
                                        <?php $i++; ?>
                                        <tr>
                                            <td>{{ $i }}</td>
                                            <td>{{ $x->invoice_number }}</td>
                                            <td>{{ $x->product }}</td>
                                            <td>{{ $invoices->Section->section_name }}</td>
                                            @if ($x->Value_Status == 1)
                                                <td><span class="badge badge-pill badge-success">Payed</span>
                                                </td>
                                                @elseif($x->Value_Status ==2)
                                                <td><span class="badge badge-pill badge-danger">Not Payed</span>
                                                </td>
                                                @else
                                                <td><span class="badge badge-pill badge-warning">Payed partial</span>
                                                </td>
                                            @endif
                                            <td>{{ $x->Payment_Date }}</td>
                                            <td>{{ $x->note }}</td>
                                            <td>{{ $x->created_at }}</td>
                                            <td>{{ $x->user }}</td>
                                        </tr>
                                    @endforeach --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab5">
                        <div class="table-responsive mt-15">
                            <table class="table center-aligned-table mb-0 table table-hover" style="text-align:center">
                                <thead>
                                    <tr class="text-dark">
                                        <th scope="col">م</th>
                                        <th scope="col">اسم الملف</th>
                                        <th scope="col">قام بالاضافة</th>
                                        <th scope="col">تاريخ الاضافة</th>
                                        <th scope="col">العمليات</th>
                                    </tr>
                                </thead>
                                <tbody>
                        <div class="tab-pane" id="tab6">
                        <!--المرفقات-->
                        <div class="card card-statistics">
                            <div class="card-body">
                                <p class="text-danger">* صيغة المرفق pdf, jpeg ,.jpg , png </p>
                                <h5 class="card-title">اضافة مرفقات</h5>
                                <form method="post" action="{{ url('/InvoiceAttachments') }}" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="customFile" name="file_name"
                                            required>
                                        <input type="hidden" id="customFile" name="invoice_number"
                                            value="{{ $invoices->invoice_number }}">
                                        <input type="hidden" id="invoice_id" name="invoice_id" value="{{ $invoices->id }}">
                                        <label class="custom-file-label" for="customFile">حدد
                                            المرفق</label>
                                    </div><br><br>
                                    <button type="submit" class="btn btn-primary btn-sm " name="uploadedFile">تاكيد</button>
                                </form>
                            </div>
                        </div>
                        <br>
                        <div class="table-responsive mt-15">
                            <table class="table center-aligned-table mb-0 table table-hover" style="text-align:center">
                                <thead>
                                    <tr class="text-dark">
                                        <th scope="col">م</th>
                                        <th scope="col">اسم الملف</th>
                                        <th scope="col">قام بالاضافة</th>
                                        <th scope="col">تاريخ الاضافة</th>
                                        <th scope="col">العمليات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 0; ?>
                                    @foreach ($attachments as $attachment)
                                        <?php $i++; ?>
                                        <tr>
                                            <td>{{ $i }}</td>
                                            <td>{{ $attachment->file_name }}</td>
                                            <td>{{ $attachment->Created_by }}</td>
                                            <td>{{ $attachment->created_at }}</td>
                                            <td colspan="2">

                                                <a class="btn btn-outline-success btn-sm"
                                                    href="{{ url('View_file') }}/{{ $invoices->invoice_number }}/{{ $attachment->file_name }}"
                                                    role="button"><i class="fas fa-eye"></i>&nbsp;
                                                    عرض</a>

                                                <a class="btn btn-outline-info btn-sm"
                                                    href="{{ url('download') }}/{{ $invoices->invoice_number }}/{{ $attachment->file_name }}"
                                                    role="button"><i class="fas fa-download"></i>&nbsp;
                                                    تحميل</a>



                                                <button class="btn btn-outline-danger btn-sm" data-toggle="modal"
                                                    data-file_name="{{ $attachment->file_name }}"
                                                    data-invoice_number="{{ $attachment->invoice_number }}"
                                                    data-id_file="{{ $attachment->id }}"
                                                    data-target="#delete_file">حذف</button>

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
    <div class="modal fade" id="delete_file" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">حذف المرفق</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('delete_file') }}" method="post">

                    {{ csrf_field() }}
                    <div class="modal-body">
                        <p class="text-center">
                        <h6 style="color:red"> هل انت متاكد من عملية حذف المرفق ؟</h6>
                        </p>

                        <input type="hidden" name="id_file" id="id_file" value="">
                        <input type="hidden" name="file_name" id="file_name" value="">
                        <input type="hidden" name="invoice_number" id="invoice_number" value="">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">الغاء</button>
                        <button type="submit" class="btn btn-danger">تاكيد</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Container closed -->
    <!-- main-content closed -->
@endsection
@section('js')
    <!--Internal  Datepicker js -->
    <script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <!-- Internal Select2 js-->
    <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <!-- Internal Jquery.mCustomScrollbar js-->
    <script src="{{ URL::asset('assets/plugins/custom-scroll/jquery.mCustomScrollbar.concat.min.js') }}"></script>
    <!-- Internal Input tags js-->
    <script src="{{ URL::asset('assets/plugins/inputtags/inputtags.js') }}"></script>
    <!--- Tabs JS-->
    <script src="{{ URL::asset('assets/plugins/tabs/jquery.multipurpose_tabcontent.js') }}"></script>
    <script src="{{ URL::asset('assets/js/tabs.js') }}"></script>
    <!--Internal  Clipboard js-->
    <script src="{{ URL::asset('assets/plugins/clipboard/clipboard.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/clipboard/clipboard.js') }}"></script>
    <!-- Internal Prism js-->
    <script src="{{ URL::asset('assets/plugins/prism/prism.js') }}"></script>

    <script>
        $('#delete_file').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id_file = button.data('id_file')
            var file_name = button.data('file_name')
            var invoice_number = button.data('invoice_number')
            var modal = $(this)
            modal.find('.modal-body #id_file').val(id_file);
            modal.find('.modal-body #file_name').val(file_name);
            modal.find('.modal-body #invoice_number').val(invoice_number);
        })

    </script>

    <script>
        // Add the following code if you want the name of the file appear on select
        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });

    </script>

@endsection
