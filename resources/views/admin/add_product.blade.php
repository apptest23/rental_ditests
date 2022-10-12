@extends('admin.layouts.header')

@section('content')

  <div class="head-banner">
         <ul class="breadcrumb">
            <li>
               <a href="{{url('admin/home')}}">Home</a>
            </li>
            <li>
               <a href=""><span>Add Product </span></a>
            </li>
         </ul>
      </div>
      <div class="sales">
         <div class="box-header padding">
            <h4><i class="fas fa-list"></i>Add Product</h4>
         </div>

       <form  action="{{url('admin/store_product')}}" enctype="multipart/form-data" method="POST" >    

           @csrf     

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

                              <option value="{{$c->id}}">{{$c->name}}</option>

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
                           <option value="1">cloth</option>
                           <option value="3">Electronics</option>
                           <option value="4">Event</option>
                           <option value="5">Appliances</option>
                           <option value="6">Vehicle</option>                
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
                        <input type="text" placeholder="Enter name" name="name" value="" >
                         @if($errors->has('name')) <p class="error_mes">{{ $errors->first('name') }}</p> @endif
                     </div>
                  </div>   
               </div>

                 <div class="part">
                  <div class="row">
                     <div class="col-lg-2 label">
                        <label>Quantity</label>
                     </div>
                     <div class="col-lg-10 data">
                        <input type="number" placeholder="Enter quantity" name="quantity" value="" >
                         @if($errors->has('quantity')) <p class="error_mes">{{ $errors->first('quantity') }}</p> @endif
                     </div>
                  </div>            
               </div>  
               
            </div>

            <div class="details_inner det_1" id="clothdata" > 

               <div class="part">
                  <div class="row">
                     <div class="col-lg-2 label">
                        <label>Colour</label>
                     </div>
                     <div class="col-lg-10 data">
                        <input type="text" placeholder="Enter colour" name="colour" value="" >
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

                            @foreach($size as $s)

                              <option value="{{$s->id}}">{{$s->size}}</option>

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
                        <label>Price</label>
                     </div>
                     <div class="col-lg-10 data">
                        <input type="text" placeholder="Enter price" name="price" value="" >
                          @if($errors->has('price')) <p class="error_mes">{{ $errors->first('price') }}</p> @endif
                     </div>
                  </div>   
               </div>
              
             
                 <div class="part" id="item">
                  <div class="row">
                     <div class="col-lg-2 label">
                        <label>Item</label>
                     </div>

                      <div class="col-lg-10 data">
                        <select name="item" id="item_class">
                           <option value="">Select Iteam</option>

                             <!--  @foreach($item as $i)

                                  <option value="{{$i->id}}">{{$i->item}}</option>

                              @endforeach -->
                                   
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
                          <textarea placeholder="Enter text.."  name="description" value="" id="summernote"></textarea><br>
                          @if($errors->has('description')) <p class="error_mes">{{ $errors->first('description') }}</p> @endif
                     </div> 
                  </div>  
               </div>
            </div>
            <div class="uplode-btn">
               <button type="submit" value="submit">Add</button>
               <a href="{{url('admin/home')}}">Back to Home?</a>
            </div>
         </div>

     </form>
      </div>





   @endsection

  
   <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-lite.js"></script>


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

                $.ajax({

                     url:'getsubcategory/'+id,
                     type:'GET',
                     dataType:'json',
              success:function(data){

                    console.log(data);

                  /*  var json = JSON.stringify(data);
                      console.log(json);
                    */

                       $('select[name="subcategory"]').empty(); 

                       $('select[name="subcategory"]').append('<option>Select Subcategory</option>');


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

              $(document).ready(function(){

            $('select[name="subcategory"]').on('change',function(){
                var id=$(this).val();

             
              
          if(id){

                $.ajax({

                     url:'get_item/'+id,
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

       #item{

         display: none;
       }


    </style>