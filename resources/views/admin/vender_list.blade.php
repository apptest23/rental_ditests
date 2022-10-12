@extends('admin.layouts.header')

@section('content')

 <div class="head-banner">
         <ul class="breadcrumb">
            <li>
               <a href="{{url('admin/home')}}">Home</a>
            </li>
            <li>
               <a href=""><span>Vender List</span></a>
            </li>
         </ul>
      </div>
      <div class="page mt-4 hosting-page title1" style="display: block;">
         <div class="list1">
            <h4 class="mb-0">Vender List</h4>
            <div class="btn1-main">
               <!--  <button class="btn1 delete-btn1">all delete</button>
                <button class="btn1"><a href="{{url('admin/add_subcategory')}}" style="color:white;">ADD</a></button> -->
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
                   <!--  <th><input type="checkbox" name="" id="chkcheckAll"/></th> -->
                     <th>Sr.No</th>
                     <th>Name</th>
                     <th>Email</th>
                     <th>Mobile No</th>
                     <th>Address</th>
                     <th>Product</th>
                  
                   <!--   <th>Edit/Delete</th> -->
                     <th>Action</th>
                  </tr>
               </thead>

               @foreach($vender as $key=>$v)
                 <tbody class="vendor_{{$v->id}}">
                    <tr>
                       
                        <td>{{$key+1}}</td>
                        
                          <td>{{$v->name}}</td>
                          <td>{{$v->email}}</td>
                          <td>{{$v->phone_no}}</td>
                          <td>{{$v->address}}</td>

                            
                           <td>

                         @foreach($product as $key=>$p)

                            @if($p->vendor_id== $v->id)

                            <div>

                                  <li>{{$p->name}}</li>
                                
                            </div>

                          

                            @endif

                            @endforeach


                          </td>



                          @if($v->verified==1) 
                        
                           <td>

                             <button class="btn1"><a href="" style="color:white;">Verified</a></button> 
                         
                           </td>

                            @else

                             <td class="verify">

                             <button class="btn1 delete-btn1" onclick="verify_account({{$v->id}})"><div id="loading-bar-spinner" class="spinner"><div class="spinner-icon"></div></div>verify</button>
                         
                           </td>

                           @endif
                       <!--  <td class="clo">
                           <button class="clo btn0"><a href="#">view</a></button>
                        </td> -->
                    </tr>
                 </tbody>
               @endforeach
              
            </table>

            {{ $vender->links('admin.pagination') }}
     
         </div>
      </div>

      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
      
       <script type="text/javascript">

         $(function() {

                   setTimeout(function() { $("#hideDiv").fadeOut(3000); }, 5000)

              });


         function verify_account($id){


             swal({
                    title: "Are you sure?",
                    text: "You want to verify this account!",
                 
                    buttons: true,
                    dangerMode: true,
                  })
                  .then((willDelete) => {
                    if (willDelete) {

                    var BASE_URL = "{{ url('/') }}";

                    var id = $id;

                          $.ajax({

                                url:'/admin/verify_account/'+id,
                                type:'GET',
                                dataType: "json",


                        beforeSend: function(){

                            $('#loading-bar-spinner').show();
 
                             $('#overlay').fadeIn()

                           },

                        complete: function(){

                           $('#loading-bar-spinner').hide();
 
                         },
                                success: function(response){
        
                                    /*alert(13333);*/


                                    $('.verify').html('');

                                    $('.verify').html('<button class="btn1"><a href="" style="color:white;">Verified</a></button>');

         
   
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

     .login-inner{
        position: relative;
      }

.login-inner:after{
       content: '';
    position: absolute;
    top: 0;
    left: 0;
    z-index: 1;
    width: 100%;
    height: 100%;
    background: rgb(0 0 0 / 40%);
    display: none;

}
      

  #loading-bar-spinner.spinner {
   left: 50%;
   margin-left: -20px;
   top: 44%;
   margin-top: -20px;
   position: absolute;
   z-index: 19 !important;
   animation: loading-bar-spinner 700ms linear infinite;
   display: none;
}
 #loading-bar-spinner.spinner .spinner-icon {
   width: 40px;
   height: 40px;
   border: solid 6px transparent;
   border-top-color: black !important;
   border-left-color: black !important;
   border-radius: 50%;
}
 @keyframes loading-bar-spinner {
   0% {
     transform: rotate(0deg);
     transform: rotate(0deg);
  }
   100% {
     transform: rotate(360deg);
     transform: rotate(360deg);
  }
}
 
        

      </style>

      @endsection