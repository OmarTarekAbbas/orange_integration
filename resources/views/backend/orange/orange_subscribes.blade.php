@include('backend.header')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">All Orange Subscribes</h1>
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
        {!! Form::open(['url' => url('admin/orange_subscribes'),'method'=>'get']) !!}

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
            {!! Form::label('active', 'Active:') !!}
            <div class=''>
                {!! Form::select('active', ['1'=>'Active' , '0' => 'Not active'] ,
                request()->get('active'),
                ['class'=>'form-control','id'=>'active','placeholder'=>'Select Active']) !!}
            </div>
        </div>

        <div class="col-md-2">
            {!! Form::label('orange_notify_id', 'Orange Notify Id:') !!}
            <div class='input-group date'>
                <input type='text' id="orange_notify_id" class="form-control"
                    value="{{request()->get('orange_notify_id')}}" name="orange_notify_id" />
                <span class="input-group-btn">
                    <button type="button" id="search-btn" class="btn"><i
                            class="glyphicon glyphicon-search"></i></button>
                </span>
            </div>
        </div>

        <div class="col-md-2">
            {!! Form::label('table_name', 'Table Name:') !!}
            <div class=''>
                {!! Form::select('table_name', ['orange_notifies'=>'orange_notifies' , 'orange_ussds' => 'orange_ussds' , 'orange_webs' => 'orange_webs']
                ,
                request()->get('table_name'),
                ['class'=>'form-control','id'=>'table_name','placeholder'=>'Select Table Name']) !!}
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
                <span dir="rtl" class="btn btn-success">{{ count($orange_subscribes) }} </span>
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
                <h3>Orange Subscribes</h3>
            </div>
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover table-striped mt-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Msisdn</th>
                            <th>Active</th>
                            <th>Orange Notify Id</th>
                            <th>Table Name</th>
                            <th>Date Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($orange_subscribes->count() > 0)
                        @foreach($orange_subscribes as $item)
                        <tr>
                            <td> {{ $item->id }}</td>
                            <td> {{ $item->msisdn }}</td>
                            <td>
                                @if($item->active == 1)
                                Active
                                @else
                                Not active
                                @endif
                            </td>
                            <td> {{ $item->orange_notify_id }}</td>
                            <td> {{ $item->table_name }}</td>
                            <td> {{ $item->created_at->format('Y-m-d') }} </td>

                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>

            </div>
        </div>

        @if(!$without_paginate)
        {!! $orange_subscribes->setPath('orange_subscribes') !!}
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
