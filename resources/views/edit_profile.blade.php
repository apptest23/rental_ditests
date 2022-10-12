@extends('layouts.app')

@section('content')

  <div class="in_manu">
      <div class="container">
         <ul class="breadcumbs1">
            <li><a href="{{url('/')}}">Home</a>  <i class="fal fa-chevron-double-right"></i></li>
            <li>Edit Profile</li>
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
           <a href="{{url('User/profile')}}"><li class="tab-link current" data-tab="tab">Edit Profile</li></a> 
              <a href="{{url('User/change_password')}}"><li class="tab-link" data-tab="tab">Change Password</li></a>
         </ul>
         <form  action="{{url('/User/update_profile')}}" enctype="multipart/form-data" method="POST">
            @csrf
         <div id="tab-1" class="tab-content current">
            <div class="edit_main">
               <div class="edit_inner">
                  <div class="edit_image">
                     @if($image !='')

                     <img  id="blah" src="/uploads/{{$image}}">

                     @else

                     <img  id="blah" src="/image/dummy_user.jpg">

                     @endif
                  </div>
                  <div class="edit_sub">
                     <input type="file" name="image" onchange="readURL(this);">
                     <input type="hidden" name="oldimage" value="{{$image}}">
                   
                  </div>  
               </div>
               <div class="edit_d-flex">
                  <div class="edit1">
                     <div class="col-md-12 label">
                        <label>Name</label>
                     </div>
                     <div class="col-md-12 data">
                       <input type="text"  name="name" value="{{$name}}">
                      @if($errors->has('name')) <p class="error_mes">{{ $errors->first('name') }}</p> @endif
                     </div>    
                  </div>
                  <div class="edit1">
                     <div class="col-md-12 label">
                        <label>Phone Number</label>
                     </div>
                     <div class="col-md-12 data">
                        <input type="number" name="phone_no"  value="{{$phone_no}}">
                            @if($errors->has('phone_no')) <p class="error_mes">{{ $errors->first('phone_no') }}</p> @endif
                     </div>   
                  </div>
               </div>
               <div class="edit_d-flex">
                  <div class="edit1 edit2">
                     <div class="col-md-12 label">
                        <label>Email</label>
                     </div>
                     <div class="col-md-12 data">
                        <input type="email"  name="email" value="{{$email}}">
                         @if($errors->has('email')) <p class="error_mes">{{ $errors->first('email') }}</p> @endif
                     </div>   
                  </div>
               </div>
               <div class="edit_d-flex">
                  <div class="edit1 edit2">
                     <div class="col-md-12 label">
                        <label>Address</label>
                     </div>
                     <div class="col-md-12 data">
                        <textarea name="address" autocomplete="off" value="{{$address}}">{{$address}}</textarea>
                     </div>   
                  </div>
               </div>
               <div class="edit_btn">
                  <button>Submit</button>
               </div>
            </div>
         </div>
     </form>


       
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

               @media only screen and (min-width: 1024px) and (max-width: 1260px){

                  div#hideDiv {
                   width: 50%;
                   text-align: center;
                   position: absolute;
                   right: 5px;
                   top: 43%;
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
                 

               }

               @media only screen and (max-width: 767px){


                   div#hideDiv {
                   width: 100%;
                   text-align: center;
                   position: absolute;
                   right: 0px;
                   top: 22%;
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