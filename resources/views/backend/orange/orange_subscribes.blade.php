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

  <div class="form-group">
    {!! Form::open(['url' => url('admin/orange_subscribes'),'method'=>'get', 'class'=>'all_form']) !!}

    <div class="col-md-4">
      {!! Form::label('ms', 'Msisdn:') !!}
      <div class='input-group date'>
        <input type='text' id="ms" class="form-control" value="{{request()->get('msisdn')}}" name="msisdn" placeholder="Msisdn" />
        <span class="input-group-btn">
          <button type="button" id="search-btn" class="btn"><i class="glyphicon glyphicon-search"></i></button>
        </span>
      </div>
    </div>

    <div class="col-md-4">
      {!! Form::label('active', 'Active:') !!}
      <div class=''>
        {!! Form::select('active', ['1'=>'Active' , '0' => 'Pending' , '2' => 'OptOut'] ,
        request()->get('active'),
        ['class'=>'form-control','id'=>'active','placeholder'=>'Select Active']) !!}
      </div>
    </div>

    <div class="col-md-4">
      {!! Form::label('orange_channel_id', 'Orange Notify Id:') !!}
      <div class='input-group date'>
        <input type='text' id="orange_channel_id" class="form-control" value="{{request()->get('orange_channel_id')}}" name="orange_channel_id" placeholder="Orange Notify Id" />
        <span class="input-group-btn">
          <button type="button" id="search-btn" class="btn"><i class="glyphicon glyphicon-search"></i></button>
        </span>
      </div>
    </div>

    <div class="col-md-4">
      {!! Form::label('table_name', 'Table Name:') !!}
      <div class=''>
        {!! Form::select('table_name', ['orange_notifies'=>'orange_notifies' , 'orange_ussds' => 'orange_ussds' , 'orange_webs' => 'orange_webs' , 'orange_whitelists' => 'orange_whitelists']
        ,
        request()->get('table_name'),
        ['class'=>'form-control','id'=>'table_name','placeholder'=>'Select Table Name']) !!}
      </div>
    </div>

    <div class="col-md-4">
      {!! Form::label('from_date', 'Select Form Date :') !!}
      <div class='input-group date' id='datetimepicker'>
        <input type='text' class="form-control" value="{{request()->get('from_date')}}" name="from_date" id="from_date" placeholder="Select Form Date" />
        <span class="input-group-addon">
          <span class="glyphicon glyphicon-calendar"></span>
        </span>
      </div>
    </div>

    <div class="col-md-4">
      {!! Form::label('to_date', 'Select To Date :') !!}
      <div class='input-group date' id='datetimepicker1'>
        <input type='text' class="form-control" value="{{request()->get('to_date')}}" name="to_date" id="to_date" placeholder="Select To Date" />
        <span class="input-group-addon">
          <span class="glyphicon glyphicon-calendar"></span>
        </span>
      </div>
    </div>

    <div class="col-md-12">
      <br>
      <button class="btn btn-labeled btn-primary filter" type="submit"><span class="btn-label"><i class="glyphicon glyphicon-search"></i></span>Filter</button>
    </div>
    {!! Form::close() !!}
  </div>

  <div class="col-xs-12">
    <div class="box">
      <div class="col-md-6">
        <div class="box-title">
          @if(Session::has('success'))
          <div class="alert alert-success">
            {{ Session::get('success') }}
          </div>
          @endif
          <h3>Orange Ussds</h3>
        </div>
      </div>

      <div class="col-md-6">
        <div class="pull-right">
          {!! Form::label('date', 'Count :') !!}
          <div class='input-group date'  style="display: inline-block;">
            <span dir="rtl" class="btn btn-success borderCircle">{{ count($orange_subscribes) }} </span>
          </div>
        </div>
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
                @elseif($item->active == 0)
                Pending
                @else
                OptOut
                @endif
              </td>
              <td> {{ $item->orange_channel_id }}</td>
              <td> {{ $item->table_name }}</td>
              <td> {{ $item->created_at->format('Y-m-d h:i:s') }} </td>

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
  $('#sub-item-5').addClass('collapse in');
  $('#sub-item-5').parent().addClass('active').siblings().removeClass('active');
  $('#datetimepicker').datepicker({
    format: "yyyy-mm-dd"
  });
  $('#datetimepicker1').datepicker({
    format: "yyyy-mm-dd"
  });
</script>
