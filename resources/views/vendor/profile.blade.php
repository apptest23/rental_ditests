@extends('vendor.layouts.app')

@section('content')

<div class="head-banner">
         <ul class="breadcrumb">
            <li>
               <a href="{{url('Partner/vendor_home')}}">Home</a>
            </li>
            <li>
               <a href=""><span>Edit Profile </span></a>
            </li>
         </ul>
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
           <a href=""><li class="tab-link current" data-tab="tab">Edit Profile</li></a> 
              <a href="{{url('Partner/changepassword')}}"><li class="tab-link" data-tab="tab">Change Password</li></a>
         </ul>
         <form  action="{{url('/Partner/edit_profile')}}" enctype="multipart/form-data" method="POST">
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
            
      </style>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
 
  

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

   

    
         $(function() {
                 setTimeout(function() { $("#hideDiv").fadeOut(1500); }, 3000)

             });

           $(function() {
                 setTimeout(function() { $("#hideDiv1").fadeOut(1500); }, 3000)

             });



      
    </script>



















@endsection