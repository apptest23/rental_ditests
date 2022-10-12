@extends('layouts.app')

@section('content')

	<div class="grey-bg-2 pb_01">
	    <div class="co_single-product">
			<div class="container">

				
			<form>
				<div class="row">
					<div class="col-lg-5 col-md-5">
						<div class="main">
	                        <div class="slider slider-for">
	                        	@foreach($product_image as $p)
	                            <div class="top-image"><img src="/uploads/{{$p->file}}"></div>
	                            @endforeach
	                           
	                        </div>
	                        <div class="slider slider-nav">
	                        	@foreach($product_image as $p)
	                            <div class="bottom-image"><img src="/uploads/{{$p->file}}"></div>
	                            @endforeach
	                           
	                        </div>
	                    </div>
					</div>
					<div class="col-lg-7 col-md-7">
						<div class="single-product-details">
							<div>
								<h1>{{$name}}  <a href="{{url('/partner_profile')}}/{{$vendor_id}}"><span style="color:#df453e; font-size: 15px ; margin-left: 7px" > {{$vendor_name}} </span></a> </h1>

							</div>
							
							<input type="hidden" name="product_id" id="product_id" value="{{$id}}">
							<h6 class="product-price"><i class="fal fa-rupee-sign"></i>{{$price}} / 1 Day</h6>
							{!!$description!!}
							<p><strong>Category:</strong> {{$category_name}} , {{$subcategory_name}} </p>

						    <p><strong>Quantity:</strong id="total_qty" value="{{$quantity}}"> {{$quantity}} </p>

						    <p><strong>Delivery Date:</strong><input type="text" name="delivery_date" id="datepicker" value="" > <span id="date_msg" style="color:red;"></span>   </p>
						   
						    <p><strong>Return Date:</strong> <input type="text" name="return_date" id="datepicker1" value="" >  <span id="date_msg1" style="color:red;"></span>  </p>

						  <!--    <p><strong>Total Days:</strong><input  class="days" type="text" name="days" id="days" value="" >  </p> -->

							<div class="row row1">
								<div class="col-lg-6 col-md-6 col-6">
	                           
	                               <p><strong>Total Days:</strong><input  class="days" type="text" name="days" id="days" value="" readonly></p>
	                                   	                                          
	                            </div>
	                            <div class="col-lg-6 col-md-6 col-6">
	                                <div class="quality">
	                                	<input type="hidden" name="qty" value="{{$quantity}}" id="qty">
	                                    <h3 class="cart-title">Qty</h3>
	                                    <div class="number">
	                                        <span class="minus">-</span>
	                                        <input type="text" value="1"/>
	                                        <span class="plus" id="addmore_qty" >+</span>
	                                      
	                                    </div><br>
	                                      <input type="hidden" name="get_qty" value="" id="get_qty" value="">
	                                    <span id="mes" style="color:red;"></span> 
	                                </div>
	                            </div>
	                        </div>
							 <div class="book-btn">
								<div class="call-btn" id="call-btn1">
									<a id="call_vendor" style="color:white"><span class="call-icon"><i class="fal fa-phone"></i></span>call now</a>
								</div>
							    <div class="call-btn read-more1">
							    	@if($already_in_beg==0)
	                            	<a id="book_product" style="color:white"><span class="call-icon"><i class="fal fa-arrow-right"></i></span> book now</a>
	                            	@else
	                            	<a href="{{url('User/beg_item')}}" id="beg_item" style="color:white"><span class="call-icon"><i class="fal fa-arrow-right"></i></span> Show in Beg item</a>
	                            	@endif
	                            </div>
	                        </div>
						</div>
					</div>
				</div>
				</form>
				<div class="product-tab">
					<div class="row">
						<div class="col-lg-3 col-md-3 set-product-tab">
					        <ul class="nav" role="tablist">
		                        <li class="nav-item">
		                        	<a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">Description</a>
		                        </li>
		                         @if($category_name==='Cloths')
		                        <li class="nav-item">
		                        	<a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab"> Additional information </a>
		                        </li>
		                        @endif
		                       <!--  <li class="nav-item">
		                        	<a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab">Reviews (3)</a>
		                        </li> -->
	                        </ul>
	                    </div>
	                    <div class="col-lg-9 col-md-9">
	                        <div class="tab-content">
	                	        <div class="tab-pane active" id="tabs-1" role="tabpanel">
	                		      <span> {!!$description!!}</span>
	                	        </div>
	                	        @if($category_name==='Cloths')
	                	        <div class="tab-pane" id="tabs-2" role="tabpanel">
	                	        	<table class="table table-bordered">
						        	    <tbody>     
						        	        <tr>
						        	          <th scope="row">Color:</th>
						        	          <td>{{$colour}}</td>
						        	        </tr>
						        	        <tr>
						        	          <th scope="row">Sizes:</th>
						        	         @foreach($size1 as $s)
						        	         @if($s->id==$size)
						        	          <td>{{$s->size}}</td>
						        	          @endif
						        	          @endforeach
						        	        </tr>
						        	    </tbody>
						        	</table>
	                	        </div>
	                	        @endif
	                	        <!-- <div class="tab-pane" id="tabs-3" role="tabpanel">
	                		        <div class="show-comment">
	                    	            <div>
	                    	                <div class="cm_1">
	                    	                	<div class="user-img">
	                    	                		<img src="/image/cm-user1.jpg">
	                    	                	</div>
	                    	                	<div class="user-text">
	                    	                		<h2>Bubhan Prova</h2>
	                    	                		<h6>28 Aug, 2021</h6>
	                    	                		<p>Duis vestibulum quis quam vel accumsan. Nunc a vulputate lectus. Vestibulum eleifend nisl sed massa sagittis vestibulum. Vestibulum pretium blandit tellus, sodales volutpat sapien varius vel.</p>
	                    	    	            </div>
	                    	                </div>
	                    	                <div class="cm_1 cm_2">
	                    	                	<div class="user-img">
	                    	                		<img src="/image/cm-user2.jpg">
	                    	                	</div>
	                    	                	<div class="user-text">
	                    	                		<h2>Bubhan Prova</h2>
	                    	                		<h6>28 Aug, 2021</h6>
	                    	                		<p>Duis vestibulum quis quam vel accumsan. Nunc a vulputate lectus. Vestibulum eleifend nisl sed massa sagittis vestibulum. Vestibulum pretium blandit tellus, sodales volutpat sapien varius vel.</p>
	                    	    	            </div>
	                    	                </div>
	                    	                <div class="cm_1">
	                    	                	<div class="user-img">
	                    	                		<img src="/image/cm-user3.jpg">
	                    	                	</div>
	                    	                	<div class="user-text">
	                    	                		<h2>Bubhan Prova</h2>
	                    	                		<h6>28 Aug, 2021</h6>
	                    	                		<p>Duis vestibulum quis quam vel accumsan. Nunc a vulputate lectus. Vestibulum eleifend nisl sed massa sagittis vestibulum. Vestibulum pretium blandit tellus, sodales volutpat sapien varius vel.</p>
	                    	    	            </div>
	                    	                </div>
	                    	            </div>
	                                </div>
	                                <div class="comment-form-blog">
	                                    <h3>Leave Your Comments</h3>
	                                    <form>
	                                        <div class="sblog-text">
	                                            <label>Your name : </label>
	                                            <input type="text" placeholder="Enter Your Name" name="name">
	                                        </div>
	                                        <div class="sblog-text">
	                                            <label>E-MAIL : </label>
	                                            <input type="email" placeholder="Enter Your Email" name="email">
	                                        </div>
	                                        <div class="sblog-text">
	                                            <label>YOUR COMMENT : </label>
	                                            <textarea type="text" placeholder="Write a comments" rows="5" name="comment"></textarea>
	                                        </div>
	                                        <button class="submit-btn">submit</button>
	                                    </form>
	                                </div>
	                	        </div> -->
	                        </div>
	                    </div>
	                </div>
				</div>
			</div>
	    </div>
	     <div class="co_product cloth-product">
		    <div class="container">
		    	<div class="bg-white">
		    		<div class="head-product">
					    <h1 class="product-title">related products</h1>
					    <a href="product.html">view all</a>
					</div>

					<div class="cloth_slider p-slider related_slider">
					  @foreach($product_data as $p)

					   @if($p->id != $id)	
						<div>
                        	<div class="product-main">
			                    <div class="product-img">

			                               @foreach($product_image1 as $pi)

                                               @if($p->id==$pi->product_id)



                                                 <a href=""><img src="/uploads/{{$pi->file}}"></a>

                                                 @break

                                                @endif

                                             @endforeach

			                    </div>
			                	<div class="product-details">
			                		<h1><i class="fal fa-rupee-sign"></i>{{$p->price}} / 1 Day</h1>
			                		<h3>{{$p->name}}</h3>
			                	</div>
			                </div>
                        </div>
                        @endif
                       @endforeach
                     
					</div>


				</div>
		    </div>
	    </div>
	</div>


	   <div class="modal__container" id="modal-container">
                <div class="modal__content">
                    <div class="modal__close close-modal" title="Close">
                        <i class="fas fa-window-close"></i>
                    </div>

                       <div class="vender-profile">
        <div class="container">
            <div class="sub_profile">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="profile_main">
                            <div class="profile">
                               <img src="image/p_user.jpg">
                            </div>
                            <div class="details">
                                <h4>jooe root</h4>
                                <p>info@1234gmail.com</p>
                            </div>
                            <div class="con_vender">
                                <h3>Contact Information</h3>
                                <div class="co_details">
                                    <div class="e_address">
                                        <h6>Email Address</h6>
                                        <p>info@1234gmail.com</p>
                                    </div>
                                    <div class="e_address">
                                        <h6>Phone Number</h6>
                                        <p>123456789</p>
                                    </div>
                                    <div class="e_address">
                                        <h6>Address</h6>
                                        <p>Bilimora, Gandevi taluka & Navsari district of Gujarat state, in India</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="v_pro">
                            <div class="de_head">
                                <h3>All Product</h3>
                            </div>
                            <div class="vender_img">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="item">
                                             <img src="image/product-20.jpg">
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="item">
                                             <img src="image/product-20.jpg">
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="item">
                                             <img src="image/product-20.jpg">
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="item">
                                             <img src="image/product-20.jpg">
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="item">
                                             <img src="image/product-20.jpg">
                                        </div>
                                    </div>

                                    <div class="col-lg-3">
                                        <div class="item">
                                             <img src="image/product-20.jpg">
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="item">
                                             <img src="image/product-20.jpg">
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="item">
                                             <img src="image/product-20.jpg">
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div>
                            <ul class="pagination pagination-responsive">
                                <li><a href="#">&laquo;</a></li>
                                <li class="active_1"><a href="#">1</a></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#">4</a></li>
                                <li><a href="#">5</a></li>
                                <li><a href="#">6</a></li>
                                <li><a href="#">&raquo;</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
                    
                </div>
            </div>

<style type="text/css">
	.gj-datepicker {
    display: inline-block;
}
.gj-textbox-md {
    border: 1px solid #ccc;
    padding: 10px 15px;
}
.gj-datepicker-md [role=right-icon] {
    right: 10px!important;
    top: 8px!important;
}
input#days {
    background: transparent;
    border: 1px solid #ccc;
    padding: 5px 15px;
    text-align: center;
}


/*pop-up menu*/

</style>


	<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
   
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script> -->


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
       <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.js"></script>
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <script type="text/javascript">
    	  	function openNav() {
            document.getElementById("mySidepanel").style.width = "100%";
        }
        function closeNav() {
            document.getElementById("mySidepanel").style.width = "0";
        }







         /* $(document).ready(function(){
            $("#datepicker1").click(function(){    	

             var delivery_date= $("#datepicker").val();
             var return_date= $("#datepicker1").val();

              alert(delivery_date);
              alert(return_date);

          
               });


             });
*/

          $("#datepicker1").on("change",function(){
             var return_date = $(this).val();
             var delivery_date= $("#datepicker").val();

             if(delivery_date !=''){


             var diff = new Date(Date.parse(return_date) - Date.parse(delivery_date));
             var days = diff/1000/60/60/24;

            
           if(days==0 || days==1){


              $("#days").val("1");

              $(".days").text("1 Days");
             
             }else{

           	     $("#days").val(days);
           	     $(".days").text(days);
             
              }

            }else{

                 
            	$("#date_msg").text("please select the delivery date");
            	$("#date_msg").show().delay(5000).fadeOut();
            	$("#datepicker1").val('');


             }
        
                  
            });


          $('#datepicker').datepicker({
            showOtherMonths: true
        });


          $('#datepicker1').datepicker({
           
          
               showOtherMonths: true

        }); 
/*  
  $(function () {
     $('#datepicker').datetimepicker({  minDate:new Date()});
});
*/

    	$(document).ready(function(){
            $(".font").click(function(){
                 $(".search-box").slideDown("slow");
             });

            $(".search-close").click(function(){
                $(".search-box").slideUp("slow");
            });
        });

      

        $(document).ready(function(){
            $(".icon1").click(function(){
                $(".search-box1").slideDown("slow");
            });
            $(".search-box1 a").click(function(){
                $(".search-box1").slideUp("slow");
            });
        });

        $('.search-toggle').addClass('closed');
        $('.search-toggle .search-icon').click(function(e) {
            if ($('.search-toggle').hasClass('closed')) {
                $('.search-toggle').removeClass('closed').addClass('opened');
                $('.search-toggle, .search-container').addClass('opened');
                $('#search-terms').focus();
            } else {
                $('.search-toggle').removeClass('opened').addClass('closed');
                $('.search-toggle, .search-container').removeClass('opened');
            }
        });
      
      $('.sub-menu ul').hide();
		$(".sub-menu .fa.fa-caret-down").click(function () {
			$(this).parent(".sub-menu").children("ul").slideToggle("100");
			$(this).find(".right").toggleClass("fa-caret-up fa-caret-down");
		});

		
    	function show(value) {
            document.querySelector(".text-box").value = value;
        }
        $(".dropdown").click(function(){
            $(".dropdown").toggleClass("active1");
        });

    	$(window).scroll(function(){
            if ($(this).scrollTop() > 50) {
                $('#dynamic').addClass('newClass');
            } else {
                $('#dynamic').removeClass('newClass');
            }
        });

       

        var btn = $('.scrollToTop');
	        $(window).scroll(function() {
	            if ($(window).scrollTop() > 300) {
	                btn.addClass('active');  
	            }
	            else {
	                btn.removeClass('active');
	            }
	        });
	        btn.on('click', function(e) {
	            e.preventDefault();
	        $('html, body').animate({scrollTop:0}, '300');
	    }); 


        $('.slider-for').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            fade: true,
            asNavFor: '.slider-nav',
        });

        $('.slider-nav').slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            asNavFor: '.slider-for',
            dots: false,
            focusOnSelect: true,
            infinite: false,
            prevArrow: '<div class="cart-arrow slide-arrow prev-arrow"><i class="fas fa-chevron-left"></i></div>',
            nextArrow: '<div class="cart-arrow slide-arrow next-arrow"><i class="fas fa-chevron-right"></i></div>',
            responsive: [
                {
                  breakpoint: 1024,
                  settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1,
                    adaptiveHeight: true,
                  },
                },
                {
                  breakpoint: 600,
                  settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                  },
                },
            ],
        });

        $('.footer_silder').slick({
            autoplay:false,
            autoplaySpeed: 2000,
            slidesToShow: 1,
            slidesToScroll: 1,
            dots: false,
            arrows:false,
            responsive: [
                {
                  breakpoint: 1024,
                  settings: {
                  slidesToShow:1,
                  slidesToScroll: 1,
                  adaptiveHeight: true,
                  },
                },
                {
                  breakpoint: 600,
                  settings: {
                    slidesToShow:1,
                    slidesToScroll: 1,
                  },
                },
            ],
        });

           

        $('.minus').click(function () {
            var $input = $(this).parent().find('input');
            var count = parseInt($input.val()) - 1;
            count = count < 1 ? 1 : count;
            $input.val(count);
            $input.change();
            return false;
        });
        $('.plus').click(function () {

             var total_qty= $("#qty").val();

             var $input = $(this).parent().find('input');

             var $input1=$input.val();

             if($input1>=total_qty){
            	
            	$("#mes").text('Only '+total_qty+ ' Quantity is available');
            	$("#mes").show().delay(5000).fadeOut();   
            	$("#get_qty").val($input1);	

             }else{

              var input2=(parseInt($input1)+1);

               $("#get_qty").val(input2);	

               $input.val(parseInt($input.val()) + 1);
               $input.val();
               $input.change();
               return false;

            }        
        });

      
        	$(document).ready(function(){

         $.ajaxSetup({
           headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
               });


               $('#call_vendor').click(function(){

            var BASE_URL = "{{ url('/') }}";

            var _token = $("input[name='_token']").val();
            var product_id = $('#product_id').val();
           
             $.ajax({
                 url:BASE_URL+'/User/call_vendor',
                 type:'POST',

                 statusCode: {
                   401: function() {

                        window.location.href = "<?php echo URL::to( '/User/login_registration'); ?>";
              
                   }
               },

                data: {_token:_token,product_id:product_id},


           
                 success: function(response) {
         
                         $('#call-btn1').html(response);

                        
                     }
  
                 });

               });
           
           });


      $(document).ready(function(){

          $.ajaxSetup({
             headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
               });


               $('#book_product').click(function(){

                var BASE_URL = "{{ url('/') }}";
                var _token = $("input[name='_token']").val();
                var product_id = $('#product_id').val();
                var delivery_date = $('#datepicker').val();
                var return_date = $('#datepicker1').val();
                var days = $('#days').val();
                var Quantity =$('#get_qty').val();

                if(Quantity ==''){

                	//$("#mes").text('Select Quantity');

                	var Quantity =$('#get_qty').val(1);
                }

                  var Quantity =$('#get_qty').val();


                if(delivery_date ==''){

                	$("#date_msg").text('Select Delivery date');
                }


                if(return_date ==''){

                	$("#date_msg1").text('Select Return date');
                }
  
             $.ajax({
                 url:BASE_URL+'/User/store_beg_item',
                 type:'POST',

                   statusCode: {
                   401: function() {

                        window.location.href = "<?php echo URL::to( '/User/login_registration'); ?>";
              
                   }
               },

                data: {_token:_token,product_id:product_id,delivery_date:delivery_date,return_date:return_date,days:days,Quantity:Quantity},

           
                 success: function(response) {
         
                          if(response.status==1){


                          	 window.location.href = "<?php echo URL::to( '/User/beg_item'); ?>";


                          }else{



                          }
                        
                     }
  
                 });

               });
           
           });
    
    </script>

      <script type="text/javascript">
            /*=============== SHOW MODAL ===============*/
const showModal = (openButton, modalContent) =>{
    const openBtn = document.getElementById(openButton),
    modalContainer = document.getElementById(modalContent)
    
    if(openBtn && modalContainer){
        openBtn.addEventListener('click', ()=>{
            modalContainer.classList.add('show-modal')
        })
    }
}
showModal('open-modal','modal-container')

/*=============== CLOSE MODAL ===============*/
const closeBtn = document.querySelectorAll('.close-modal')

function closeModal(){
    const modalContainer = document.getElementById('modal-container')
    modalContainer.classList.remove('show-modal')
}
closeBtn.forEach(c => c.addEventListener('click', closeModal))

$('#owl-carousel').owlCarousel({
    loop: true,
    margin: 30,
    dots: true,
    nav: false,
    items: 2,
})
        </script>


@endsection