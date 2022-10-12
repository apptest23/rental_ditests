@extends('admin.layouts.header')

@section('content')

 <div class="head-banner">
          <ul class="breadcrumb">
              <li>
                  <a href="{{url('admin/home')}}">Home</a>
              </li>
              <li>
                  <a href="#"><span>Update Admin Detail</span></a>
              </li>
          </ul>
      </div>
      <div class="page mt-4 hosting-page title1 page-with" style="display: block;">
         <div class="list1">
            <h4 class="mb-4">UPDATE ADMIN DETAIL </h4>
         </div>
         <div class="detail table-responsive">

           <form  action="{{url('admin/store_update_adminprofile')}}/{{$id}}" enctype="multipart/form-data" method="post" >
                @csrf

            <div class="details_main">
               
               <div class="part">
                   <div class="col-md-12 label">
                     <label>Name</label>
                   </div>
                  <div class="col-md-12 data">
                     <input type="text" placeholder="Enter Name" name="name" value="{{$name}}">
                       @if($errors->has('name')) <p class="error_mes">{{ $errors->first('name') }}</p> @endif
                 </div>   
               </div>

                <div class="part">
                   <div class="col-md-12 label">
                     <label>Email</label>
                   </div>
                  <div class="col-md-12 data">
                     <input type="text" placeholder="Enter Email" name="email" value="{{$email}}">
                       @if($errors->has('email')) <p class="error_mes">{{ $errors->first('email') }}</p> @endif
                 </div>   
               </div>

                  <div class="part part1">
                  <div class="col-md-12 label">
                     <label>Already Add Mobile No</label>
                  </div>

                  <div class="col-md-12 label">

                      @foreach($mobile_no as $m)

                       <label class="badge bg-info  tag_{{$m->id}}">{{ $m->number }}<a> <i class="fa fa-times" aria-hidden="true" onclick="delete_mobile({{$m->id}})"></i></a> </label>
                                    
                      @endforeach

                    </div>
                </div>

                <div class="part part1">
                  <div class="col-md-12 label">
                     <label>Add mobile No</label>
                  </div>
                     
                    <input  placeholder="Add New mobile no" name="tags" value="" type="text" data-role="tagsinput" >          
                
               </div>


                <div class="part">
                   <div class="col-md-12 label">
                     <label>Facebook</label>
                   </div>
                  <div class="col-md-12 data">
                     <input type="text" placeholder="Enter Facebook URL" name="facebook" value="{{$facebook}}">
                    
                 </div>   
               </div>
                <div class="part">
                   <div class="col-md-12 label">
                     <label>Instagram</label>
                   </div>
                  <div class="col-md-12 data">
                     <input type="text" placeholder="Enter Instagram URL" name="instagram" value="{{$instagram}}">
                    
                 </div>   
               </div>
               <div class="part">
                   <div class="col-md-12 label">
                     <label>Youtube</label>
                   </div>
                  <div class="col-md-12 data">
                     <input type="text" placeholder="Enter Youtube URL" name="youtube" value="{{$youtube}}">       
                 </div>   
               </div>
               <div class="part">
                   <div class="col-md-12 label">
                     <label>LinkedIn</label>
                   </div>
                  <div class="col-md-12 data">
                     <input type="text" placeholder="Enter LinkedIn URL" name="linkedin" value="{{$linkedin}}">       
                 </div>   
               </div>

                   <div class="part">
                   <div class="col-md-12 label">
                     <label>Address</label>
                   </div>
                  <div class="col-md-12 data">
                     <textarea name="address" value="{{$address}}">{{$address}}</textarea>       
                 </div>   
               </div>
               <div class="uplode-btn">
                  <button>Update</button>
                  <a href="{{url('admin/update')}}">Back to Home?</a>
               </div>
            </div>
         </div>
       </form>
      </div>

   @endsection

   <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
   <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
   <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" rel="stylesheet" />
   <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.js"></script>

   <script type="text/javascript">

  

        function delete_mobile($id){


               swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this data!",
                 
                    buttons: true,
                    dangerMode: true,
                  })
                  .then((willDelete) => {
                    if (willDelete) {

                    var BASE_URL = "{{ url('/') }}";

                    var id = $id;

                          $.ajax({

                                url:BASE_URL+'/admin/delete_mobileno/'+id,
                                type:'GET',
                                dataType: "json",

                                success: function(response){
        
                                     $('.tag_'+id).hide();
         
   
                                     },
 
                            error: function(response) {

                                     alert('error');
          
                                },        
          
                           });


                    
                    } else {
                     
                    }
                  });
         





        }


    
    </script>
    <style type="text/css">
      
      .bootstrap-tagsinput .tag {
    margin-right: 2px;
    color: black !important;
    background: #17a2b8!important;
}

.bootstrap-tagsinput {
   width: 35%;
    padding: 10px;
    font-size: 16px;
    border: 1px solid #858a8e;
    position: relative;
     margin-left: 16px;

     border-radius: 0px;
}

.bg-info {
    background-color: #17a2b8!important;
    height: 30px !important;
    line-height: 24px!important;
   
}
    </style>
 