@include('backend.header')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">All Orange Notifier</h1>
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
        {!! Form::open(['url' => url('admin/orange_notifie'),'method'=>'get']) !!}

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
            {!! Form::label('se', 'Service Id:') !!}
            <div class='input-group date'>
                <input type='text' id="se" class="form-control" value="{{request()->get('service_id')}}"
                    name="service_id" />
                <span class="input-group-btn">
                    <button type="button" id="search-btn" class="btn"><i
                            class="glyphicon glyphicon-search"></i></button>
                </span>
            </div>
        </div>

        <div class="col-md-2">
            {!! Form::label('action', 'Action:') !!}
            <div class='input-group date'>
                <input type='text' id="action" class="form-control" value="{{request()->get('action')}}"
                    name="action" />
                <span class="input-group-btn">
                    <button type="button" id="search-btn" class="btn"><i
                            class="glyphicon glyphicon-search"></i></button>
                </span>
            </div>
        </div>

        <div class="col-md-2">
            {!! Form::label('notification_result', 'Notification Result:') !!}
            <div class=''>
                {!! Form::select('notification_result', ['200'=>'Success' , '0' => 'Failed'] ,
                request()->get('notification_result'),
                ['class'=>'form-control','id'=>'notification_result','placeholder'=>'Select Notification Result']) !!}
            </div>
        </div>

        <div class="col-md-2">
            {!! Form::label('date', 'Select Orange Notifier Date :') !!}
            <div class='input-group date' id='datetimepicker'>
                <input type='text' class="form-control" value="{{request()->get('created')}}" name="created"
                    id="date" />
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
                <span dir="rtl" class="btn btn-success">{{ count($orange_notify) }} </span>
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
                <h3>Orange Notifier</h3>
            </div>
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover table-striped mt-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Msisdn</th>
                            <th>Action</th>
                            <th>ServiceId</th>
                            <th>Notification Result</th>
                            <th>Date Time</th>
                            <th>Result</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($orange_notify->count() > 0)
                        @foreach($orange_notify as $item)
                        <tr>
                            <td> {{ $item->id }}</td>
                            <td> {{ $item->msisdn }}</td>
                            <td> {{ $item->action }}</td>
                            <td> {{ $item->service_id }} </td>
                            <td> {{ $item->notification_result }} </td>
                            <td> {{ $item->created_at->format('Y-m-d') }} </td>
                            <td>
                            <a href="{{url('admin/orange_notifie/request_and_response/'.$item->id)}}">
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
        {!! $orange_notify->setPath('orange_notify') !!}
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
