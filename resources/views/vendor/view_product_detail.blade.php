@extends('vendor.layouts.app')

@section('content')


  <div class="head-banner">
         <ul class="breadcrumb">
            <li>
               <a href="{{url('Partner/vendor_home')}}">Home</a>
            </li>
            <li>
               <a href=""><span>Product Detail</span></a>
            </li>
         </ul>
    </div>


     <div class="page mt-4 hosting-page title1" style="display: block;">
         <div class="list1">
            <h4 class="mb-0"> Product Detail</h4>
            <div class="btn1-main">
           
                <button class="btn1"><a href="{{url('Partner/vender_product')}}" style="color:white;">Back</a></button>
            </div>
         </div>

     
         <div class="grey-bg-2 pb_01">
	      <div class="co_single-product pro_1">
			 <div class="container">
				<div class="row">
				   <div class="col-lg-6 col-md-6">
						
                  <div class="three">
                  	@foreach($product_image as $pi)
                      <div class="bottom-image"><img src="/uploads/{{$pi->file}}"></div>

                      @endforeach

                  </div>      
	                   
					</div>
					<div class="col-lg-6 col-md-6">
						<div class="single-product-details">
							<h1>{{$name1}}</h1>
							<h6 class="product-price"><i class="fal fa-rupee-sign"></i>{{$price}} / Day</h6>
							
							<p><strong>Category:</strong> {{$category_name}}, {{$subcategory_name}}</p>
						<!-- 	<p><strong>Select Days:</strong> 1</p> -->
							<p><strong>Qty:</strong>{{$quantity}}</p>
							<p><strong>Description:</strong></p>
							<p>{!! $description !!} </p>
							

							@if($category_name=='Cloths')

							<p><strong>Additional information :</strong></p>

							<table class="table table-bordered">
				        	    <tbody>
				      
				        	        <tr>
				        	          <th scope="row">Color:</th>
				        	          <td>{{$colour}}</td>
				        	        </tr>
				        	        <tr>
				        	          <th scope="row">Sizes:</th>
				        	          <td>{{$size}}</td>
				        	        </tr>
				        	    </tbody>
				        	</table>
				        	@endif
						</div>
					</div>
				</div>
			</div>
	    </div>
	</div>     
      
  </div>

	@endsection



