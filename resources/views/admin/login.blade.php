<html>
<head>
  <title>admin</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" type="text/css" href="/css/home1.css">
      <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
      <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
      <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.9/slick.min.css">
</head>

<body>
   <div class="admin_login">
      <div class="logo">
         <h1><a href="index.html">rent<span>al</span></a></h1>
      </div>
      <h3 class="top_head">ADMIN LOGIN</h3>


                    @if ($message = Session::get('error'))
           <div id="hideDiv"class="alert alert-danger alert-block" >
<!--     <input type="text" class="close" data-dismiss="alert"></input> -->
           <strong style=" padding-top : 5px !important; display: inline-block;">{{ $message }}</strong>
           </div>
                      @endif

                        @if ($message = Session::get('success'))
           <div id="hideDiv"class="alert alert-success alert-block" >
<!--     <input type="text" class="close" data-dismiss="alert"></input> -->
           <strong style=" padding-top : 5px !important; display: inline-block;">{{ $message }}</strong>
           </div>
                      @endif


       <form class="user-form" method="POST" action="{{ route('login') }}">
         @csrf
         <div class="user">
            <i class="fas fa-user-circle"></i>
            <input  type="text" name="email" class="form-control" placeholder="Enter your username" />
             @if($errors->has('email')) <p class="error_mes">{{ $errors->first('email') }}</p> @endif
         </div>
         <div class="user">
            <i class="fas fa-lock-alt"></i>
            <input type="password" name="password" class="form-control" placeholder="Enter your password" />
            @if($errors->has('password')) <p class="error_mes">{{ $errors->first('password') }}</p> @endif
         </div>
      
      <div class="admin_btn">
         <button type="submit">Login</button>
      </div>
      </form>
      <p class="last">Forgot your password? <a href="{{route('forgetpasswordview')}}"> Reset Password </a></p>
   </div>
  </body>
 <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script type="text/javascript">

       $(function() {
                 setTimeout(function() { $("#hideDiv").fadeOut(3000); }, 5000)

             });
     


  </script>
  <style type="text/css">


     div#hideDiv {

      right: 29px;
      top: 0px;   
      text-align: center;
      position: relative;
      width: 100%;
      border-left: none;
   }
.alert-danger {
     color: red;
     background-color: transparent; 
     border-color: transparent; 
}

.alert {
   
     padding: 0rem 0rem; 
     margin-bottom: 0rem; 
   
    border-radius: 0.25rem;
}
  </style>
</html>