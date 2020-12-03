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

  <div class="form-group">
    {!! Form::open(['url' => url('admin/orange_provisions'),'method'=>'get', 'class'=>'all_form']) !!}

    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
      {!! Form::label('se', 'spId:') !!}
      <div class='input-group date'>
        <input type='text' id="se" class="form-control" value="{{request()->get('spId')}}" name="spId" placeholder="SpId" />
        <span class="input-group-btn">
          <button type="button" id="search-btn" class="btn"><i class="glyphicon glyphicon-search"></i></button>
        </span>
      </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
      {!! Form::label('timeStamp', 'timeStamp:') !!}
      <div class='input-group date'>
        <input type='text' id="timeStamp" class="form-control" value="{{request()->get('timeStamp')}}" name="timeStamp" placeholder="Time Stamp" />
        <span class="input-group-btn">
          <button type="button" id="search-btn" class="btn"><i class="glyphicon glyphicon-search"></i></button>
        </span>
      </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
      {!! Form::label('transactionId', 'transaction Id:') !!}
      <div class='input-group date'>
        <input type='text' id="transactionId" class="form-control" value="{{request()->get('transactionId')}}" name="transactionId" placeholder="Transaction Id" />
        <span class="input-group-btn">
          <button type="button" id="search-btn" class="btn"><i class="glyphicon glyphicon-search"></i></button>
        </span>
      </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
      {!! Form::label('msisdn', 'Msisdn:') !!}
      <div class='input-group date'>
        <input type='text' id="msisdn" class="form-control" value="{{request()->get('msisdn')}}" name="msisdn" placeholder="Msisdn" />
        <span class="input-group-btn">
          <button type="button" id="search-btn" class="btn"><i class="glyphicon glyphicon-search"></i></button>
        </span>
      </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
      {!! Form::label('serviceId', 'Service Id:') !!}
      <div class='input-group date'>
        <input type='text' id="serviceId" class="form-control" value="{{request()->get('serviceId')}}" name="serviceId" placeholder="Service Id" />
        <span class="input-group-btn">
          <button type="button" id="search-btn" class="btn"><i class="glyphicon glyphicon-search"></i></button>
        </span>
      </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
      {!! Form::label('operationType', 'operationType:') !!}
      <div class='input-group date'>
        <input type='text' id="operationType" class="form-control" value="{{request()->get('operationType')}}" name="operationType" placeholder="Operation Type" />
        <span class="input-group-btn">
          <button type="button" id="search-btn" class="btn"><i class="glyphicon glyphicon-search"></i></button>
        </span>
      </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
      {!! Form::label('createdTime', 'Created Time:') !!}
      <div class='input-group date'>
        <input type='text' id="createdTime" class="form-control" value="{{request()->get('createdTime')}}" name="createdTime" placeholder="Created Time" />
        <span class="input-group-btn">
          <button type="button" id="search-btn" class="btn"><i class="glyphicon glyphicon-search"></i></button>
        </span>
      </div>
    </div>

    <!-- <div class="col-md-2">
            {!! Form::label('resultCode', 'resultCode:') !!}
            <div class='input-group date'>
                <input type='text' id="resultCode" class="form-control" value="{{request()->get('resultCode')}}"
                    name="resultCode" />
                <span class="input-group-btn">
                    <button type="button" id="search-btn" class="btn"><i
                            class="glyphicon glyphicon-search"></i></button>
                </span>
            </div>
        </div> -->

    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
      {!! Form::label('resultCode', 'resultCode:') !!}
      <div class=''>
        {!! Form::select('resultCode', ['00000000'=>'Success' , '0' => 'Failed'] ,
        request()->get('resultCode'),
        ['class'=>'form-control','id'=>'notification_result','placeholder'=>'Select resultCode']) !!}
      </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
      {!! Form::label('from_date', 'Select Form Date :') !!}
      <div class='input-group date' id='datetimepicker'>
        <input type='text' class="form-control" value="{{request()->get('from_date')}}" name="from_date" id="from_date" placeholder="Select Form Date" />
        <span class="input-group-addon">
          <span class="glyphicon glyphicon-calendar"></span>
        </span>
      </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
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
      <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
        <div class="box-title">
          @if(Session::has('success'))
          <div class="alert alert-success">
            {{ Session::get('success') }}
          </div>
          @endif
          <h3>Orange Ussds</h3>
        </div>
      </div>

      <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
        <div class="pull-right">
          {!! Form::label('date', 'Count :') !!}
          <div class='input-group date' style="display: inline-block;">
            <span dir="rtl" class="btn btn-success borderCircle">{{ count($orange_provisions) }} </span>
          </div>
        </div>
      </div>

      <div class="col-xs-6 col-sm-12 col-md-12" style="padding: 0;">
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

                <td>
                  @if($item->resultCode == 00000000)
                  Success
                  @else
                  Failed
                  @endif
                </td>
                <td> {{ $item->created_at->format('Y-m-d h:i:s') }} </td>
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
    </div>

    @if(!$without_paginate)
    {!! $orange_provisions->setPath('orange_provisions') !!}
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
