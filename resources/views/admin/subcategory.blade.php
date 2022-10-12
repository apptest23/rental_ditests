@extends('admin.layouts.header')

@section('content')

 <div class="head-banner">
         <ul class="breadcrumb">
            <li>
               <a href="{{url('admin/home')}}">Home</a>
            </li>
            <li>
               <a href="{{url('admin/subcategory')}}"><span>SubCategory List</span></a>
            </li>
         </ul>
      </div>
      <div class="page mt-4 hosting-page title1" style="display: block;">
         <div class="list1">
            <h4 class="mb-0">SubCategory List</h4>
            <div class="btn1-main">
                <button class="btn1 delete-btn1">all delete</button>
                <button class="btn1"><a href="{{url('admin/add_subcategory')}}" style="color:white;">ADD</a></button>
            </div>
         </div>
         <div class="sear-list">
            <div class="row">
               <div class="col-lg-12">
                  <div class="sear-main">
                    <!--  <label><input type="search" class="form-control " placeholder="Find..."></label> -->
                  </div>
               </div>
            </div>
         </div>
         <div class="pro-table table-responsive">
            <table class="table table-bordered table-striped">
               <thead>
                  <tr>
                    <th><input type="checkbox" name="" id="chkcheckAll"/></th>
                     <th>Sr.No</th>
                     <th>Category Name</th>
                     <th>SubCategory Name</th>
                  
                   <!--   <th>Edit/Delete</th> -->
                     <th>Action</th>
                  </tr>
               </thead>

               @foreach($subcategory as $key=>$s)
                 <tbody class="subcategory_{{$s->id}}">
                    <tr>
                        <td><input type="checkbox" name="ids" class="checkBoxClass" value="{{$s->id}}"/></td>
                        <td>{{$key+1}}</td>
                        
                      

                        @foreach($category as $key=>$c)

                         @if($c->id==$s->category)

                          <td>{{$c->name}}</td>

                          @endif

                        @endforeach

                          <td>{{$s->name}}</td>
                       
                        <td>
                          <a class="icon__1" href="{{url('admin/update_subcategory')}}/{{$s->id}}"><i class="fas fa-edit"></i></a>
                           <a class="icon__2" onclick="delete_subcategory({{$s->id}})"><i class="fas fa-trash-alt"></i></a>
                        </td>
                       <!--  <td class="clo">
                           <button class="clo btn0"><a href="#">view</a></button>
                        </td> -->
                    </tr>
                 </tbody>
               @endforeach
              
            </table>

            {{ $subcategory->links('admin.pagination') }}
     
         </div>
      </div>

                     <div id="myModal" class="modal fade" >
                        <div class="modal-dialog modal-confirm">
                          <div class="modal-content">
                          
                            <div class="modal-body">
                              <p>Do you really want to delete these client?</p>
                            </div>
                            <div class="modal-footer justify-content-center">
                              <form>
                                
                                <input type="hidden" id="category_id" name="category_id" value="">
                              </form>
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                              <button type="button" class="btn btn-danger delete_category" id="data_id">Delete</button>
                            </div>
                          </div>
                        </div>
                       </div>  

      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
      
       <script type="text/javascript">

         $(function() {

                   setTimeout(function() { $("#hideDiv").fadeOut(3000); }, 5000)

              });


         function delete_subcategory($id){


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

                                url:BASE_URL+'/admin/delete_subcategory/'+id,
                                type:'GET',
                                dataType: "json",

                                success: function(response){
        
                                     $('.subcategory_'+id).hide();
         
   
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

                                      url:BASE_URL+'/admin/delete_all_subcategory',
                                      type:'post',
                                      data:{

                                        ids:allids,
                                         _token: '{!! csrf_token() !!}',
                                    

                                      },

                                      success:function(response){


                                          if(response.status==200){
                                      
                                            $.each(allids,function(key,val){
                  
                                            $('.subcategory_'+val).hide();

                                      
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





      </script>
      <style type="text/css">

        #myModal{

          top: 100px;
          text-align: center;
        }
        

      </style>

      @endsection