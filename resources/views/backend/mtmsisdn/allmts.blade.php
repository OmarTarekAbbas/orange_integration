@include('backend.header')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">MT Msisdn History</h1>
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

    <div class="form-search">
        {!! Form::open(['url'=>'admin/mtmsisdnhistory','method'=>'get']) !!}
        <div class="input-group">
            {!! Form::text('msisdn', request('msisdn') ?? null, ['class'=>'form-control','placeholder'=>'Search ..']) !!}
            <span class="input-group-btn">
                <button type="submit" id="search-btn" class="btn"><i class="glyphicon glyphicon-search"></i></button>
            </span>
        </div>
    </div>
    <br>
    <div class="form-group">
        <div class="col-md-2">
            @if(Auth::user()->admin == true)
            <div class="input-group">
                {!! Form::label('service_id', 'Select Service :') !!}
                <select name="service_id" class="form-control" id="service_id">
                    <option value="">Select Service</option>
                    @foreach(\App\Service::all() as $service)
                    <option value="{{$service->id}}" {{$service->id == request('service_id') ? 'selected' : ''}}>
                        {{ $service->title." | " . $service->operator->title . ' - '.$service->operator->country->name }}
                    </option>
                    @endforeach
                </select>

            </div>
            @endif
        </div>
        <div class="col-md-2">
            {!! Form::label('date', 'Select Date :') !!}
            <div class='input-group date' id='datetimepicker1'>
                <input type='text' value="{{request('date') ?? ''}}" class="form-control" name="date" id="date" />
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
        </div>

        <div class="col-md-2">
            <div class="input-group">
                {!! Form::label('status', 'Select Status :') !!}
                <select name="status" class="form-control" id="service_id">
                    <option value="">Select Status</option>
                    <option value="1" {{ "1" == request('status') ? 'selected' : ''}}>SUCCESS</option>
                    <option value="0" {{ "0" == request('status') ? 'selected' : ''}}>FAIL</option>

                </select>

            </div>
        </div>

        <div class="col-md-1">
            <br>
            <button class="btn btn-labeled btn-info filter" type="submit"><span class="btn-label"><i
                        class="glyphicon glyphicon-search"></i></span>Filter</button>
        </div>

    </div>

    <div class="col-xs-12">
        <div class="box">
            <div class="box-title col-md-4">

                <h3>Messages</h3>
            </div>
            <div class="col-md-4">
                {!! Form::close() !!}
            </div>
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover table-striped mt-table">
                    <thead>
                        <tr>
                            <th>Msisdn</th>
                            <th>Service ID</th>
                            <th>Link</th>
                            <th>Send Status</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>

                        @if($msisdns->count() > 0)
                        @foreach($msisdns as $msisdn)
                        <tr>

                            <td>{{ $msisdn->msisdn }}</td>

                            <td>{{ $msisdn->service->title }}</td>

                            <td>{{ $msisdn->link }}</td>

                            <td>
                                @if($msisdn->send_status == 'SUCCESS')
                                Yes
                                @else
                                No
                                @endif
                            </td>

                            <td>{{ $msisdn->created_at }}</td>

                        </tr>
                        @endforeach
                        @endif

                    </tbody>
                </table>

            </div>
        </div>

        {!! $msisdns->setPath('msisdn'); !!}

    </div>

</div>

@include('backend.footer')
<script type="text/javascript">
    $('#datetimepicker1').datepicker({
        format: "yyyy-mm-dd"
    });
    function select_all(){
        $('.select_all_template').each(function(){
          $(this).prop("checked", !$(this).prop("checked"));
        })
      }
</script>
