<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alforsan Statistics</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
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

.form_content form .form_grid {
    display: grid;
    grid-template-columns: 100%;
}

.form_content form .form_grid .logo {
    width: 60%;
    margin: auto;
    margin-bottom: 15%;
}

.form_content form .form_grid .logo_title {
    color: #000;
    margin-bottom: 10%;
}

.form_content form .form_grid .custom-select {
    width: 43%;
    margin: 5% auto;
    border: 1px solid #f60;
}

.form_content form .form_grid .input-group-text {
    border: 1px solid #f60;
    background-color: #f60;
    color: #FFF;
}

.form_content form .form_grid #phone {
    border: 1px solid #f60;
}

.form_content form .form_grid #zain_submit {
    background-color: #f60;
    color: #fff;
    width: 50%;
    margin: 5% auto;
}

.form_content form .form_grid #phone:focus {
    box-shadow: inset 0 1px 1px rgb(0 0 0 / 8%), 0 0 8px rgb(255 102 0);
}

.form_content .unsub_check a {
    color: #000;
    text-decoration: underline;
}
.borderCircle{
  background-color: #f60;
  color: #FFF;
}
</style>
<body>

    <section class="form_content">
        <div class="container">
            @include("orange/alerts")
            <form id="form_zain">
                <div class="form_grid">

                    <img class="logo" src="{{ asset('img/alforsan_logo.png') }}" alt="Al Forsan">

                    <h3 class="logo_title text-center text-capitalize">Al Forsan service</h3>

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Date</th>
                                <th scope="col"><span dir="rtl" class="btn borderCircle">{{$date}}</span></th>
                            </tr>
                            <tr>
                                <th scope="col">Today Success Charging</th>
                                <th scope="col"><span dir="rtl" class="btn borderCircle">{{$todaySuccessCharging}}</span></th>
                            </tr>

                            <tr>
                                <th scope="col">Today Failed Charging</th>
                                <th scope="col"><span dir="rtl" class="btn borderCircle">{{$todayFailedCharging}}</span></th>
                            </tr>

                            <tr>
                                <th scope="col">All Success Charging</th>
                                <th scope="col"><span dir="rtl" class="btn borderCircle">{{$allSuccessCharging}}</span></th>
                            </tr>

                            <tr>
                                <th scope="col">All Failed Charging</th>
                                <th scope="col"><span dir="rtl" class="btn borderCircle">{{$allFailedCharging}}</span></th>
                            </tr>
                        </thead>

                    </table>

                </div>
            </form>

            <div class="unsub_check text-center text-capitalize">
            </div>

            <!--<h5>للاشتراك يرجى الارسال الى <span>965</span></h5>
                <h5>الى <span>965</span><span> STOP1 </span>لالغاء الاشتراك ارسل</h5>-->
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous">
    </script>
</body>

</html>
