@extends('admin.layouts.header')

@section('content')

 <div class="head-banner">
          <ul class="breadcrumb">
              <li>
                  <a href="{{url('admin/home')}}">Home</a>
              </li>
              <li>
                  <a href="{{url('admin/add_subcategory')}}"><span>Add SubCategory</span></a>
              </li>
          </ul>
      </div>
      <div class="page mt-4 hosting-page title1 page-with" style="display: block;">
         <div class="list1">
            <h4 class="mb-4">ADD NEW SUBCATEGORY</h4>
         </div>

        
  @yield('content')
         <div class="detail table-responsive">

          <form  action="{{url('admin/store_subcategory')}}" enctype="multipart/form-data" method="POST" >
                @csrf
            <div class="details_main">

               <div class="part">
                  <div class="col-md-12 label">
                     <label>Category</label>
                  </div>
                  <div class="col-md-12 data">
                    <select name="category">

                      <option value="">Select Category</option>

                       @foreach($category as $c)

                       <option value="{{$c->id}}">{{$c->name}}</option>

                       @endforeach
        

                    </select>
                       @if($errors->has('category')) <p class="error_mes">{{ $errors->first('category') }}</p> @endif
                  </div>   
               </div>
                
               <div class="part">
                  <div class="col-md-12 label">
                     <label>SubCategory Name</label>
                  </div>
                  <div class="col-md-12 data">
                     <input type="text" placeholder="Enter Name" name="name" value="">
                       @if($errors->has('name')) <p class="error_mes">{{ $errors->first('name') }}</p> @endif
                  </div>   
               </div>

             
               <div class="uplode-btn">
                  <button>Add</button>
                  <a href="{{url('admin/home')}}">Back to Home?</a>
               </div>
            </div>
          </form>
         </div>
      </div>

     <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


    <script type="text/javascript">

       $(function() {

           setTimeout(function() { $("#hideDiv").fadeOut(3000); }, 5000)

            });


         
  </script>





@endsection