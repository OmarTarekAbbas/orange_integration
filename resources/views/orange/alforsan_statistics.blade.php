<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Alforsan Statistics</title>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link href="{{asset('css/datepicker3.css')}}" rel="stylesheet">


</head>

<style>
  body {
    background: #fff;
  }

  .form_content {
    width: 100%;
    margin: 10% auto;
  }

  .form_content div .form_grid {
    display: grid;
    grid-template-columns: 100%;
  }

  .form_content div .form_grid .logo {
    width: 60%;
    margin: auto;
    margin-bottom: 15%;
  }

  .form_content div .form_grid .logo_title {
    color: #000;
    margin-bottom: 10%;
  }

  .form_content div .form_grid .custom-select {
    width: 43%;
    margin: 5% auto;
    border: 1px solid #f60;
  }

  .form_content div .form_grid .input-group {
    border: 1px solid #f60;
    border-radius: 5px;
  }

  .form_content div .form_grid .filter {
    color: #fff;
    background-color: #f60;
  }

  .form_content div .form_grid .filter:focus {
    box-shadow: 0 0 0 0.2rem rgb(224 224 224);
  }

  .form_content div .form_grid .user_data {
    color: #fff;
    background-color: #f60;
    border-color: #eee;
  }

  .form_content div .form_grid .form-control:focus {
    box-shadow: 0 0 0 0.2rem #f60;
  }

  .form_content div .form_grid #phone {
    border: 1px solid #f60;
  }

  .form_content div .form_grid #zain_submit {
    background-color: #f60;
    color: #fff;
    width: 50%;
    margin: 5% auto;
  }

  .form_content div .form_grid #phone:focus {
    box-shadow: inset 0 1px 1px rgb(0 0 0 / 8%), 0 0 8px rgb(255 102 0);
  }

  .form_content .unsub_check a {
    color: #000;
    text-decoration: underline;
  }

  .input-group-addon {
    padding: 5px 12px;
    font-size: 16px;
    font-weight: 400;
    text-align: center;
    background-color: #eee;
    border: 1px solid #ccc;
    border-radius: 4px;
    color: #f60;
  }

  .input-group .form-control:last-child,
  .input-group-addon:last-child,
  .input-group-btn:last-child>.btn,
  .input-group-btn:last-child>.btn-group>.btn,
  .input-group-btn:last-child>.dropdown-toggle,
  .input-group-btn:first-child>.btn:not(:first-child),
  .input-group-btn:first-child>.btn-group:not(:first-child)>.btn {
    border-top-left-radius: 0;
    border-bottom-left-radius: 0;
  }

  .input-group-addon:last-child {
    border-left: 0;
  }

  .header_Nav {
    position: relative;
  }

  .header_Nav .navbar_btn {
    background-color: #f60;
    height: 100%;
    left: -56%;
    position: fixed;
    width: 60%;
    width: calc(200px);
    top: 0;
    transition: left 0.8s ease-in-out;
    z-index: 9999999999;
    overflow-x: hidden;
  }

  .header_Nav .navbar_btn .accordion {
    width: 100%;
    max-width: 360px;
    margin: 70px auto 20px;
    -webkit-border-radius: 4px;
    -moz-border-radius: 4px;
    border-radius: 4px;
    padding-right: 0;
  }

  .header_Nav .navbar_btn .accordion .link {
    text-align: left;
    cursor: pointer;
    display: block;
    padding: 15px 0 15px 12px;
    color: #fff;
    font-size: 13px;
    border-bottom: 2px solid #fff;
    position: relative;
    -webkit-transition: all 0.4s ease;
    -o-transition: all 0.4s ease;
    transition: all 0.4s ease;
  }

  .header_Nav .navbar_btn .accordion li:last-child .link {
    border-bottom: 0;
  }

  .hamburger-wrapper {
    cursor: pointer;
    display: block;
    position: absolute;
    left: 0;
    top: 11px;
    transition: background 0.8s ease-in-out;
    z-index: 9999999999;
  }

  /* hamburger */
  .hamburger {
    color: #f60;
    font-size: 1.25rem;
    position: absolute;
    top: 0.25rem;
    left: 1rem;
    transition: background 0.8s ease-in-out;
  }

  #menu-toggle {
    display: none;
  }

  #menu-toggle:checked+.hamburger-wrapper {
    background: transparent;
  }

  #menu-toggle:checked+label .burger-label {
    color: #fff;
  }

  #menu-toggle:checked~.navbar_btn {
    left: 0%;
  }

  @media (min-width: 1030px) {
    body {
      width: 25%;
      margin: auto;
    }

    #menu-toggle:checked~.navbar_btn {
      left: 38%;
    }
  }
</style>

<body>
  <header class="header_Nav">
    <input type="checkbox" id="menu-toggle">
    <label class="hamburger-wrapper" for="menu-toggle">
      <i class="hamburger fas fa-bars"></i>
    </label>

    <nav class="navbar_btn">
      <ul id="accordion" class="accordion list-unstyled">
        <li id="indexed">
          <a href="{{url('/sub_unsub')}}" class="link text-capitalize">subscribe & unsubscribe</a>
        </li>

        <li>
          <a href="{{url('/check_status')}}" class="link text-capitalize">Msisdn Check Status</a>
        </li>
      </ul>
    </nav>
  </header>

  <section class="form_content close_nav">
    <div class="container">
      @include("orange/alerts")
      <div id="form_zain">
        <div class="form_grid">

          <img class="logo" src="{{ asset('img/alforsan_logo.png') }}" alt="Al Forsan">

          <h4 class="logo_title text-center text-capitalize">Al Forsan service Revenue</h4>

          <div class="row">
            {!! Form::open(['url' => url('orange_revenue'),'method'=>'get', 'class'=>'all_form w-100'])!!}

            <div class="col-12">
              {!! Form::label('from_date', 'Select Form Date :') !!}
              <div class='input-group date' id='datetimepicker'>
                <input type='text' class="form-control" value="{{request()->get('from_date')}}" name="from_date" id="from_date" placeholder="Select Form Date" />
                <span class="input-group-addon">
                  <i class="far fa-calendar-alt"></i>
                </span>
              </div>
            </div>

            <div class="col-12">
              {!! Form::label('to_date', 'Select To Date :') !!}
              <div class='input-group date' id='datetimepicker1'>
                <input type='text' class="form-control" value="{{request()->get('to_date')}}" name="to_date" id="to_date" placeholder="Select To Date" />
                <span class="input-group-addon">
                  <i class="far fa-calendar-alt"></i>
                </span>
              </div>
            </div>

            <div class="col-12 text-center">
              <button class="btn filter m-3" type="submit">Filter</button>
            </div>
            {!! Form::close() !!}
          </div>

          <div class="alert user_data"> <span class="alert-inner--icon"><i class="ni ni-like-2"></i></span>

            @if (app('request')->input('from_date') && app('request')->input('to_date'))
            <p><b>Alforsan Revenue<b></b></b></p><b><b>
                <hr style="border-top: 1px solid #fff;">
                <p><b>All Success Charging:<b class="float-right"> {{$allSuccessCharging}}</b></b>
                </p><b><b>
                  </b></b>
                <p><b>All Failed Charging:<b class="float-right"> {{$allFailedCharging}}</b></b></p>
                <b><b>
                  </b></b>
              </b></b>
            </b></b>
            </b></b>
            </b></b>
            @else
            <p><b>Alforsan Revenue<b></b></b></p><b><b>
                <hr style="border-top: 1px solid #fff;">
                <p><b>Today Success Charging:<b class="float-right"> {{$todaySuccessCharging}} </b></b></p><b><b>
                    <p><b>Today Failed Charging:<b class="float-right"> {{$todayFailedCharging}}</b></b></p>
                    <b><b>
                        <p><b>All Success Charging:<b class="float-right"> {{$allSuccessCharging}}</b></b>
                        </p><b><b>
                          </b></b>
                        <p><b>All Failed Charging:<b class="float-right"> {{$allFailedCharging}}</b></b></p>
                        <b><b>
                          </b></b>
                      </b></b>
                  </b></b>
              </b></b>
            </b></b>
            @endif

          </div>

        </div>
      </div>

      <!-- <div class="unsub_check text-center text-capitalize">
        <a href="{{url('/sub_unsub')}}">subscribe & unsubscribe</a>
      </div>

      <div class="unsub_check text-center text-capitalize">
        <a href="{{url('/check_status')}}">Msisdn Check Status</a>
      </div> -->
  </section>

  <script src="{{asset('js/jquery-1.11.1.min.js')}}"></script>
  <script src="{{asset('js/bootstrap.min.js')}}"></script>
  <script src="{{asset('js/bootstrap-datepicker.js')}}"></script>

  <script type="text/javascript">
    $('#datetimepicker').attr("autocomplete", "off").datepicker({
      format: "yyyy-mm-dd"
    });

    $('#datetimepicker1').attr("autocomplete", "off").datepicker({
      format: "yyyy-mm-dd"
    });
  </script>

  <script>
    $(document).ready(function() {
      $(".close_nav").click(function() {
        $('#menu-toggle').prop('checked', false);
      });
    });
  </script>
</body>

</html>
