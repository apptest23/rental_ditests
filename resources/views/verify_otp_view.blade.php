<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>RENTAL SYSTEM</title>
    <link rel="stylesheet" type="text/css" href="/css/home.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="icon" href="image/logo.png">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body  onload="myFunction()">

    <div class="co_login">
        <div class="row">
            <div class="col-lg-12">
                <div class="cont">


              @if ($message = Session::get('success'))
                 <div  id="hideDiv1" class="alert alert-success alert-block suceess_mes" >
                <!--     <input type="text" class="close" data-dismiss="alert"></input> -->
                 <strong style="padding-top : 5px !important; display: inline-block;">{{ $message }}</strong>
                 </div>
               @endif


              @if ($message = Session::get('error'))
                 <div  id="hideDiv" class="alert alert-danger alert-block error-mes1"  >
                <!--     <input type="text" class="close" data-dismiss="alert"></input> -->
                 <strong style="padding-top : 5px !important; display: inline-block;">{{ $message }}</strong>
                 </div>
               @endif

                    <div class="count-head">
                        <h2>Verify OTP</h2>
                    </div>
                    <div class="form sign-in">
                  <form method="post" action="{{url('User/verify_otp')}}/{{$id}}">
                         @csrf

  
                        <label>
                            <span>OTP</span>
                            <input type="number" name="otp">
                            <span class="underline"></span>
                          @if($errors->has('otp')) <p class="error_mes">{{ $errors->first('otp') }}</p> @endif
                        </label>

                          <a href="">Resend OTP</a>
                    
                        <button class="submit" type="submit">Verify OTP</button>

                    </form>
                     
                        <!-- <p class="forgot">Buying for work? <span>Create a free business account</span></p> -->
                    </div>

                    <div class="sub-cont">
                        <div class="img">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="login-img">
                                        <img src="/image/product-49.jpg">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="login-img">
                                        <img src="/image/product-10.jpg">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="login-img x-img">
                                        <img src="/image/product-11.webp">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="login-img">
                                        <img src="/image/product-27.jpg">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="login-img">
                                        <img src="/image/product-32.jpg">
                                    </div>
                                </div>
                            </div>
                            <div class="img-text m-up">
                                <h2>New here?</h2>
                                <p>Sign up and discover great amount of new opportunities!</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>      
    </div>
    <!-- <div class="co_login">
        <div class="row">
            <div class="col-lg-12">
                <div class="cont">
                    <div class="form sign-in">
                      <h2>Recover your password</h2>
                      <label>
                        <span>Email Address</span>
                        <input type="email" name="email">
                      </label>
                      <button class="submit" type="button">Send me email</button>

                      <div class="extra-login clearfix">
                            <span>Or Login With</span>
                        </div>
                        <div class="social-list">
                            <a href="#" class="facebook-bg">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="#" class="twitter-bg">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="#" class="google-bg">
                                <i class="fab fa-google"></i>
                            </a>
                            <a href="#" class="linkedin-bg">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                        </div>
                        
                    </div>

                    <div class="sub-cont">
                      <div class="img">
                        <div class="img-text m-up">
                          <h2>New here?</h2>
                          <p>Sign up and discover great amount of new opportunities!</p>
                        </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>      
    </div> -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

   <script type="text/javascript">

        $(".show_code").click(function(){
        $(".c_code").show();
      });

        
              $(function() {
         setTimeout(function() { $("#hideDiv").fadeOut(1500); }, 3000)

        });


     $(function() {
         setTimeout(function() { $("#hideDiv1").fadeOut(1500); }, 3000)

        });
        
    

</script>
<style type="text/css">

    .cont {
 
    height: 512px;

}

.count-head{

        margin-top: 80px;
}
  


    
        p.c_code {
    margin: 0;
    border-bottom: 1px solid #c5bebe;
    padding-bottom: 6px;
    display: none;
}

.suceess_mes{
    color: #449556;
    text-align: center;
    width: 72%;
    font-size: 18px;
    top: 46px;
    font-weight: 400;
    background-color: white !important;
    border: none!important;
}

.error-mes1{

    width: 71%;
    text-align: center;
    top: 46px;
    color: #df453e;
    font-size: 18px;

    background-color: white !important;
    border: none!important; 

}

 .error_mes{

    text-align: center;
    color: #dc3545;
    font-size: 12.5px!important;
    text-transform: capitalize !important;
    font-weight: 600;
    padding-top: 7px;
}


</style>
</body> 
</html>