@extends('layouts.app')

@section('content')
<div class="co_breadcumbs1">
		<div class="container">
			<div class="inner-breadcumbs1">
				<h1>Cart</h1>
			    <ul class="breadcumbs1">
		        	<li><a href="{{url('/')}}">Home</a>  <i class="fal fa-chevron-double-right"></i></li>
		        	<li>Cart</li>
		        </ul>
		    </div>
		</div>
	</div>
	<div class="co_checkout co_cart">
		<div class="container">
			<div class="cart table-responsive">
				<table class="table table-bordered text-center">
				    <thead class="thead-light">
					    <tr>
					    	<th></th>
					        <th>Image</th>
					        <th>Product Name</th>
					        <th>Price</th>
					        <th>Quantity</th>
					        <th>Days</th>
					        <th>Subtotal</th>
					    </tr>
				    </thead>
				    <tbody>
				    	@foreach($beg_item as $bi)
					    <tr>
					    	<td><button type="button" class="close">&times;</button></td>
					    	<td>

					    	<input type="hidden" name="" id="product_id" value="{{$bi->product_id}}">


					      <a href="{{url('product_detail')}}/{{$bi->product_id}}"><img src="/Uploads/{{$bi->image}}"></a>
					    	</td>
					    	<td>{{$bi->product_name}}</td>
					    	<td class="cart-price" ><i class="fal fa-rupee-sign"></i> {{$bi->price}}</td>
					    	
					    	<td>
					    		<div class="number">
	                                <span class="minus" onclick="minus_qty({{$bi->id}})" id="minus_{{$bi->id}}" >-</span>
	                                <input type="hidden" id="total_qty_{{$bi->id}}" value="{{$bi->total_qty}}">
	                                <input type="text" id="Quantity_{{$bi->id}}" value="{{$bi->Quantity}}">
	                                <span class="plus" onclick="plus_qty({{$bi->id}})" id="{{$bi->id}}">+</span>
	                            </div>
					    	</td>
					    	<td>{{$bi->days}}</td>
					    	<input type="hidden" id="day_{{$bi->id}}" value="{{$bi->days}}">
					    	<td class="cart-price" id="total_amount_{{$bi->id}}"><i class="fal fa-rupee-sign"></i>{{$bi->price*$bi->Quantity*$bi->days}}</td>
					    	
					    </tr>
					    @endforeach
					    
				  </tbody>
				</table>
			</div>
			<div class="row">
				<div class="col-lg-7 col-md-6"></div>
				<div class="col-lg-5 col-md-6">
					<div class="cart-total">
						<h1>Cart Total</h1>
						<table class="table">
				            <tbody>
				            	<tr>
				            	    <td>Subtotal</td>
				            	    <td class="text-right" id="Subtotal_txt"><i class="fal fa-rupee-sign" ></i>{{$total_amount}}</td>
				            	  
				            	</tr>
				            	<tr>
				            		<th>Total</th>
				            	    <th class="text-right" id="Subtotal_txt1" ><i class="fal fa-rupee-sign"></i>{{$total_amount}}</th>
				            	</tr>
					    
				            </tbody>
				        </table>
				        <button class="btn1">Proceed to checkout</button>
					</div>
				</div>
			</div>
		</div>
	</div>



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.9/slick.min.js"></script>
    <script type="text/javascript">

   
	/*    $('.minus').click(function () {
            var $input = $(this).parent().find('input');
            var count = parseInt($input.val()) - 1;

            alert(count);
            count = count < 1 ? 1 : count;
            $input.val(count);
            $input.change();
            return false;
        });
        $('.plus').click(function () {
            var $input = $(this).parent().find('input');
            $input.val(parseInt($input.val()) + 1);
            $input.change();
            return false;
        }); 
*/

      /* function minus_qty($id){

              var id = $id;

       	     var total_qty=$('#total_qty_'+id).val();
       	     var qty=$('#Quantity_'+id).val();
       	     var product_amount=$('#product_amount_'+id).val();

       	      var subtotal=$('#subtotal').val();

       	     var count =qty-1;
       	     count = count < 1 ? 1 : count;

       	     $('#Quantity_'+id).val(count);

       	     var book_qty=$('#Quantity_'+id).val();
       	     var book_day=$('#day_'+id).val();
       	     var book_price=$('#price_'+id).val();

       	     var total_amount=(book_qty*book_day*book_price);

                   var differnt_amount=(product_amount-total_amount);

                   
                   var subtotal_amount=(subtotal-differnt_amount);


       	      $('#total_amount_'+id).text(total_amount);
       	      $('#product_amount_'+id).val(total_amount);

       	     alert(subtotal_amount);
        }
*/


         function minus_qty($id){

         	    $.ajaxSetup({
           headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
               });


          var BASE_URL = "{{ url('/') }}";

            var _token = $("input[name='_token']").val();
            var product_id = $('#product_id').val();
            var beg_item_id = $id;
            var qty=$('#Quantity_'+beg_item_id).val();
            var count =qty-1; 
       	/*  count = count < 1 ? 1 : count;*/

       	if(count>0){



            $('#Quantity_'+beg_item_id).val(count);

               $.ajax({
                 url:BASE_URL+'/User/minus_qty',                
                 type:'POST',
                 data: {_token:_token,product_id:product_id,beg_item_id:beg_item_id,count:count},
  
                 success: function(response){

                 	var total_amount=response.price*response.days*response.Quantity;

                 	 $('#total_amount_'+beg_item_id).text(total_amount);

                 	  $('#Subtotal_txt').text('');

                 	 $('#Subtotal_txt').text(response.total);

                 	  $('#Subtotal_txt1').text('');

                 	 $('#Subtotal_txt1').text(response.total);
                                         
                     }
  
                 });

        }else{

             
  
        }
 

           
               }

    



    </script>

  @endsection