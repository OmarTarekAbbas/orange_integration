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

          <img class="logo" src="{{ asset('img/orange.png') }}" alt="Orange">

          <h3 class="logo_title text-center">خدمة أورنج الخير</h3>

          <div class="dropdown">

            <select name="command" id="command"  required  style="width: 300%">
              <option value="">من فضلك اختر</option>
              <option value="SUBSCRIBE">اشترك</option>
              <option value="UNSUBSCRIBE">إلغاء الاشتراك</option>
            </select>

          </div>

        <input type="tel" class="form-control show_class" id="phone" value=""  name="msisdn" required >
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
