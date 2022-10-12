
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
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.2.3/animate.min.css">
  <link rel="icon" href="image/logo.png">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}" />
</head>
<body class="body">

  <div id="pageMessages"></div>

  <div class="co_login">
    <div class="row">
      <div class="col-lg-12">
        <div class="cont">

              @if($message = Session::get('success'))
                 <div  id="hideDiv1" class="alert alert-success alert-block suceess_mes" >
                <!--     <input type="text" class="close" data-dismiss="alert"></input> -->
                 <strong style="padding-top : 5px !important; display: inline-block;">{{ $message }}</strong>
                 </div>
               @endif
          <div class="count-head">


                 <div  id="hideDiv" class="alert alert-danger alert-block error_mes" style="display: none">
              
                 </div>




            <h2>Sign In</h2>

            
          </div>
          <div class="login_1">
            <ul class="tabs">
              <li class="tab-link current" data-tab="tab-1">USER</li>
              <li class="tab-link" data-tab="tab-2">PARTNER</li>
            </ul>

            <div id="tab-1" class="tab-content current">
              <div class="form sign-in">

              <!--   <div  id="hideDiv" class="alert alert-danger alert-block error_mes" style="display: none">
              
                 </div> -->


                <form method="post" class="sign_In" id="sign_In">
   
                    @csrf

                      <label>
                  <span>Phone</span>
                  <div class="show_code">
                      
                        <div class="di_felx">
                        <p class="c_code">+91</p>
                        <input type="number" name="phone_no" id="sign_phone_no">
                         <span class="underline"></span>
                        </div>
                       
                        <span class="text-danger error-text phone_no_err"></span> 
                    </div>
                                </label>
                  <p class="or">OR</p>
                   <label>
                      <span>Email</span>
                        <input type="text" name="email" id="sign_email">
                        <span class="underline"></span>
                        <span class="text-danger error-text email_err"></span> 
                  </label>
                  <label>
                      <span>Password</span>
                       <input type="password" name="password" id="sign_password">     
                       <span class="underline"></span>
                       <span class="text-danger error-text password_err"></span>
                  </label>
                    <button class="submit user_sign_in" type="submit">Sign In</button>

                  </form>
                    <p class="forgot-pass"><a href="{{url('User/forget_password')}}">Forgot Password ?</a></p>

                    <div class="extra-login clearfix">
                                <span>Or Login With</span>
                            </div>
                            <div class="social-list">
                                <a href="#" class="facebook-bg"><i class="fab fa-facebook-f"></i></a>
                                <a href="#" class="twitter-bg"><i class="fab fa-twitter"></i></a>
                                <a href="{{url('auth/google')}}" class="google-bg"><i class="fab fa-google"></i></a>
                                <a href="#" class="linkedin-bg"><i class="fab fa-linkedin-in"></i></a>
                            </div>
                            <p class="forgot">Buying for work? <span>Create a free business account</span></p>
                </div>
            </div>
             <div id="tab-2" class="tab-content">
              <div class="form sign-in">
           
               <form method="post" class="sign_In" id="vendor_sign_In">
   
                    @csrf

               <label>
                  <span>Phone</span>
                  <div class="show_code">
                      
                        <div class="di_felx">
                        <p class="c_code">+91</p>
                        <input type="number" name="phone_no" id="vendor_phone_no">
                           <span class="underline"></span>
                        </div>
                     
                        <span class="text-danger error-text phone_no_err1"></span> 
                    </div>
               
              </label>
                  <p class="or">OR</p>
                  <label>
                      <span>Email Address</span>
                      <input type="email" name="email" id="vendor_email">
                      <span class="underline"></span>
                        <span class="text-danger error-text email_err1"></span>
                  </label>
                  <label>
                      <span>Password</span>
                      <input type="password" name="password" id=vendor_password>
                      <span class="underline"></span>
                     <span class="text-danger error-text password_err1"></span>
                  </label>
                    <button class="submit vendor_sign_in" type="submit">Sign In</button>
                    <p class="forgot-pass"><a href="{{url('Partner/Vendor_forgetpassword')}}">Forgot Password ?</a></p>

                  <!--   <div class="extra-login clearfix">
                                <span>Or Login With</span>
                            </div> -->
                           <!--  <div class="social-list">
                                <a href="#" class="facebook-bg"><i class="fab fa-facebook-f"></i></a>
                                <a href="#" class="twitter-bg"><i class="fab fa-twitter"></i></a>
                                <a href="#" class="google-bg"><i class="fab fa-google"></i></a>
                                <a href="#" class="linkedin-bg"><i class="fab fa-linkedin-in"></i></a>
                            </div> -->
                            <p class="forgot">Buying for work? <span>Create a free business account</span></p>
                </div>
            </div>
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
                  <div class="img-text m-in">
                      <h2>One of us?</h2>
                      <p>If you already has an account, just sign in. We've missed you!</p>
                  </div>
                  <div class="img-btn">
                      <span class="m-up">Sign Up</span>
                      <span class="m-in">Sign In</span>
                  </div>
              </div>
              <div class="form sign-up">
                  <div class="count-head1">
                <h2>Sign Up</h2>
              </div>

                  <form id="myForm" class="registration" method="post" >
              
                   @csrf
                  <label>
                      <span>Name</span>
                      <input type="text" name="name" id="name">
                      <span class="underline"></span>
                      <span class="text-danger error-text name_error"></span>
                  </label>
                  <label>
                  <span>Phone</span>
                  <div class="show_code">
                      
                                    <div class="di_felx">
                                       <p class="c_code">+91</p>
                                       <input type="number" name="phone_no" id="phone_no">
                                        <span class="underline"></span>
                                    </div>
                                   
                                    <span class="text-danger error-text phone_no_error"></span> 
                    </div>
                  
              </label>
                  <label>
                      <span>Email</span>
                        <input type="text" name="email" id="email">
                        <span class="underline"></span>
                        <span class="text-danger error-text email_error"></span> 
                  </label>
                  <label>
                      <span>Password</span>
                       <input type="password" name="password" id="password">     
                       <span class="underline"></span>
                       <span class="text-danger error-text password_error"></span>
                  </label>
                  <label>
                      <span>Confirm Password</span>
                      <input type="password" name="confirm_password" id="confirm_password">
                      <span class="underline"></span>
                       <span class="text-danger error-text confirm_password_error"></span>
                  </label>
                  <div class="form-check">
                              <label class="form-check-label">
                                 <input type="checkbox" class="form-check-input" name="terms_condition" id="terms_condition" >I agree to the terms of service<br>
                                    <span class="text-danger error-text terms_condition_error"></span>
                              </label>
                        </div>
                        <div id="loading-bar-spinner" class="spinner"><div class="spinner-icon"></div></div>
                  <button type="submit" class="submit sign_up">Sign Up Now</button>

                  <p class="forgot">Buying for work? <span><a href="{{url('Partner/registration')}}">Create a free business account</a></span></p>
                </form>
              </div>
            </div>
          </div>
      </div>
    </div>      
    </div>
  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script type="text/javascript">


      $(".show_code").click(function(){
        $(".c_code").show();
      });
       $(document).ready(function(){
  
      $('ul.tabs li').click(function(){
        var tab_id = $(this).attr('data-tab');

        $('ul.tabs li').removeClass('current');
        $('.tab-content').removeClass('current');

        $(this).addClass('current');
        $("#"+tab_id).addClass('current');
      })

    })

       document.querySelector('.img-btn').addEventListener('click', function()
    {
      document.querySelector('.cont').classList.toggle('s-signup')
    }
  );


       /*
       *
       *
       */

       function createAlert(title, summary, details, severity, dismissible, autoDismiss, appendToId) {
                  var iconMap = {
                    info: "fa fa-info-circle",
                    success: "fa fa-thumbs-up",
                    warning: "fa fa-exclamation-triangle",
                    danger: "fa ffa fa-exclamation-circle"
                  };
                
                        var iconAdded = false;
             
                         var alertClasses = ["alert", "animated", "flipInX"];
                         alertClasses.push("alert-" + severity.toLowerCase());
             
                          if (dismissible) {
                              alertClasses.push("alert-dismissible");
                              }

                            var msgIcon = $("<i />", {
                              "class": iconMap[severity] // you need to quote "class" since it's a reserved keyword
                            });

                            var msg = $("<div />", {
                              "class": alertClasses.join(" ") // you need to quote "class" since it's a reserved keyword
                            });

                           if (title) {
                             var msgTitle = $("<h4 />", {
                               html: title
                             }).appendTo(msg);
                             
                             if(!iconAdded){
                               msgTitle.prepend(msgIcon);
                               iconAdded = true;
                             }
                           }

                          if (summary) {
                            var msgSummary = $("<strong />", {
                              html: summary
                            }).appendTo(msg);
                            
                            if(!iconAdded){
                              msgSummary.prepend(msgIcon);
                              iconAdded = true;
                                  }
                            }
            
                   if (details) {
                     var msgDetails = $("<p />", {
                       html: details
                     }).appendTo(msg);
                     
                     if(!iconAdded){
                       msgDetails.prepend(msgIcon);
                       iconAdded = true;
                     }
                   }
  

                      /*  if (dismissible) {
                          var msgClose = $("<span />", {
                            "class": "close", // you need to quote "class" since it's a reserved keyword
                            "data-dismiss": "alert",
                            html: "<i class='fa fa-times-circle'></i>"
                          }).appendTo(msg);
                        }
                        */
                    $('#' + appendToId).prepend(msg);
                    
                    if(autoDismiss){
                      setTimeout(function(){
                        msg.addClass("flipOutX");
                        setTimeout(function(){
                          msg.remove();
                        },1000);
                      }, 5000);
                    }
             }

  
     $(function() {
         setTimeout(function() { $("#hideDiv").fadeOut(1500); }, 5000)

        });


     $(function() {
         setTimeout(function() { $("#hideDiv1").fadeOut(1500); }, 5000)

        });



  /*
       *
       *
       *   user registarion
       *
       *
       */


    $(document).ready(function() {
        $(".sign_up").click(function(e){
            e.preventDefault();

             var BASE_URL = "{{ url('/') }}";

            var _token = $("input[name='_token']").val();
            var email = $('#email').val();
            var name = $('#name').val();
            var password = $('#password').val();
            var confirm_password = $('#confirm_password').val();
            var phone_no =$('#phone_no').val();

           if(document.getElementById('terms_condition').checked) { 

              var terms_condition=1;
  
            }else{

                var terms_condition='';
            }

            $.ajax({
                url: BASE_URL+'/User/storeuser',
                type:'POST',
                data: {_token:_token,email:email,name:name,password:password,confirm_password:confirm_password,terms_condition:terms_condition,phone_no:phone_no},
                  success: function(data) {
    
                    if($.isEmptyObject(data.error)){

                        $( '.registration' ).each(function(){

                             this.reset();
                        
                        });  
                                  

                         $('.error-text').text('');

                             document.querySelector('.cont').classList.toggle('s-signup');
                        
                      
                     createAlert('','Success!','Registration completed successfully!!.','success',true,true,'pageMessages');

                    }else{
                        printErrorMsg(data.error);
                    }
                }
            });
        }); 

        function printErrorMsg (msg) {

        $('.co_login label').css("margin", "10px auto 0");

            $.each( msg, function( key, value ) {
            console.log(key);
              $('.'+key+'_error').text(value);
            });
        }
    });

     /*
  *
  *  user login
  *
  *
  *
  */


   $(document).ready(function() {
        $(".user_sign_in").click(function(e){
            e.preventDefault();

            var BASE_URL = "{{ url('/') }}";

            var _token = $("input[name='_token']").val();
            var email = $('#sign_email').val();
            var phone_no = $('#sign_phone_no').val();
            var password = $('#sign_password').val();

            $.ajax({
                url:BASE_URL+'/User/authenticate',
                type:'POST',

                data: {_token:_token,email:email,password:password,phone_no:phone_no},
                success: function(data) {
                  console.log(data.error)
                    if($.isEmptyObject(data.error)){


                       if(data.status==1){

                          $( '.registration' ).each(function(){

                             this.reset();

                             $('.error-text').text('');

                         
                          }); 

                         document.getElementById("sign_In").reset();

                          window.location.href = "<?php echo URL::to('/'); ?>";

                        }else{

                               $('#hideDiv').show();

                             if(data.status==0){ 

                                    $('#hideDiv').text('You have entered invalid credentials');

                                    $('#hideDiv').delay(4000).fadeOut(3000);                                 

                                 }else{

                                      $('#hideDiv').text('Please Enter Correct Password');

                                      $('#hideDiv').delay(4000).fadeOut(3000); 
                                    
                                }                             

                           } 
                   

                      }else{

                          printErrorMsg(data.error);
                      }

                  }     
  
             });

          }); 

          function printErrorMsg(msg){

            $('.co_login label').css("margin", "10px auto 0");

             $.each( msg, function( key, value ) {
            // alert(value);
             $('.'+key+'_err').text(value);

          
            });
          }
      });


   /*
  *
  *  vendor login
  *
  *
  *
  */





   $(document).ready(function() {


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


        $(".vendor_sign_in").click(function(e){
            e.preventDefault();

            var BASE_URL = "{{ url('/') }}";
            var _token = $("input[name='_token']").val();
            var email = $('#vendor_email').val();
            var phone_no = $('#vendor_phone_no').val();
            var password = $('#vendor_password').val();

            $.ajax({
                url:BASE_URL+'/Partner/Partner_authenticate',
                type:'POST',
                
                data: {_token:_token,email:email,password:password,phone_no:phone_no},
                success: function(data) {
                  console.log(data.error)
                    if($.isEmptyObject(data.error)){

                     if(data.status==1){

                       $( '.registration' ).each(function(){

                             this.reset();

                             $('.error-text').text('');

                         
                           }); 

                       document.getElementById("sign_In").reset();

                        window.location.href = "<?php echo URL::to( '/Partner/vendor_home'); ?>";


                         }else{


                             $('#hideDiv').show();

                             if(data.status==0){ 

                                $('#hideDiv').text('');

                                $('#hideDiv').text('You have entered invalid credentials');

                                $('#hideDiv').delay(4000).fadeOut(1500); 

                              }else if(data.status==3){

                                   $('#hideDiv').text('');

                                   $('#hideDiv').text('your account is not verified, please wait for some time !');

                                   $('#hideDiv').delay(5000).fadeOut(1500); 

        

                                }else{

                                      $('#hideDiv').text('');
                                   
                                     $('#hideDiv').text('Please Enter Correct Password');

                                     $('#hideDiv').delay(4000).fadeOut(1500); 


                                }                             

                           } 
                   

                        }else{

                          printErrorMsg(data.error);
                      }


                  }     

             });

        }); 

        function printErrorMsg(msg){

          $('.co_login label').css("margin", "10px auto 0");

            $.each( msg, function( key, value ) {
            // alert(value);
            $('.'+key+'_err1').text(value);

          
            });
         }
     });




  </script>


   <style type="text/css">

    p.c_code {
    margin: 0;
    border-bottom: 1px solid #c5bebe;
    padding-bottom: 6px;
    display: none;
}

    .error-text{
      font-size: 12.5px!important;
    text-transform: capitalize !important;
}

#pageMessages {
   display: inline-block;
    position: absolute;
    top: 25px;
    right: 25px;
    width: 23%;
   

}

.alert-dismissible{

border-left: 10px solid green;

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

.error_mes {
    color: #dc3545;
    font-weight: 600;
    font-size: 18px;
    background: none;
    border: none;
    top: 45px;
    margin-left:190px;
  
}

@media only screen and (min-width: 1024) and (max-width: 1260)  { 
#pageMessages {


      top: 45px;
      right: 21px;
      width: 41%;

  }
}

@media only screen and (min-width: 768px) and (max-width: 1023px){

#pageMessages {
    top: 20px;
    right: 16px;
    width: 50%;
   }

}

@media only screen and (max-width: 767px){

#pageMessages {

    top: 23px;
    right: 3px;
    width: 100%
  }
}


@media only screen and (max-width: 320px){

#pageMessages {
    top: 23px;
    right: -55px;
    width: 112%;
 }
}




/*
#pageMessages {
  position: fixed;
  bottom: 15px;
  right: 15px;
  width: 30%;
}

.alert {
  position: relative;
}

.alert .close {
  position: absolute;
  top: 5px;
  right: 5px;
  font-size: 1em;
}

.alert .fa {
  margin-right:.3em;
}
    */


  </style>
</body> 
</html>

