<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>orange</title>
  <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
</head>

<style>
  body {
    background: #0f1218;
    direction: rtl;
    text-align: right;
  }


  .form_content {
    margin: 0px auto;
  }

  .form_content form .form_grid {
    display: grid;
    grid-template-columns: 100%;
  }

  .form_content form .form_grid .logo {
    margin: auto;
    margin-bottom: 5%;
    height: 50%;
  }

  .form_content form .form_grid .logo_title {
    color: #FFF;
  }

  .form_content form .form_grid .dropdown {
    margin: 5% auto;
  }

  .form_content form .form_grid .dropdown .dropdown-menu {
    text-align: right;
  }

  .form_content form .form_grid .dropdown .btn,
  .form_content form .form_grid #phone {
    border: 1px solid #f60;
    width: 50%;
    margin: 0px auto;
  }

  .form_content form .form_grid #zain_submit {
    background-color: #f60;
    color: #fff;
    width: 50%;
    margin: 2% auto;
  }

  .form_content form .form_grid #phone:focus {
    box-shadow: inset 0 1px 1px rgb(0 0 0 / 8%), 0 0 8px rgb(255 102 0);
  }

  .user_data {
    width: 50%;
    margin: 0px auto;
  }
</style>

<body>

  <div class="form_content">
    <div class="container">
      @include("orange/alerts")
      <form method="post" action="{{ route('orange.check_status.submit') }}" id="form_zain">
        @csrf
        <div class="form_grid">

          <img class="logo" src="{{ asset('img/orange.png') }}" alt="Orange">

          <h3 class="logo_title text-center">خدمة أورنج الخير</h3>

          <input type="hidden" id="service_id" name="service_id" value=1000000577>

          <input type="tel" class="form-control show_class" id="phone" value="" placeholder="من فضلك ادخل رقم الهاتف" name="msisdn" required>

          <button id="zain_submit" class="btn text-capitalize">استعلام</button>
        </div>
      </form>
    </div>
  </div>

  <div class="alert alert-success user_data">
    <span class="alert-inner--icon"><i class="ni ni-like-2"></i></span>
    <span class="alert-inner--text"><strong>{{ trans('Success!') }}</strong> {{ session()->get('success') }}</span>
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <p> hello <p>
  </div>;

  <script src="{{asset('js/jquery-1.11.1.min.js')}}"></script>
  <script src="{{asset('js/bootstrap.min.js')}}"></script>
</body>

</html>
