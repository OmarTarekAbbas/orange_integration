@include('backend.header')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">All Orange Provisions</h1>
    </div>
</div>
<!--/.row-->

<div class="row">
    @if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <br>
    <div class="form-group">
        {!! Form::open(['url' => url('admin/orange_provisions'),'method'=>'get']) !!}

        <div class="col-md-2">
            {!! Form::label('se', 'spId:') !!}
            <div class='input-group date'>
                <input type='text' id="se" class="form-control" value="{{request()->get('spId')}}" name="spId" />
                <span class="input-group-btn">
                    <button type="button" id="search-btn" class="btn"><i
                            class="glyphicon glyphicon-search"></i></button>
                </span>
            </div>
        </div>

        <div class="col-md-2">
            {!! Form::label('timeStamp', 'timeStamp:') !!}
            <div class='input-group date'>
                <input type='text' id="timeStamp" class="form-control" value="{{request()->get('timeStamp')}}" name="timeStamp" />
                <span class="input-group-btn">
                    <button type="button" id="search-btn" class="btn"><i
                            class="glyphicon glyphicon-search"></i></button>
                </span>
            </div>
        </div>

        <div class="col-md-2">
            {!! Form::label('transactionId', 'transactionId:') !!}
            <div class='input-group date'>
                <input type='text' id="transactionId" class="form-control" value="{{request()->get('transactionId')}}" name="transactionId" />
                <span class="input-group-btn">
                    <button type="button" id="search-btn" class="btn"><i
                            class="glyphicon glyphicon-search"></i></button>
                </span>
            </div>
        </div>

        <div class="col-md-2">
            {!! Form::label('msisdn', 'msisdn:') !!}
            <div class='input-group date'>
                <input type='text' id="msisdn" class="form-control" value="{{request()->get('msisdn')}}" name="msisdn" />
                <span class="input-group-btn">
                    <button type="button" id="search-btn" class="btn"><i
                            class="glyphicon glyphicon-search"></i></button>
                </span>
            </div>
        </div>
        <div class="col-md-2">
            {!! Form::label('serviceId', 'serviceId:') !!}
            <div class='input-group date'>
                <input type='text' id="serviceId" class="form-control" value="{{request()->get('serviceId')}}" name="serviceId" />
                <span class="input-group-btn">
                    <button type="button" id="search-btn" class="btn"><i
                            class="glyphicon glyphicon-search"></i></button>
                </span>
            </div>
        </div>

        <div class="col-md-2">
            {!! Form::label('operationType', 'operationType:') !!}
            <div class='input-group date'>
                <input type='text' id="operationType" class="form-control" value="{{request()->get('operationType')}}" name="operationType" />
                <span class="input-group-btn">
                    <button type="button" id="search-btn" class="btn"><i
                            class="glyphicon glyphicon-search"></i></button>
                </span>
            </div>
        </div>

        <div class="col-md-2">
            {!! Form::label('createdTime', 'createdTime:') !!}
            <div class='input-group date'>
                <input type='text' id="createdTime" class="form-control" value="{{request()->get('createdTime')}}" name="createdTime" />
                <span class="input-group-btn">
                    <button type="button" id="search-btn" class="btn"><i
                            class="glyphicon glyphicon-search"></i></button>
                </span>
            </div>
        </div>

        <div class="col-md-2">
            {!! Form::label('resultCode', 'resultCode:') !!}
            <div class='input-group date'>
                <input type='text' id="resultCode" class="form-control" value="{{request()->get('resultCode')}}" name="resultCode" />
                <span class="input-group-btn">
                    <button type="button" id="search-btn" class="btn"><i
                            class="glyphicon glyphicon-search"></i></button>
                </span>
            </div>
        </div>

        <div class="col-md-2">
            {!! Form::label('from_date', 'Select Form Date :') !!}
            <div class='input-group date' id='datetimepicker'>
                <input type='text' class="form-control" value="{{request()->get('from_date')}}" name="from_date"
                    id="from_date" />
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
        </div>

        <div class="col-md-2">
            {!! Form::label('to_date', 'Select To Date :') !!}
            <div class='input-group date' id='datetimepicker1'>
                <input type='text' class="form-control" value="{{request()->get('to_date')}}" name="to_date"
                    id="to_date" />
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
        </div>

        <div class="col-md-1">
            <br>
            <button class="btn btn-labeled btn-info filter" type="submit"><span class="btn-label"><i
                        class="glyphicon glyphicon-search"></i></span>Filter</button>
        </div>

        <div class="col-md-1">
            {!! Form::label('date', 'Count :') !!}
            <div class='input-group date'>
                <span dir="rtl" class="btn btn-success">{{ count($orange_provisions) }} </span>
            </div>
        </div>

        {!! Form::close() !!}
    </div>

    <div class="col-xs-12">
        <div class="box">
            <div class="box-title">
                @if(Session::has('success'))
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                </div>
                @endif
                <h3>Orange Provisions</h3>
            </div>
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover table-striped mt-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>SpId</th>
                            <th>Time Stamp</th>
                            <th>TransactionId</th>
                            <th>Msisdn</th>
                            <th>Service Id</th>
                            <th>OperationType</th>
                            <th>Created Time</th>
                            <th>Msg</th>
                            <th>ResultCode</th>
                            <th>Date Time</th>
                            <th>Result</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($orange_provisions->count() > 0)
                        @foreach($orange_provisions as $item)
                        <tr>
                            <td> {{ $item->id }}</td>
                            <td> {{ $item->spId }}</td>
                            <td> {{ $item->timeStamp }}</td>
                            <td> {{ $item->transactionId }}</td>
                            <td> {{ $item->msisdn }} </td>
                            <td> {{ $item->serviceId }} </td>
                            <td> {{ $item->operationType }} </td>
                            <td> {{ $item->createdTime }} </td>
                            <td> {{ $item->msg }} </td>
                            <td> {{ $item->resultCode }} </td>
                            <td> {{ $item->created_at->format('Y-m-d') }} </td>
                            <td>
                                <a href="{{url('admin/orange_provisions/request_and_response/'.$item->id)}}" target="_blank">
                                    <button class="btn btn-warning borderRadius">Request&Response</button>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>

            </div>
        </div>

        @if(!$without_paginate)
        {!! $orange_provisions->setPath('orange_provisions') !!}
        @endif


    </div>
</div>

@include('backend.footer')
<script type="text/javascript">
$('#orange_notifie').addClass('active').siblings().removeClass('active');
$('#datetimepicker').datepicker({
    format: "yyyy-mm-dd"
});
$('#datetimepicker1').datepicker({
    format: "yyyy-mm-dd"
});
</script>
