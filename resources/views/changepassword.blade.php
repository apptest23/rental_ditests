@extends('layouts.app')

@section('content')

 <div class="in_manu">
      <div class="container">
         <ul class="breadcumbs1">
            <li><a href="{{url('/')}}">Home</a>  <i class="fal fa-chevron-double-right"></i></li>
            <li>Change Password</li>
         </ul>
      </div>
   </div>

          @if ($message = Session::get('error'))
            <div  id="hideDiv" class="alert alert-success alert-block" >
                <!--     <input type="text" class="close" data-dismiss="alert"></input> -->
                <strong style="padding-top : 5px !important; display: inline-block;">{{ $message }}</strong>
             </div>
           @endif

     <div class="co_edit">
      <!-- <div class="container"> -->
         <ul class="tabs">
           <a href="{{url('User/profile')}}"><li class="tab-link " data-tab="tab">Edit Profile</li></a> 
              <a href="{{url('User/change_password')}}"><li class="tab-link current" data-tab="tab">Change Password</li></a>
         </ul>


             @if ($message = Session::get('success'))
            <div  id="hideDiv1" class="alert alert-error alert-block" >
                <!--     <input type="text" class="close" data-dismiss="alert"></input> -->
                <strong style="padding-top : 5px !important; display: inline-block;">{{ $message }}</strong>
             </div>
           @endif
     

         <div id="tab-2" class="tab-content current">
            <form method="post" action="{{url('User/update_password')}}" enctype="multipart/form-data" >
                @csrf
             <div class="e_main">
                 <div class="edit1 edit3">
                     <div class="col-md-12 label">
                        <label>Old Password</label>
                     </div>
                     <div class="col-md-12 data">
                        <input type="Password"  name="oldpassword" id="oldpassword" value="">
                          @if($errors->has('oldpassword')) <p class="error_mes">{{ $errors->first('oldpassword') }}</p> @endif
                     </div>   
                  </div>
                  <div class="edit1 edit3">
                     <div class="col-md-12 label">
                        <label>New Password</label>
                     </div>
                     <div class="col-md-12 data">
                        <input type="Password"  name="newpassword" id="newpassword" value="">
                          @if($errors->has('newpassword')) <p class="error_mes">{{ $errors->first('newpassword') }}</p> @endif
                     </div>   
                  </div>
             </div>
             <div class="edit_btn" id="change_password">
                <button type="submit">Submit</button>
            </div>
          </form>
         </div>
    <!-- </div> -->
   </div>

        <style type="text/css">
               .error_mes{

                  color: red;
                 }

                div#hideDiv {
                   width: 30%;
                   text-align: center;
                   position: absolute;
                   right: 18px;
          
                 }

                 div#hideDiv1 {
                    position: absolute;
                    right: 40%;
                    color: red;
                }

               @media only screen and (min-width: 1024px) and (max-width: 1260px){

                  div#hideDiv {
                   width: 50%;
                   text-align: center;
                   position: absolute;
                   right: 5px;
                   top: 43%;
                 }

                 div#hideDiv1 {
  
                    right: 33%;
   
                }


               }

               @media only screen and (min-width: 768px) and (max-width: 1023px){

                  div#hideDiv {
                   width: 50%;
                   text-align: center;
                   position: absolute;
                   right: 0px;
                   top: 43%;
               }

               div#hideDiv1 {
                       right: 28%;
  
                  }
                 

               }

               @media only screen and (max-width: 767px){


                   div#hideDiv {
                   width: 100%;
                   text-align: center;
                   position: absolute;
                   right: 0px;
                   top: 22%;
               }

               div#hideDiv1 {

                    right: 12%;
  
                 }

                
                 
               }

                 @media only screen and (max-width: 320px){


                   div#hideDiv {
                   width: 100%;
                   text-align: center;
                   position: absolute;
                   right: 0px;
                   top: 22%;
               }
                 
               }
      </style>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
    <script type="text/javascript" src="https://cldup.com/S6Ptkwu_qA.js"></script>

    <script type="text/javascript">
         function openNav() {
            document.getElementById("mySidepanel").style.width = "100%";
        }
        function closeNav() {
            document.getElementById("mySidepanel").style.width = "0";
        }

              function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah')
                        .attr('src', e.target.result)
                        .width(180)
                        .height(180);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

   


      $(document).ready(function(){
            $(".font").click(function(){
                 $(".search-box").slideDown("slow");
             });

            $(".search-close").click(function(){
                $(".search-box").slideUp("slow");
            });
        });

        $(document).ready(function(){
            $(".icon1").click(function(){
                $(".search-box1").slideDown("slow");
            });
            $(".search-box1 a").click(function(){
                $(".search-box1").slideUp("slow");
            });
        });

        $('.search-toggle').addClass('closed');
        $('.search-toggle .search-icon').click(function(e) {
            if ($('.search-toggle').hasClass('closed')) {
                $('.search-toggle').removeClass('closed').addClass('opened');
                $('.search-toggle, .search-container').addClass('opened');
                $('#search-terms').focus();
            } else {
                $('.search-toggle').removeClass('opened').addClass('closed');
                $('.search-toggle, .search-container').removeClass('opened');
            }
        });
      
      $('.sub-menu ul').hide();
      $(".sub-menu .fa.fa-caret-down").click(function () {
         $(this).parent(".sub-menu").children("ul").slideToggle("100");
         $(this).find(".right").toggleClass("fa-caret-up fa-caret-down");
      });
      
       $(document).ready(function(){
   
         $('ul.tabs li').click(function(){
            var tab_id = $(this).attr('data-tab');

            $('ul.tabs li').removeClass('current');
            $('.tab-content').removeClass('current');

            $(this).addClass('current');
            $("#"+tab_id).addClass('current');
         })

      });

         $(function() {
                 setTimeout(function() { $("#hideDiv").fadeOut(1500); }, 3000)

             });

           $(function() {
                 setTimeout(function() { $("#hideDiv1").fadeOut(1500); }, 3000)

             });

      
    </script>





@endsection