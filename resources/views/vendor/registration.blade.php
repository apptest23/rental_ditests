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
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha256-aAr2Zpq8MZ+YA/D6JtRD3xtrwpEz2IqOS+pWD/7XKIw=" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" integrity="sha512-xmGTNt20S0t62wHLmQec2DauG9T+owP9e6VU8GigI0anN7OXLip9i7IwEhelasml2osdxX71XcYm6BQunTQeQg==" crossorigin="anonymous" />

  <link rel="icon" href="image/logo.png">
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
  <div class="signup d-flex align-items-center flex-column justify-content-center h-100 text-dark">
      <div class="row" id="loginForm">
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
          <div class="col-md-8 col-sm-12 text" id="right">
              <h2>Sign Up Now</h2>
             <form method="post" action="{{url('Partner/store_vendor')}}">
                @csrf
                  <div class="form-group mt-3">
              <input class="form-control" type="text" placeholder="Name" name="name">
                         @if($errors->has('name')) <p class="error_mes">{{ $errors->first('name') }}</p> @endif
          </div>
          <div class="form-group">

                             <div class="show_code">
                      
                                    <div class="di_felx">
                                       <p class="c_code">+91</p>
                                       <input type="number" name="phone_no"  class="form-control" id="exampleInputPassword1" placeholder="Phone Number">

                                    </div>
                                 
                                     @if($errors->has('phone_no')) <p class="error_mes">{{ $errors->first('phone_no') }}</p> @endif
                               </div>
                  
                            <!-- <input class="form-control" id="exampleInputPassword1" type="number" name="Phone" placeholder="Phone Number"> -->
          </div>
          <div class="form-group">
              <input class="form-control" id="exampleInputPassword1" type="text" name="email" placeholder="Email Address">
                          @if($errors->has('email')) <p class="error_mes">{{ $errors->first('email') }}</p> @endif

          </div>
          <div class="form-group">
              <input class="form-control" type="password" name="password" placeholder="password">
                            @if($errors->has('password')) <p class="error_mes">{{ $errors->first('password') }}</p> @endif
                  </div>
                  <div class="form-group">
              <input class="form-control" type="password" name="Confirm_Password" placeholder="Confirm Password">
                         @if($errors->has('Confirm_Password')) <p class="error_mes">{{ $errors->first('Confirm_Password') }}</p> @endif
                  </div>
                  <div class="form-group">
                    <textarea class="form-control" placeholder="Enter Address" name="address" value=""  spellcheck="false"></textarea>
                        @if($errors->has('address')) <p class="error_mes">{{ $errors->first('address') }}</p> @endif
                  </div>

                      <div class="form-group">
              <input class="form-control" type="text" data-role="tagsinput" name="products" placeholder="products">
                         @if($errors->has('products')) <p class="error_mes">{{ $errors->first('products') }}</p> @endif
                  </div>



                  <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" value="1" name="terms_condition">I agree to the terms of service
                             @if($errors->has('terms_condition')) <p class="error_mes">{{ $errors->first('terms_condition') }}</p> @endif
                        </label>
                    </div>


                    <button type="submit" class="submit">Sign Up Now</button>
              </form>
          </div>
          <div class="col-md-4 p-0">
            <div class="image_vander">
              <img src="/image/wedding-1.jpg">
            </div>
          </div>
      </div>
  </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.js" integrity="sha512-VvWznBcyBJK71YKEKDMpZ0pCVxjNuKwApp4zLF3ul+CiflQi6aIJR+aZCP/qWsoFBA28avL5T5HA+RE+zrGQYg==" crossorigin="anonymous"></script>
 


    <script type="text/javascript">

                $(function() {
         setTimeout(function() { $("#hideDiv").fadeOut(1500); }, 3000)

        });


     $(function() {
         setTimeout(function() { $("#hideDiv1").fadeOut(1500); }, 3000)

        });
        
        

         $(".show_code").click(function(){
        $(".c_code").show();
      });
    </script>

    <style type="text/css">
.show_code{
    position: relative;
   
}
.c_code{

      display: none;
}
        
p.c_code {
    margin: 0;
    position: absolute;
    top: 10px;
    left: 32px;
}
.form-control {
    display: block;
    width: 80% !important;
    margin: auto !important;
}

 .error_mes{

    text-align: center;
    color: #dc3545;
    font-size: 12.5px!important;
    text-transform: capitalize !important;
    font-weight: 600;
    padding-top: 7px;
}

.form-check {
  
    text-align: center;
}


 .bootstrap-tagsinput{
        width: 100%;
    }
    .label-info{
        background-color: #17a2b8;

    }
    .label {
        display: inline-block;
        padding: .25em .4em;
        font-size: 75%;
        font-weight: 700;
        line-height: 1;
        text-align: center;
        white-space: nowrap;
        vertical-align: baseline;
        border-radius: .25rem;
        transition: color .15s ease-in-out,background-color .15s ease-in-out,
        border-color .15s ease-in-out,box-shadow .15s ease-in-out;
    }

    </style>
</body>
</html>