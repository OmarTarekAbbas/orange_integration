@include('backend.header')
<style>
  .form-control {
    border: 1px solid #ccc;
  }
</style>
<div class="row">
  <div class="col-lg-12">
    <h1 class="page-header">Orange Statistics Graph</h1>
  </div>
</div>

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

  <div class="form-group" style="border: solid 1px #ccc; margin: 0px 50px">
    {!! Form::open(['url' => url('admin/orange_statistics_graph'),'method'=>'get', 'class'=>'all_form', 'style'=>'width: 100%']) !!}

    <div class="col-md-5">
      {!! Form::label('from_date', 'Select Form Date :') !!}
      <div class='input-group date' id='datetimepicker'>
        <input type='text' class="form-control" value="{{request()->get('from_date')}}" name="from_date" id="from_date" placeholder="Select Form Date" autocomplete="off" />
        <span class="input-group-addon">
          <span class="glyphicon glyphicon-calendar"></span>
        </span>
      </div>
    </div>

    <div class="col-md-5">
      {!! Form::label('to_date', 'Select To Date :') !!}
      <div class='input-group date' id='datetimepicker1'>
        <input type='text' class="form-control" value="{{request()->get('to_date')}}" name="to_date" id="to_date" placeholder="Select To Date" autocomplete="off" />
        <span class="input-group-addon">
          <span class="glyphicon glyphicon-calendar"></span>
        </span>
      </div>
    </div>

    <div class="col-md-2">
      <button class="btn btn-labeled btn-primary" type="submit" style="margin-top: 25px; width: 200px;"><span class="btn-label"><i class="glyphicon glyphicon-search"></i></span>Filter</button>
    </div>

    <div id="download_excel_div" class="col-md-12">
      <p> You can get <strong> Orange Statistics </strong> from as excel by click on <a href='{{url("admin/orange_statistics_graph_download_to_excel")}}'><strong>download</strong></a> link</p>
    </div>
    {!! Form::close() !!}
  </div>


  <div id="billing_rate_graph_position" style="height: 370px; margin: 100px auto;"></div>

  <div id="cancel_rate" style="height: 370px; margin: 100px auto;"></div>

  <div id="subscribers_graph_position" style="height: 370px; margin: 100px auto;"></div>

  <div id="daily_unsub_subscribers_count" style="height: 370px; margin: 100px auto;"></div>

  <div id="all_charging_graph_position" style="height: 370px; margin: 100px auto;"></div>

  <div id="success_charging_count" style="height: 370px; margin: 100px auto;"></div>


  @include('backend.footer')
  <script type="text/javascript">
    $('#sub-item-5').addClass('collapse in');

    $('#datetimepicker').datepicker({
      format: "yyyy-mm-dd"
    });
    $('#datetimepicker1').datepicker({
      format: "yyyy-mm-dd"
    });
  </script>

  <script>
    $(document).ready(function() {
      var excel_data = @json($graph_data);

      // New Subscribers Graph
      var graph_data_value = 'new_count';
      var graph_title = 'New Subscribers';
      var graph_position = 'subscribers_graph_position';
      createGraph(excel_data, graph_data_value, graph_title, graph_position);

      //All Charging Graph
      var graph_data_value = 'billing_rate';
      var graph_title = ' Billing Rate';
      var graph_position = 'billing_rate_graph_position';
      createGraph(excel_data, graph_data_value, graph_title, graph_position);

      //All Charging Graph
      var graph_data_value = 'all_charging_count';
      var graph_title = 'All Charging User';
      var graph_position = 'all_charging_graph_position';
      createGraph(excel_data, graph_data_value, graph_title, graph_position);

      //All Charging Graph
      var graph_data_value = 'success_charging_count';
      var graph_title = 'successful charged User';
      var graph_position = 'success_charging_count';
      createGraph(excel_data, graph_data_value, graph_title, graph_position);

      //Unsub Subscribers Graph
      var graph_data_value = 'cancel_rate';
      var graph_title = 'Cancel Rate';
      var graph_position = 'cancel_rate';
      createGraph(excel_data, graph_data_value, graph_title, graph_position);

      //Unsub Subscribers Graph
      var graph_data_value = 'daily_unsub_subscribers_count';
      var graph_title = 'Unsub Subscribers';
      var graph_position = 'daily_unsub_subscribers_count';
      createGraph(excel_data, graph_data_value, graph_title, graph_position);
    });

    function createGraph(graph_data_points, graph_data_value, graph_title, graph_position) {
      var dataPoints = [];
      graph_data_points.forEach(function(graph_data_point) {
        var point = {};
        point['x'] = new Date(graph_data_point.date);
        point['y'] = graph_data_point[graph_data_value];

        dataPoints.push(point);
      });

      var chart = new CanvasJS.Chart(graph_position, {
        animationEnabled: true,
        title: {
          text: graph_title
        },
        axisX: {
          valueFormatString: "DD MMM,YYYY"
        },
        axisY: {
          title: graph_title,
        },
        legend: {
          cursor: "pointer",
          fontSize: 16,
          itemclick: toggleDataSeries
        },
        toolTip: {
          shared: true
        },
        data: [{
          name: graph_title,
          type: "spline",
          showInLegend: true,
          dataPoints: dataPoints
        }]
      });
      chart.render();

      function toggleDataSeries(e) {
        if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
          e.dataSeries.visible = false;
        } else {
          e.dataSeries.visible = true;
        }
        chart.render();
      }
    }
  </script>
  <script src="{{asset('js/canvasjs.min.js')}}"></script>