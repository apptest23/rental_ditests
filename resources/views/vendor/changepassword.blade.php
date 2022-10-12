@extends('vendor.layouts.app')

@section('content')


<div class="head-banner">
         <ul class="breadcrumb">
            <li>
               <a href="{{url('Partner/vendor_home')}}">Home</a>
            </li>
            <li>
               <a href=""><span>Change Password</span></a>
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
           <a href="{{url('Partner/profile')}}"><li class="tab-link " data-tab="tab">Edit Profile</li></a> 
              <a href=""><li class="tab-link current" data-tab="tab">Change Password</li></a>
         </ul>


             @if ($message = Session::get('success'))
            <div  id="hideDiv1" class="alert alert-error alert-block" >
                <!--     <input type="text" class="close" data-dismiss="alert"></input> -->
                <strong style="padding-top : 5px !important; display: inline-block;">{{ $message }}</strong>
             </div>
           @endif
     

         <div id="tab-2" class="tab-content current">
            <form method="post" action="{{url('Partner/updatepassword')}}" enctype="multipart/form-data" >
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