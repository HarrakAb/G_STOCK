<div class="row">
    @can('employes')
    <div class="col-8">
        {{-- Daily benifts --}}

        <div class="card">
            <div class="card-body bg-success ">
                <h4 class="card-title text-center text-light">المعاملات يوميا</h4>
            </div>
                <div class="table-responsive">
                    <table id="example1" class="table key-buttons text-md-nowrap mt-2" data-page-length='10'style="text-align: center"> 

                        <thead>
                            <tr>
                                <th>الشراء</th>
                                <th>البيع</th>
                                <th>الربح</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @foreach ($clients as $client) --}}
                                <tr>
                                    <td>{{$entreeDaily}}</td>
                                    <td>{{$sortieDaily}}</td>
                                    <td>
                                        @if ($benifisDaily > 0)
                                            <span class="badge bg-success">
                                                {{$benifisDaily}}
                                            </span>
                                            <span class="text-success">
                                                <i class="fas fa-sort-up"></i>
                                            </span>
                                        @else	
                                            <span class="badge bg-danger text-light">
                                                {{$benifisDaily}} 
                                            </span>	
                                            <span class="text-danger">
                                                <i class="fas fa-sort-down"></i>
                                            </span>
                                        @endif
                                    </td>
                                </tr>										
                            {{-- @endforeach --}}
                        </tbody>
                    </table>
                </div><!-- bd -->
        </div>
         {{-- Monthly benifits --}}

         <div class="card">
            <div class="card-body bg-warning text-light">
                <h4 class="card-title text-center text-dark">المعاملات شهريا</h4>
            </div>
                <div class="table-responsive">
                    <table id="example1" class="table key-buttons text-md-nowrap mt-2" data-page-length='10'style="text-align: center"> 

                        <thead>
                            <tr>
                                <th>الشراء</th>
                                <th>البيع</th>
                                <th>الربح</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @foreach ($clients as $client) --}}
                                <tr>
                                    <td>{{$entreeMonthly}}</td>
                                    <td>{{$sortieMonthly}}</td>
                                    <td>
                                        @if ($benifitsMonthly > 0)
                                            <span class="badge bg-success">
                                                {{$benifitsMonthly}}
                                            </span>
                                            <span class="text-success">
                                                <i class="fas fa-sort-up"></i>
                                            </span>
                                        @else	
                                            <span class="badge bg-danger text-light">
                                                {{$benifitsMonthly}}
                                            </span>
                                            <span class="text-danger">
                                                <i class="fas fa-sort-down"></i>
                                            </span>	
                                        @endif
                                    </td>
                                </tr>										
                            {{-- @endforeach --}}
                        </tbody>
                    </table>
                </div><!-- bd -->
        </div>

        {{-- Yearly benifits --}}

        <div class="card">
            <div class="card-body bg-dark text-light">
                <h4 class="card-title text-center text-light">المعاملات سنويا</h4>
            </div>
                <div class="table-responsive">
                    <table id="example1" class="table key-buttons text-md-nowrap mt-2" data-page-length='10'style="text-align: center"> 

                        <thead>
                            <tr>
                                <th>الشراء</th>
                                <th>البيع</th>
                                <th>الربح</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @foreach ($clients as $client) --}}
                                <tr>
                                    <td>{{$entreeYearly}}</td>
                                    <td>{{$sortieYearly}}</td>
                                    <td>
                                        @if ($benifitsYearly > 0)
                                            <span class="badge bg-success">
                                                {{$benifitsYearly}}
                                            </span>
                                            <span class="text-success">
                                                <i class="fas fa-sort-up"></i>
                                            </span>
                                        @else	
                                            <span class="badge bg-danger text-light">
                                                {{$benifitsYearly}}
                                            </span>
                                            <span class="text-danger">
                                                <i class="fas fa-sort-down"></i>
                                            </span>	
                                        @endif
                                    </td>
                                </tr>										
                            {{-- @endforeach --}}
                        </tbody>
                    </table>
                </div><!-- bd -->
        </div>

    </div>
    @endcan
    @can('employes')
    <div class="col-4 mt-2">
        <div class="card">
            <div class="card-body bg-info">
                <h4 class="card-title text-center">المنتوجات الأكثر مبيعا</h4>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Item 1</li>
                <li class="list-group-item">Item 2</li>
                <li class="list-group-item">Item 3</li>
                <li class="list-group-item">Item 3</li>
                <li class="list-group-item">Item 3</li>
            </ul>
        </div>
        <div class="card mt-4">
            <div class="card-body bg-success">
                <h4 class="card-title text-center">الزبناء الأكثر وفاء</h4>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Item 1</li>
                <li class="list-group-item">Item 2</li>
                <li class="list-group-item">Item 3</li>
                <li class="list-group-item">Item 3</li>
                <li class="list-group-item">Item 3</li>
            </ul>
        </div>
    </div>
    @endcan
</div>
<!-- row opened -->
    
<!-- row closed -->
</div>
</div>
