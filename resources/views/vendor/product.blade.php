@extends('vendor.layouts.app')

@section('content')

 <div class="head-banner">
         <ul class="breadcrumb">
             <li>
               <a href="{{url('Partner/vendor_home')}}">Home</a>
             </li>
            <li>
               <a href="">Product List</a>
            </li>
         </ul>
      </div>
    <div class="page mt-4 hosting-page title1" style="display: block;">
         <div class="list1">
            <h4 class="mb-0"> Product List</h4>
            <div class="btn1-main">
                <button class="btn1 delete-btn1">all delete</button>
                <button class="btn1"><a href="{{url('Partner/add_vender_product')}}" style="color:white;">ADD</a></button>
            </div>
         </div>
         <div class="sear-list">
            <div class="row">
               <div class="col-lg-12">
                  <div class="sear-main">

                      <form method="get">
                    
                          <input type="text" class="form-control"  placeholder="search here.." name="search" id="txtSearch">
                     </form>
                   
                  </div>
               </div>
            </div>
         </div>
         <div class="pro-table table-responsive">
            <table class="table table-bordered table-striped">
               <thead>
                  <tr>
                     <th><input type="checkbox" name="" id="chkcheckAll"/></th>
                     <th>Image</th>
                     <th>Name</th>
                     <th>Category</th>
                     <th>SubCategory</th>
                     <th>price</th>
                     <th>Total Quantity</th>
                     <th>Available Quantity</th>
                     <th>Status</th>              
                     <th>Action</th>
                  </tr>
               </thead>

                <tbody id="product_list">
             
                 @foreach($product as $p)
      
                    <tr class="product_{{$p->id}}">
                        <th><input type="checkbox" name="ids" class="checkBoxClass" value="{{$p->id}}"/></th>
                        <td>

                         @foreach($product_image as $pi)
                           @if($p->id==$pi->product_id)

                             <img src="/uploads/{{$pi->file}}" width="60" height="60">

                             @break

                             @endif

                          @endforeach
                        </td>
                        <td>{{$p->name}}</td>

                        <td>

                          @foreach($category as $c)

                              @if($p->category==$c->id)

                            
                               {{$c->name}}
                         

                             @endif

                          @endforeach
                        </td>
                        <td>

                          @foreach($subcategory as $sc)

                              @if($p->subcategory==$sc->id)

                            
                               {{$sc->name}}
                         

                             @endif

                           @endforeach


                        </td>
                        <td>{{$p->price}}/Day</td>
                        <td>{{$p->total_qty}}</td>
                        <td>{{$p->quantity}}</td>

                                  @foreach($product_status as $ps)

                                    @if($ps->id== $p->status)

                                     <td class="dot-status status_{{$p->id}}">

                                        <span class="status_btn "style="background-color:{{$ps->colour}}">{{$ps->name}}</span>


                                    <div class="action-dropdown">

                                        <div class="dropdown ">
                                            <div class="btn-link dot_click" id="{{$p->id}}" data-toggle="dropdown">
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <circle cx="12.4999" cy="3.5" r="2.5" fill="#A5A5A5"></circle>
                                                    <circle cx="12.4999" cy="11.5" r="2.5" fill="#A5A5A5"></circle>
                                                    <circle cx="12.4999" cy="19.5" r="2.5" fill="#A5A5A5"></circle>
                                                </svg>
                                             </div>

                                          </div>

                                      </div>

                                      </td>

                                     @endif
                                                        
                                    @endforeach

                                                   
                        <td>
                           <a class="icon__1" href="{{url('Partner/view_product_detail')}}/{{$p->id}}"><i class="fas fa-eye"></i></a>
                           <a class="icon__1" href="{{url('Partner/update_vendor_product')}}/{{$p->id}}"><i class="fas fa-edit"></i></a>
                           <a class="icon__2" onclick="delete_product({{$p->id}})"><i class="fas fa-trash-alt"></i></a>

                        
                        </td>
                       
                        
                    </tr>
                     @endforeach
               </tbody>
              

              
              
            </table>

              {{ $product->links('admin.pagination') }}
          
         </div>
      </div>

     <!-- status1 -->

    <div class="modal" id="myModal">
      <div class="modal-dialog update_status">
        <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Update Status</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
             <div class="">
                 <form>
                    <div class="form-group">
                        <input type="hidden" id="product_id_val" value="">
                    </div>

                    <div class="part col-lg-12">
                       <div class="row">
                         <div class="col-lg-12 label">
                            <label>Total Product:</label><span id="total_product">  </span>
                             <input type="hidden" name="" id="total_product1" value="">
                         </div>
                      </div>   
                    </div>
             
                     <div class="part col-lg-12">
                       <div class="row">
                         <div class="col-lg-12 label">
                            <label>Number of product on Rent</label>
                         </div>
                         <div class="col-lg-12 data">
                            <input type="number" placeholder="" name="rent_product" id="rent_product" value="" class="w-100"  min="1" autocomplete="off"><br>
                            <span class="text-danger error-text rent_product_err"></span>  
                         </div>
                      </div>   
                    </div>
           
                   <div class="form-group">

                     <button type="button" class="btn btn-primary button-new" id="update_status_1">Update</button>
                                         
                   </div>
                </form>
            </div>
       </div>
    </div>
  </div>
  
</div>

 <style type="text/css">
          .status_btn {
             font-size: 0.813rem !important;
             padding: 0.625rem 1rem;
             border-radius: 1.25rem;
             font-weight: 500;
             width: 80%;
             text-align: center;
           }

         .btn-link {
             font-weight: 400;
             color: #007bff;
             position: absolute !important;
             top: -20px !important;
             right: 0 !important;
             text-decoration: none;
         }

         .update_status{

               top: 20%;

         }
         .part label{

            font-weight: 700!important;
         }
         .button-new {
            font-weight: 700;
            padding: 8px;
            border-radius: 12%;
            margin-left: 4%;
            background-color: #df453e!important;
            border: none;
            color: white!important;
        }

        
      </style>


      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    

  
      
       <script type="text/javascript">

 /*$('.update_status1').click(function(){
    alert("test");

      }); */ 

     

        $(document).ready(function(){

         $.ajaxSetup({
           headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
               });


               $('.dot_click').click(function(){

                  var id = $(this).attr('id');
                  var BASE_URL = "{{ url('/') }}";
                  var _token = $("input[name='_token']").val();
                  var product_id = $('#product_id').val();
           
             $.ajax({

                 url:BASE_URL+'/Partner/update_status/'+id,
                 type:'GET',
      
                 success: function(response){

                    if(response.status==1){

                         $('#total_product').text(response.product_qty);

                         $('#total_product1').val(response.product_qty);

                         $('#product_id_val').val(response.product_id);
                         

                          $('#myModal').modal("show");

                       }                    
                         
                     }
  
                 });

               });
           
           });

         /*update status 1*/             


            $(document).ready(function() {

                     $.ajaxSetup({
           headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
               });



               $("#update_status_1").click(function(e){
                  
    
                    var BASE_URL = "{{ url('/') }}";
                    var product_id = $('#product_id_val').val();
                    var total_product = $('#total_product1').val();
                    var rent_product = $('#rent_product').val();


                   if(parseInt(rent_product)>parseInt(total_product)){    

                       $('.rent_product_err').text('select product is not greater than total product');

                      }

                else{


                $.ajax({
                      url: BASE_URL+'/Partner/update_status_1/'+product_id,
                      type:'POST',
                       data: {product_id:product_id,total_product:total_product,rent_product:rent_product},
                    success: function(data) {
    
                         if($.isEmptyObject(data.error)){
                                  
                         $('.error-text').text('');


                         $('.status_'+data.product_id).html('');

                           $('.status_'+data.product_id).html(data.output);

                          $('#myModal').modal('hide'); 

                                       
                       
                       }else{
                             
                        printErrorMsg(data.error);

                        }
                       }
                     });

                    }

             }); 

               function printErrorMsg (msg) {

               $('.co_login label').css("margin", "10px auto 0");

               $.each( msg, function( key, value ) {
               console.log(key);
              $('.'+key+'_err').text(value);
               });
             }
                });




         $(function() {

                   setTimeout(function() { $("#hideDiv").fadeOut(3000); }, 5000)

              });

         function delete_product($id){

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

                                url:BASE_URL+'/Partner/delete_vendor_product/'+id,
                                type:'GET',
                                dataType: "json",

                                success: function(response){
        
                                     $('.product_'+id).hide();
         
   
                                     },
 
                            error: function(response) {

                                     alert('error');
          
                                },        
          
                           });



                    
                    } else {
                     
                    }
                  });
         
          

             } 


              $(function(e) {

               $('#chkcheckAll').click(function(){

                   $(".checkBoxClass").prop('checked', $(this).prop('checked'));

               });

              $('.delete-btn1').click(function(e){

                 $.ajaxSetup({
                   headers: {
                     'X-CSSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                         }
                    });


                   var BASE_URL = "{{ url('/') }}";

                      e.preventDefault();    

                      var allids=[];

                      console.log(allids);



                      $("input:checkbox[name=ids]:checked").each(function(){

                         allids.push($(this).val());

                        
                      });


                 if(allids !=''){


                 swal({
                         title: "Are you sure?",
                            text: "Once deleted, you will not be able to recover this data!",
                          /*  icon: "warning",*/
                            buttons: true,
                            dangerMode: true,
                              })
                          .then((willDelete) => {
                            if (willDelete) {


                                    $.ajax({

                                      url:BASE_URL+'/Partner/delete_all_vendor_product',
                                      type:'post',
                                      data:{

                                        ids:allids,
                                         _token: '{!! csrf_token() !!}',
                                    

                                      },

                                      success:function(response){


                                          if(response.status==200){
                                      
                                            $.each(allids,function(key,val){
                  
                                            $('.product_'+val).hide();

                                      
                                            });
                                            
                                                                        
                                          }
                                          else{
                                              alert(response.message)
                                          }

                                       }

                                    });

                             
                                } else {
                            
                              }
                          });


                          }

                    });
                

               });


            


      $(document).ready(function(){

         $('#txtSearch').on('keyup', function(){

          var text = $('#txtSearch').val();


          var BASE_URL = "{{ url('/') }}";
           $.ajax({

            type:"GET",
            url:BASE_URL+'/Partner/search_vendor_product',
            data: {text: $('#txtSearch').val()},
            success: function(response) {
               

             $('#product_list').html("");
              $('#product_list').html(response);

                 console.log(response);
             }



        });


    });

});



     
      </script>


      @endsection
     
