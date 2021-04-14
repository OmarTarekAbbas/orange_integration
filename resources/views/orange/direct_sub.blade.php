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
    background: #fff;
    direction: rtl;
    text-align: right;
  }


  .form_content {
    width: 85%;
    margin: 10% auto;
  }

  .form_content form .form_grid {
    display: grid;
    grid-template-columns: 100%;
  }

  .form_content form .form_grid .logo {
    width: 50%;
    margin: auto;
    margin-bottom: 10%;
  }

  .form_content form .form_grid .logo_title {
    color: black;
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
</style>

<body>

  <div class="form_content">
    <div class="container">
       @include("orange/alerts")
      <form method="post" action="{{ route('orange.form.submit') }}" id="form_zain">
        @csrf
        <div class="form_grid">

          <img class="logo" src="{{ asset('img/alforsan_logo.png') }}" alt="Elforsan">

          <h3 class="logo_title text-center">خدمة الفورسان </h3>

          <div class="dropdown">
            <button class="btn dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
            من فضلك اختر
              <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
              <li><a href="#" onclick="document.getElementById('command').value = 'SUBSCRIBE'">اشترك</a></li>
              <li><a href="#" onclick="document.getElementById('command').value = 'UNSUBSCRIBE'">إلغاء الاشتراك</a></li>
            </ul>
          </div>
          <input type="hidden" id="command" name="command" >
          <input type="hidden" id="bearer_type" name="bearer_type" value=WEB>
          <input type="hidden" id="service_id" name="service_id" value=1000004448 >
          <input type="tel" class="form-control show_class" id="phone" value="" placeholder="Enter Your No." name="number" required>
          <button id="zain_submit" class="btn text-capitalize">submit</button>
        </div>
      </form>

      <!--<h5>للاشتراك يرجى الارسال الى <span>965</span></h5>
                <h5>الى <span>965</span><span> STOP1 </span>لالغاء الاشتراك ارسل</h5>-->
    </div>
  </div>

  <script src="{{asset('js/jquery-1.11.1.min.js')}}"></script>
  <script src="{{asset('js/bootstrap.min.js')}}"></script>
</body>

</html>
