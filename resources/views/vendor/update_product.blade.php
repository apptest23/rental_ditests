@extends('vendor.layouts.app')

@section('content')

  <div class="head-banner">
         <ul class="breadcrumb">
            <li>
               <a href="{{url('Partner/vendor_home')}}">Home</a>
            </li>
            <li>
               <a href=""><span>Update Product </span></a>
            </li>
         </ul>
      </div>
      <div class="sales">
         <div class="box-header padding">
            <h4><i class="fas fa-list"></i>Update Product</h4>
         </div>

           <form  action="{{url('Partner/store_update_vendor_product')}}/{{$id}}" enctype="multipart/form-data" method="POST" >    


           @csrf 

             <div class="col-lg-2 label gallery1" >
               <label>Already Inserted Image</label>
             </div> 


            <div class="d-flex">            

            @foreach($product_image as $pi)

             <div class="gallery_{{$pi->id}} gallery">                       
                 <img src="/uploads/{{$pi->file}}" alt="Cinque Terre" width="250" height="200"> 
                 <p class="error_mes"></p>

                 <div class="d-flex Image_btn">                    
                 <div class=""><a class="btn1 delete-btn1" href="{{url('Partner/update_vendor_product_image')}}/{{$pi->id}}">Update</a></div>
                 <div class="desc" onclick="delete_vendor_product_image({{$pi->id}})"><a class="btn1" >delete</a></div>

               </div>                       
            </div>  
             @endforeach

             </div>

            <div class="details_main">
            <div class="details_inner">
               <div class="part-1">

                 <!--  <div class="details_image">
                     <img src="image/images.png">
                  </div> -->
                  <div class="details_sub">
                  
                     <input type="file" name="image[]" onchange="readURL(this);" multiple>

                      @if($errors->has('image')) <p class="error_mes">{{ $errors->first('image') }}</p> @endif
                     <img id="blah" src="#" alt=""> 
                  </div>  
               </div>            
            </div>

             <div class="details_inner">
               <div class="part">
                  <div class="row">
                     <div class="col-lg-2 label">
                        <label>Category</label>
                     </div>
                     <div class="col-lg-10 data">
                        <select name="category" id="category" >
                           <option value="">Select Category</option>

                             @foreach($category as $c)

                              
                              <option value="{{ $c->id }}"{{$c->id== $category1 ? 'selected' : ''}}>{{ $c->name}}</option>
                         

                             @endforeach
                                       
                        </select>
                         @if($errors->has('category')) <p class="error_mes">{{ $errors->first('category') }}</p> @endif

                     </div>
                  </div>
                                     
               </div>
               <div class="part">
                  <div class="row">
                     <div class="col-lg-2 label">
                        <label>Sub Category</label>
                     </div>
                     
                     <div class="col-lg-10 data">
                         <select name="subcategory" id="subcategory" >
                           <option value="">Select Category</option>

                              @foreach($subcategory as $sc)

                              <option value="{{ $sc->id }}"{{$sc->id== $subcategory1 ? 'selected' : ''}}>{{ $sc->name}}</option>

                              @endforeach
                                  
                        </select>

                          @if($errors->has('subcategory')) <p class="error_mes">{{ $errors->first('subcategory') }}</p> @endif
                     </div>
                  </div>            
               </div>
              
            </div>




            <div class="details_inner">
               <div class="part">
                  <div class="row">
                     <div class="col-lg-2 label">
                        <label>Name</label>
                     </div>
                     <div class="col-lg-10 data">
                        <input type="text" placeholder="Enter name" name="name" value="{{$name1}}" >
                         @if($errors->has('name')) <p class="error_mes">{{ $errors->first('name') }}</p> @endif
                     </div>
                  </div>   
               </div>

               <div class="part">
                  <div class="row">
                     <div class="col-lg-2 label">
                        <label>Price</label>
                     </div>
                     <div class="col-lg-10 data">
                        <input type="text" placeholder="Enter price" name="price" value="{{$price}}" >
                          @if($errors->has('price')) <p class="error_mes">{{ $errors->first('price') }}</p> @endif
                     </div>
                  </div>   
               </div>
               
            </div>

            @if($category_name==='Cloths')
            <div class="details_inner" id="clothdata" style="display: flex;">
               <div class="part">
                  <div class="row">
                     <div class="col-lg-2 label">
                        <label>Colour</label>
                     </div>
                     <div class="col-lg-10 data">
                        @if($colour !='')
                        <input type="text" placeholder="Enter colour" name="colour" value="{{$colour}}" >
                        @else
                         <input type="text" placeholder="Enter colour" name="colour" value="" >
                         @endif
                     </div>
                  </div>   
               </div>

               <div class="part">
                  <div class="row">
                     <div class="col-lg-2 label">
                        <label>Size</label>
                     </div>
                     
                     <div class="col-lg-10 data">
                        <select name="size" id="size" >
                           <option value="">Select Size</option>

                            @foreach($size1 as $s)

                             <option value="{{ $s->id }}"{{$s->id== $size ? 'selected' : ''}}>{{ $s->size}}</option>

                            @endforeach
                                   
                        </select>
                     </div>
                  </div>            
               </div>


            </div>
            @endif

              <div class="details_inner" id="clothdata">
               <div class="part">
                  <div class="row">
                     <div class="col-lg-2 label">
                        <label>Colour</label>
                     </div>
                     <div class="col-lg-10 data">
                        @if($colour !='')
                        <input type="text" placeholder="Enter colour" name="colour" value="{{$colour}}" >
                        @else
                         <input type="text" placeholder="Enter colour" name="colour" value="" >
                         @endif
                     </div>
                  </div>   
               </div>

               <div class="part">
                  <div class="row">
                     <div class="col-lg-2 label">
                        <label>Size</label>
                     </div>
                     
                     <div class="col-lg-10 data">
                        <select name="size" id="size" >
                           <option value="">Select Size</option>

                            @foreach($size1 as $s)

                             <option value="{{ $s->id }}"{{$s->id== $size ? 'selected' : ''}}>{{ $s->size}}</option>

                            @endforeach
                                   
                        </select>
                     </div>
                  </div>            
               </div>


            </div>
            <div class="details_inner">
              
               <div class="part">
                  <div class="row">
                     <div class="col-lg-2 label">
                        <label>Quantity</label>
                     </div>
                     <div class="col-lg-10 data">
                        <input type="number" placeholder="Enter quantity" name="quantity" value="{{$quantity}}" >
                         @if($errors->has('quantity')) <p class="error_mes">{{ $errors->first('quantity') }}</p> @endif
                     </div>
                  </div>            
               </div>

                 @if($category_name==='Cloths')

                <div class="part" id="item">
                  <div class="row">
                     <div class="col-lg-2 label">
                        <label>Item</label>
                     </div>
                      <div class="col-lg-10 data">
                        <select name="item" id="item" >
                           <option value="">Select Item</option>

                            @foreach($item_list as $il)

                             <option value="{{ $il->id }}"{{$il->id== $item_id ? 'selected' : ''}}>{{ $il->item}}</option>

                            @endforeach
                                   
                        </select>
                     </div>
                  </div>            
               </div>

               @endif


                <div class="part" id="item" style="display:none">
                  <div class="row">
                     <div class="col-lg-2 label">
                        <label>Item</label>
                     </div>
                  
                     <div class="col-lg-10 data">
                        <select name="item" id="item" >
                           <option value="">Select Item</option>

                            @if($item_list !='')

                             @foreach($item_list as $il)

                                <option value="{{ $il->id }}"{{$il->id== $item_id ? 'selected' : ''}}>{{ $il->item}}</option>

                            @endforeach

                            @endif
                                   
                        </select>
                     </div>
                  </div>            
               </div>
              
            </div>
            <div class="details_inner">
               <div class="part part1">
                  <div class="row">
                     <div class="col-lg-12 label">
                        <label>Description</label>
                     </div>
                     <div class="col-lg-12 data">
                          <textarea placeholder="Enter text.."  name="description" value="{{$description}}" id="summernote">{!! $description !!}</textarea><br>
                          @if($errors->has('description')) <p class="error_mes">{{ $errors->first('description') }}</p> @endif
                     </div> 
                  </div>  
               </div>
            </div>
            <div class="uplode-btn">
               <button type="submit" value="submit">Update</button>
               <a href="{{url('Partner/vendor_home')}}">Back to Home?</a>
            </div>
         </div>

     </form>
      </div>

      <div id="summernote"></div>






  
   <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
   <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-lite.js"></script>
   <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

     <script type="text/javascript">
       
    $('textarea#summernote').summernote({

        placeholder: 'Hello bootstrap 4',
        tabsize: 2,
        height: 100,
        toolbar: [
        ['style', ['style']],
        ['font', ['bold', 'italic', 'underline', 'clear']],
         // ['font', ['bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear']],
        //['fontname', ['fontname']],
        // ['fontsize', ['fontsize']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['height', ['height']],
        ['table', ['table']],
        ['insert', ['link', 'picture', 'hr']],
        //['view', ['fullscreen', 'codeview']],
        ['help', ['help']]
       ],

      });
   </script>
  
      
  
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


           $(document).ready(function(){

            $('select[name="category"]').on('change',function(){
                var id=$(this).val();

               if(id==13){

                     $("#clothdata").css({ display: "flex" });
                     $("#item").css({ display: "block" });

                 }else{

                     $("#clothdata").css({ display: "none" });
                     $("#item").css({ display: "none" });


                }
              
          if(id){

              var BASE_URL = "{{ url('/') }}";

                $.ajax({

                     url:'/Partner/get_product_subcategory/'+id,
                     type:'GET',
                     dataType:'json',
              success:function(data){

                    console.log(data);

                  /*  var json = JSON.stringify(data);
                      console.log(json);
                    */

                       $('select[name="subcategory"]').empty(); 

                       $('select[name="subcategory"]').append('<option value="">Select Subcategory</option>');


                       $.each(data,function(key,value){

                       $('select[name="subcategory"]')
                    
                        .append('<option value="'+value.id+'">'+value.name+'</option>');

                     });

                   }

                }); 
              }else{

                   $('select[name="subcategory"]').empty();
              }
               
            });
       
           }); 



         function delete_vendor_product_image($id){

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

                               url:BASE_URL+'/Partner/delete_vendor_product_image/'+id,
                               type:'GET',
                               dataType: "json",

                               success: function(response){

                               if(response.status==0){

                                  $('.error_mes').text('Minimum 1 image is required ');                 

                                   }else{

                                     $('.gallery_'+id).hide();

                                        }
   
                                     },
 
                            error: function(response) {

                                     alert('error');
          
                                },        
          
                           });
                    
                        } else {
                    }
                });      
             }


              $(document).ready(function(){

            $('select[name="subcategory"]').on('change',function(){
                var id=$(this).val();

                   var BASE_URL = "{{ url('/') }}";

             
              
             if(id){

                $.ajax({

                     url: BASE_URL+'/Partner/get_cloth_item/'+id,
                     type:'GET',
                     dataType:'json',
                 success:function(data){

                       console.log(data);

                  /*  var json = JSON.stringify(data);
                      console.log(json);
                    */

                       $('select[name="item"]').empty(); 

                       $('select[name="item"]').append('<option>Select Item</option>');

                       $.each(data,function(key,value){

                       $('select[name="item"]').append('<option value="'+value.id+'">'+value.item+'</option>');

                     });

                   }

                }); 
              }else{

                   $('select[name=""]').empty();
              }
               
            });
       
        });     

   

   
    </script>

    <style type="text/css">
       #clothdata{


        display: none;
       } 

       .gallery{

          margin-bottom: 15px;
          margin-right: 15px;
          margin-top:10px;
          margin-left:15px;

    }

    .Image_btn{

      margin-top:15px;
    }
    .gallery1{

      margin-top: 10px;
    }


    </style>
       @endsection