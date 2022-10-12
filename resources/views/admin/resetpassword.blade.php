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
      <h3 class="top_head">RESET YOUR PASSWORD</h3>

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
      <form class="user-form" method="POST" action="{{url('admin/resetpassword')}}/{{$id}}">
         @csrf
         <div class="user">
            <i class="fas fa-lock-alt"></i>
               <input type="password" name="password" class="form-control" placeholder="Enter your new password" />
            @if($errors->has('password')) <p class="error_mes">{{ $errors->first('password') }}</p> @endif
         </div>
         <div class="user">
            <i class="fas fa-lock-alt"></i>
              <input type="password" name="confirm_password" class="form-control" placeholder="Enter your confirm password" />
            @if($errors->has('confirm_password')) <p class="error_mes">{{ $errors->first('confirm_password') }}</p> @endif
         </div>
   
      <div class="admin_btn">
         <button>Submit</button>
      </div>
    </form>
      <p class="last">Go Back To<a href="{{url('admin/login')}}"> login Here</a></p>
   </div>
  </body>
</html>