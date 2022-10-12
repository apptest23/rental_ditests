@extends('admin.layouts.header')

@section('content')

<div class="head-banner">
         <ul class="breadcrumb">
            <li>
               <a href="{{url('admin/home')}}">Home</a>
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
                <button class="btn1"><a href="{{url('admin/add_product')}}" style="color:white;">ADD</a></button>
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
                     <th>Quantity</th>       
                    
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
                        <td>{{$p->quantity}}</td>
                        <td>
                           <a class="icon__1" href="{{url('admin/view_product')}}/{{$p->id}}"><i class="fas fa-eye"></i></a>
                           <a class="icon__1" href="{{url('admin/update_product')}}/{{$p->id}}"><i class="fas fa-edit"></i></a>
                           <a class="icon__2" onclick="delete_product({{$p->id}})"><i class="fas fa-trash-alt"></i></a>

                        
                        </td>
                       
                        
                    </tr>
                     @endforeach
               </tbody>
              

              
              
            </table>

              {{ $product->links('admin.pagination') }}
          
         </div>
      </div>
      @endsection


      
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
      
       <script type="text/javascript">

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

                                url:BASE_URL+'/admin/delete_product/'+id,
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

                                      url:BASE_URL+'/admin/delete_all_product',
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
            url:BASE_URL+'/admin/search_product',
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