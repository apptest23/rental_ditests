@extends('admin.layouts.header')

@section('content')

 <div class="head-banner">
          <ul class="breadcrumb">
              <li>
                  <a href="{{url('admin/home')}}">Home</a>
              </li>
              <li>
                  <a href="#"><span>Update Home page Banner</span></a>
              </li>
          </ul>
      </div>
      <div class="page mt-4 hosting-page title1 page-with" style="display: block;">
         <div class="list1">
            <h4 class="mb-4">UPDATE HOME PAGE BANNER</h4>
         </div>
         <div class="detail table-responsive">

           <form  action="{{url('admin/store_update_home_banner')}}/{{$id}}" enctype="multipart/form-data" method="POST" >
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
                       <input type="hidden" name="oldimage" value="{{$image}}">
                      
                        
                  </div>            
               </div>
               <div class="part">
                   <div class="col-md-12 label">
                     <label>Title</label>
                   </div>
                  <div class="col-md-12 data">
                     <input type="text" placeholder="Enter Title" name="title" value="{{$title}}">
                       @if($errors->has('title')) <p class="error_mes">{{ $errors->first('title') }}</p> @endif
                 </div>   
               </div>

                  <div class="part part1">
                  <div class="col-md-12 label">
                     <label>Already Add Short Description</label>
                  </div>

                  @foreach($more_maintitle as $m)
                  <div class="col-md-12 data data1" id="maintitle_{{$m->id}}">
                     <div class="days data1">
                       <textarea type="text"  value="{{$m->more_maintitle}}" rows="1">{{$m->more_maintitle}}</textarea> 
                        <button id="" type="button" class="btn-remove" onclick="delete_maintitle({{$m->id}})">Delete</button>
                     </div>
                  </div>
                  @endforeach
               </div>

                <div class="part part1">
                  <div class="col-md-12 label">
                     <label>Short Description</label>
                  </div>
                  <div class="col-md-12 data data1">
                     <div class="days data1">
                       <textarea type="text" placeholder="Enter here" name="short_description" value="" rows="2"></textarea>   
                        <button id="removeRow" type="button" class="btn-remove">Remove</button>
                     </div>
                     <div id="newRow"></div>
                     <button id="addRow1" type="button" class="btn-remove btn-add1">Add more</button>
                  </div>
               </div>
               <div class="uplode-btn">
                  <button>Add</button>
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


      $(document).on('click', '#addRow1', function () {
           var html = '';
             
            html += '<div class="days">';
           html += ' <textarea type="text" placeholder="Enter here" name="short_descriptions[]" value="" row="2"> </textarea>';
            html += '<button id="removeRow" type="button" class="btn-remove">Remove</button>';
            html += '</div>';
           

            $('#newRow').append(html);
        });

     
        $(document).on('click', '#removeRow', function () {
            $(this).closest('.days').remove()
        });

        function delete_maintitle($id){


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

                                url:BASE_URL+'/admin/deletemaintitle/'+id,
                                type:'GET',
                                dataType: "json",

                                success: function(response){
        
                                     $('#maintitle_'+id).hide();
         
   
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
 