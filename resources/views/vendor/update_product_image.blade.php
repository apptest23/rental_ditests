@extends('vendor.layouts.app')

@section('content')

 <div class="head-banner">
          <ul class="breadcrumb">
              <li>
                  <a href="{{url('Partner/vendor_home')}}">Home</a>
              </li>

                <li>
                  <a href="{{url('Partner/update_vendor_product')}}/{{$product_id}}"><span>Update Product </span></a>
              </li>
              <li>
                  <a href=""><span>Update Product Image</span></a>
              </li>
          </ul>
      </div>
      <div class="page mt-4 hosting-page title1 page-with" style="display: block;">
         <div class="list1">
            <h4 class="mb-4">UPDATE Product Image</h4>
         </div>
         <div class="detail table-responsive">

          <form  action="{{url('Partner/store_update_vendor_product_image')}}/{{$id}}" enctype="multipart/form-data" method="POST" >
                @csrf
            <div class="details_main">

                 <div class="details_inner">
                  <div class="part2">
                      <div class="col-md-12 label">
                     <label> Image</label>
                    </div>
                         <div class="details_image">
                          <img id="blah" src="/uploads/{{$image}}" alt="" />
                        </div>

                         <input type="file" name="image" onchange="readURL(this);" require="">
                         <input type="hidden" name="oldimage" value="{{$image}}" require="">
                         @if($errors->has('image')) <p class="error_mes">{{ $errors->first('image') }}</p> @endif
                        
                  </div>            
               </div>
      
             
               <div class="uplode-btn">
                  <button>Update</button>
                  <a href="{{url('Partner/vendor_home')}}">Back to Home?</a>
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
         
</script>





@endsection