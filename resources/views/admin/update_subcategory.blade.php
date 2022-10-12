@extends('admin.layouts.header')

@section('content')

 <div class="head-banner">
          <ul class="breadcrumb">
              <li>
                  <a href="{{url('admin/home')}}">Home</a>
              </li>
              <li>
                  <a href=""><span>update SubCategory</span></a>
              </li>
          </ul>
      </div>
      <div class="page mt-4 hosting-page title1 page-with" style="display: block;">
         <div class="list1">
            <h4 class="mb-4">UPDATE SUBCATEGORY</h4>
         </div>

           @if ($message = Session::get('error'))
            <div  id="hideDiv" class="alert alert-error alert-block" >
                <!--     <input type="text" class="close" data-dismiss="alert"></input> -->
                <strong style="padding-top : 5px !important; display: inline-block;">{{ $message }}</strong>
             </div>
           @endif
  @yield('content')
         <div class="detail table-responsive">

          <form  action="{{url('admin/store_update_subcategory')}}/{{$id}}" enctype="multipart/form-data" method="POST" >
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

                       <option value="{{ $c->id }}" {{$c->id== $category_name? 'selected' : ''}}>{{ $c->name }}</option>

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
                     <input type="text" placeholder="Enter Name" name="name" value="{{$sub_name}}">
                       @if($errors->has('name')) <p class="error_mes">{{ $errors->first('name') }}</p> @endif
                  </div>   
               </div>

             
               <div class="uplode-btn">
                  <button>Update</button>
                  <a href="{{url('admin/home')}}">Back to Home?</a>
               </div>
            </div>
          </form>
         </div>
      </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.min.js"></script>


    <script type="text/javascript">

       $(function() {

           setTimeout(function() { $("#hideDiv").fadeOut(3000); }, 5000)

            });




         
  </script>





@endsection