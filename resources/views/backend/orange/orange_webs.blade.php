@include('backend.header')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">All Orange Webs</h1>
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
        {!! Form::open(['url' => url('admin/orange_webs'),'method'=>'get']) !!}


        <div class="col-md-2">
            {!! Form::label('se', 'SpId:') !!}
            <div class='input-group date'>
                <input type='text' id="se" class="form-control" value="{{request()->get('spId')}}" name="spId" />
                <span class="input-group-btn">
                    <button type="button" id="search-btn" class="btn"><i
                            class="glyphicon glyphicon-search"></i></button>
                </span>
            </div>
        </div>

        <div class="col-md-2">
            {!! Form::label('time_stamp', 'Time Stamp:') !!}
            <div class='input-group date'>
                <input type='text' id="time_stamp" class="form-control" value="{{request()->get('time_stamp')}}"
                    name="time_stamp" />
                <span class="input-group-btn">
                    <button type="button" id="search-btn" class="btn"><i
                            class="glyphicon glyphicon-search"></i></button>
                </span>
            </div>
        </div>

        <div class="col-md-2">
            {!! Form::label('service_number', 'Service Number:') !!}
            <div class='input-group date'>
                <input type='text' id="service_number" class="form-control" value="{{request()->get('service_number')}}"
                    name="service_number" />
                <span class="input-group-btn">
                    <button type="button" id="search-btn" class="btn"><i
                            class="glyphicon glyphicon-search"></i></button>
                </span>
            </div>
        </div>

        <div class="col-md-2">
            {!! Form::label('ms', 'Calling Party:') !!}
            <div class='input-group date'>
                <input type='text' id="ms" class="form-control" value="{{request()->get('calling_party_id')}}"
                    name="calling_party_id" />
                <span class="input-group-btn">
                    <button type="button" id="search-btn" class="btn"><i
                            class="glyphicon glyphicon-search"></i></button>
                </span>
            </div>
        </div>





        <div class="col-md-2">
            {!! Form::label('selfcare_command', 'Selfcare Command:') !!}
            <div class='input-group date'>
                <input type='text' id="selfcare_command" class="form-control"
                    value="{{request()->get('selfcare_command')}}" name="selfcare_command" />
                <span class="input-group-btn">
                    <button type="button" id="search-btn" class="btn"><i
                            class="glyphicon glyphicon-search"></i></button>
                </span>
            </div>
        </div>



        <div class="col-md-2">
            {!! Form::label('on_bearer_type', ' Bearer Type:') !!}
            <div class='input-group date'>
                <input type='text' id="on_bearer_type" class="form-control" value="{{request()->get('on_bearer_type')}}"
                    name="on_bearer_type" />
                <span class="input-group-btn">
                    <button type="button" id="search-btn" class="btn"><i
                            class="glyphicon glyphicon-search"></i></button>
                </span>
            </div>
        </div>

        <div class="col-md-2">
            {!! Form::label('on_result_code', 'Result Code:') !!}
            <div class=''>
                {!! Form::select('on_result_code', ['0'=>'Success' , '1' => 'Failed'] ,
                request()->get('on_result_code'),
                ['class'=>'form-control','id'=>'on_result_code','placeholder'=>'Select Result Code']) !!}
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
                <span dir="rtl" class="btn btn-success">{{ count($orange_webs) }} </span>
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
                            <th>SpId</th>
                            <th>Time Stamp</th>
                            <th>Service Number</th>
                            <th>Calling Party</th>
                            <th>Selfcare Command</th>
                            <th>Bearer Type</th>
                            <th>Result Code</th>
                            <th>Date Time</th>
                            <th>Result</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($orange_webs->count() > 0)
                        @foreach($orange_webs as $item)
                        <tr>
                            <td> {{ $item->id }}</td>
                            <td> {{ $item->spId }}</td>
                            <td> {{ $item->time_stamp }}</td>
                            <td> {{ $item->service_number }}</td>
                            <td> {{ $item->calling_party_id }} </td>
                            <td> {{ $item->selfcare_command }} </td>
                            <td> {{ $item->on_bearer_type }} </td>
                            <td>
                            @if($item->on_result_code == 0)
                                Success
                                @else
                                Failed
                                @endif

                            </td>
                            <td> {{ $item->created_at->format('Y-m-d h:i:s') }} </td>
                            <td>
                                <a href="{{url('admin/orange_webs/request_and_response/'.$item->id)}}" target="_blank">
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
        {!! $orange_webs->setPath('orange_webs') !!}
        @endif


    </div>
</div>

@include('backend.footer')
<script type="text/javascript">
$('#sub-item-5').addClass('collapse in');
$('#sub-item-5').parent().addClass('active').siblings().removeClass('active');
$('#datetimepicker').datepicker({
    format: "yyyy-mm-dd"
});
$('#datetimepicker1').datepicker({
    format: "yyyy-mm-dd"
});
</script>
