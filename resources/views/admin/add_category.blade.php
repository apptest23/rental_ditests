@extends('admin.layouts.header')

@section('content')

 <div class="head-banner">
          <ul class="breadcrumb">
              <li>
                  <a href="{{url('admin/home')}}">Home</a>
              </li>
              <li>
                  <a href="{{url('admin/category')}}"><span>Add Category</span></a>
              </li>
          </ul>
      </div>
      <div class="page mt-4 hosting-page title1 page-with" style="display: block;">
         <div class="list1">
            <h4 class="mb-4">ADD NEW CATEGORY</h4>
         </div>
         <div class="detail table-responsive">

          <form  action="{{url('admin/store_category')}}" enctype="multipart/form-data" method="POST" >
                @csrf
            <div class="details_main">
               <div class="details_inner">
                  <div class="part2">
                      <div class="col-md-12 label">
                     <label> Image</label>
                  </div>


                     <div class="details_image">
                           <img id="blah" src="/image/category.png" alt="" />
                     </div>

                        <input type="file" name="image" onchange="readURL(this);" require="">
                         @if($errors->has('image')) <p class="error_mes">{{ $errors->first('image') }}</p> @endif
                        
                  </div>            
               </div>

                <div class="details_inner">
                  <div class="part2">
                     <div class="col-md-12 label">
                     <label>Icon Image</label>
                  </div>

                     <div class="details_image">
                           <img id="blah1" src="/image/category.png" alt="" />
                     </div>

                        <input type="file" name="icon_image" onchange="readURL1(this);" require="">
                         @if($errors->has('icon_image')) <p class="error_mes">{{ $errors->first('icon_image') }}</p> @endif
                        
                  </div>            
               </div>
               <div class="part">
                  <div class="col-md-12 label">
                     <label>Name</label>
                  </div>
                  <div class="col-md-12 data">
                     <input type="text" placeholder="Enter Name" name="name" value="">
                       @if($errors->has('name')) <p class="error_mes">{{ $errors->first('name') }}</p> @endif
                  </div>   
               </div>

                 <div class="part">
                  <div class="col-md-12 label">
                     <label>Description</label>
                  </div>
                  <div class="col-md-12 data ">
                    
                        <textarea name="description" placeholder="please enter full description" autocomplete="off" ></textarea>
                         @if($errors->has('description')) <p class="error_mes">{{ $errors->first('description') }}</p> @endif
                    
               </div>
             
               <div class="uplode-btn">
                  <button>Add</button>
                  <a href="{{url('admin/home')}}">Back to Home?</a>
               </div>
            </div>
          </form>
         </div>
      </div>


        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.min.js"></script>


    <script type="text/javascript">


  
         function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah')
                        .attr('src', e.target.result)
                        .width(130)
                        .height(130);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }


          function readURL1(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah1')
                        .attr('src', e.target.result)
                        .width(130)
                        .height(130);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }



       

         
</script>





@endsection