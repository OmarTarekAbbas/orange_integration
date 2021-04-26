<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alforsan Statistics</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{asset('css/datepicker3.css')}}" rel="stylesheet">


</head>

<style>
body {
    background: #fff;
}

@media (min-width: 1030px) {
    body {
        width: 25%;
        margin: auto;
    }
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

.form_content div .form_grid .input-group-text {
    border: 1px solid #f60;
    background-color: #f60;
    color: #FFF;
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

.all_form {
    display: contents;
}
</style>

<body>

    <section class="form_content">

        <div class="container">
            @include("orange/alerts")
            <div id="form_zain">
                <div class="form_grid">

                    <img class="logo" src="{{ asset('img/alforsan_logo.png') }}" alt="Al Forsan">

                    <h3 class="logo_title text-center text-capitalize">Al Forsan service</h3>




                    <div class="row">
                        {!! Form::open(['url' => url('alforsan_statistics'),'method'=>'get',
                        'class'=>'all_form'])!!}

                        <div class="col-md-6">
                            {!! Form::label('from_date', 'Select Form Date :') !!}
                            <div class='input-group date' id='datetimepicker'>
                                <input type='text' class="form-control" value="{{request()->get('from_date')}}"
                                    name="from_date" id="from_date" placeholder="Select Form Date" />
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            {!! Form::label('to_date', 'Select To Date :') !!}
                            <div class='input-group date' id='datetimepicker1'>
                                <input type='text' class="form-control" value="{{request()->get('to_date')}}"
                                    name="to_date" id="to_date" placeholder="Select To Date" />
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>

                        <div class="col-md-12" style="padding: 10px 0 12px 0px;text-align: center;">
                            <button class="btn btn-labeled btn-primary filter" type="submit"><span class="btn-label"><i
                                        class="glyphicon glyphicon-search"></i></span>Filter</button>
                        </div>
                        {!! Form::close() !!}
                    </div>




                    <div class="alert alert-success user_data"> <span class="alert-inner--icon"><i
                                class="ni ni-like-2"></i></span>

                        <p><b>Alforsan Revenue<b></b></b></p><b><b>
                                <hr>
                                <br>
                                <p><b>Date:<b> {{$date}} </b></b></p><b><b>
                                        <p><b>Today Success Charging:<b> {{$todaySuccessCharging}} </b></b></p><b><b>
                                                <p><b>Today Failed Charging:<b> {{$todayFailedCharging}}</b></b></p>
                                                <b><b>
                                                        <p><b>All Success Charging:<b> {{$allSuccessCharging}}</b></b>
                                                        </p><b><b>
                                                            </b></b>
                                                        <p><b>All Failed Charging:<b> {{$allFailedCharging}}</b></b></p>
                                                        <b><b>
                                                            </b></b>
                                                    </b></b>
                                            </b></b>
                                    </b></b>
                            </b></b>
                    </div>

                </div>
            </div>

            <div class="unsub_check text-center text-capitalize">
            </div>

            <!--<h5>للاشتراك يرجى الارسال الى <span>965</span></h5>
                <h5>الى <span>965</span><span> STOP1 </span>لالغاء الاشتراك ارسل</h5>-->
        </div>
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
</body>

</html>
