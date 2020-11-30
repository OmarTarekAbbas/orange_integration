@include('backend.header')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">All Orange Ussds</h1>
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
        {!! Form::open(['url' => url('admin/orange_ussds'),'method'=>'get']) !!}

        <div class="col-md-2">
            {!! Form::label('ms', 'Msisdn:') !!}
            <div class='input-group date'>
                <input type='text' id="ms" class="form-control" value="{{request()->get('msisdn')}}" name="msisdn" />
                <span class="input-group-btn">
                    <button type="button" id="search-btn" class="btn"><i
                            class="glyphicon glyphicon-search"></i></button>
                </span>
            </div>
        </div>

        <div class="col-md-2">
            {!! Form::label('language', 'Language:') !!}
            <div class='input-group date'>
                <input type='text' id="language" class="form-control" value="{{request()->get('language')}}"
                    name="language"/>
                <span class="input-group-btn">
                    <button type="button" id="search-btn" class="btn"><i
                            class="glyphicon glyphicon-search"></i></button>
                </span>
            </div>
        </div>

        <div class="col-md-2">
            {!! Form::label('se', 'Session Id:') !!}
            <div class='input-group date'>
                <input type='text' id="se" class="form-control" value="{{request()->get('session_id')}}"
                    name="session_id" />
                <span class="input-group-btn">
                    <button type="button" id="search-btn" class="btn"><i
                            class="glyphicon glyphicon-search"></i></button>
                </span>
            </div>
        </div>



        <div class="col-md-2">
            {!! Form::label('host', 'Host:') !!}
            <div class='input-group date'>
                <input type='text' id="host" class="form-control" value="{{request()->get('host')}}"
                    name="host"/>
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
                <span dir="rtl" class="btn btn-success">{{ count($orange_ussds) }} </span>
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
                <h3>Orange Ussds</h3>
            </div>
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover table-striped mt-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Msisdn</th>
                            <th>Language</th>
                            <th>Session Id</th>
                            <th>Host</th>
                            <th>Date Time</th>
                            <th>Result</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($orange_ussds->count() > 0)
                        @foreach($orange_ussds as $item)
                        <tr>
                            <td> {{ $item->id }}</td>
                            <td> {{ $item->msisdn }}</td>
                            <td> {{ $item->language }}</td>
                            <td> {{ $item->session_id }} </td>
                            <td> {{ $item->host }} </td>
                            <td> {{ $item->created_at->format('Y-m-d h:i:s') }} </td>
                            <td>
                            <a href="{{url('admin/orange_ussds/request_and_response/'.$item->id)}}" target="_blank">
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
        {!! $orange_ussds->setPath('orange_ussds') !!}
        @endif


    </div>
</div>

@include('backend.footer')
<script type="text/javascript">
$('#sub-item-5').addClass('collapse in');
    $('#sub-item-5').parent().addClass('active').siblings().removeClass('active');$('#datetimepicker').datepicker({
    format: "yyyy-mm-dd"
});
$('#datetimepicker1').datepicker({
    format: "yyyy-mm-dd"
});
</script>
