@extends('admin.layouts.header')

@section('content')

 <div class="head-banner">
         <ul class="breadcrumb">
            <li>
               <a href="dashboard.html">Home</a>
            </li>
            <li>
               <a href="index.html"><span>Admin details</span></a>
            </li>
         </ul>
      </div>
      <div class="page mt-4 hosting-page title1" style="display: block;">
         <div class="list1">
            <h4 class="mb-0"> Admin details</h4>
            <div class="btn1-main">
                <!-- <button class="btn1 delete-btn1">all delete</button> -->
              <!--   <button class="btn1"><a href="{{url('admin/add_category')}}" style="color:white;">ADD</a></button> -->
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
                 
                     <th>Sr.No</th>
                     <th>Name</th>
                     <th>Email</th>
                     <th>Address</th>
                     <th>mobileno</th>
                     <th>Facebook url</th>
                     <th>Instagram url</th>
                     <th>Youtube url</th>
                     <th>linkedin url</th>

            
                     <th>Action</th>
                  </tr>
               </thead>

               @foreach($admindetail as $key=>$a)
                 <tbody class="">
                    <tr>
                     
                        <td>{{$key+1}}</td>
                        <td>{{$a->name}}</td>
                       
                        <td>{{$a->email}}</td>


                
                        <td>{{$a->address}}</td>

                        <td>

                          @foreach($mobile_no as $m)

                          @if($a->id==$m->admin_id)
                  
                            <li>{{$m->number}}</li>

                          @endif

                          @endforeach

                        </td>

                        <td>{{$a->facebook}}</td>
                        <td>{{$a->instagram}}</td>
                        <td>{{$a->linkedin}}</td>
                        <td>{{$a->youtube}}</td>                  
                        <td>
                          <a class="icon__1" href="{{url('admin/update_adminprofile')}}/{{$a->id}}"><i class="fas fa-edit"></i></a>
                        </td>
                    </tr>
                 </tbody>
               @endforeach  
            </table>
         </div>
      </div>

            

      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
   
      
       <script type="text/javascript">

         $(function() {

                   setTimeout(function() { $("#hideDiv").fadeOut(3000); }, 5000)

              });


         function delete_category($id){


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

                                url:BASE_URL+'/admin/delete_category/'+id,
                                type:'GET',
                                dataType: "json",

                                success: function(response){
        
                                     $('.category_'+id).hide();
         
   
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

                                      url:BASE_URL+'/admin/delete_all_category',
                                      type:'post',
                                      data:{

                                        ids:allids,
                                         _token: '{!! csrf_token() !!}',
                                    

                                      },

                                      success:function(response){


                                          if(response.status==200){
                                      
                                            $.each(allids,function(key,val){
                  
                                            $('.category_'+val).hide();

                                      
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