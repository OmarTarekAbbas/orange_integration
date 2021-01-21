@include('backend.header')
<div class="row">
  <div class="col-lg-12">
    <h1 class="page-header">All Orange Whitelists</h1>
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
    {!! Form::open(['url' => url('admin/orange_whitelists'),'method'=>'get', 'class'=>'all_form']) !!}

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
          <div class='input-group date' style="display: inline-block;">
            <span dir="rtl" class="btn btn-success borderCircle">{{ count($orange_whitelists) }} </span>
          </div>
        </div>
      </div>

      <div class="box-body table-responsive no-padding">
        <table class="table table-hover table-striped mt-table">
          <thead>
            <tr>
              <th>ID</th>
              <th>Msisdn</th>
              <th>Date Time</th>
            </tr>
          </thead>
          <tbody>
            @if($orange_whitelists->count() > 0)
            @foreach($orange_whitelists as $item)
            <tr>
              <td> {{ $item->id }}</td>
              <td> {{ $item->msisdn }}</td>
              <td> {{ $item->created_at->format('Y-m-d h:i:s') }} </td>
              @endforeach
              @endif
          </tbody>
        </table>

      </div>
    </div>

    @if(!$without_paginate)
    {!! $orange_whitelists->setPath('orange_whitelists') !!}
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
