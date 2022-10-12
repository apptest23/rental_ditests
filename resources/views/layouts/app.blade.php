<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>RENTAL SYSTEM</title>
	<link rel="stylesheet" type="text/css" href="/css/home_fornt.css">

	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.9/slick.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.9/slick-theme.min.css">
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
     <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.css">
	<link rel="icon" href="image/logo.png">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <style type="text/css">
/*.dropbtn {
  color: white;
  font-size: 16px;
  border: none;
  cursor: pointer;
}
.dropdown {
  position: relative;
  display: inline-block;
    width: 100%;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f1f1f1;
  min-width: 160px;
  overflow: auto;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
    color: black;
    padding: 10px 16px;
    font-size: 14px;
    text-decoration: none;
    display: block;
    border-bottom: 1px solid #dee2e6;
}

.dropdown a:hover {background-color: #ddd;}
*/
.new__1 {
    display: block!important;
    z-index: 99;
    position: absolute;
    width: 100%;
}
.no_data span {
    /* text-align: center; */
    /* left: 10px; */
    position: absolute;
    margin-left: 86px;
    margin-top: 36px;
    font-size: 26px;
    font-weight: 700;
}


.dropdown-content {
    background: #fff;
    box-shadow: 0 3px 6px rgb(0 0 0 / 16%), 0 3px 6px rgb(0 0 0 / 23%);
    position: absolute;
    top: 48px;
    left: 33px;
    width: 552px;
    color: black;
    height: 350px;
    display: none;
    overflow-x: hidden;
    padding: 25px;
    border-bottom-right-radius: 10px;
    border-bottom-left-radius: 10px;
}
.dropdown-content:after {
    content: '';
    position: absolute;
    top: -13px;
    left: 20px;
    border-bottom: solid 13px #ffffff;
    border-left: solid 13px transparent;
    border-right: solid 13px transparent;
}
.dropdown-content .inner_droupdown{
    height: 320px;
    overflow-x: hidden;
    padding: 30px 25px;
}
.dropdown-content::-webkit-scrollbar {
   background-color:transparent;
   width: 10px;
}
.dropdown-content::-webkit-scrollbar-track {
   background-color:transparent;
}
.dropdown-content::-webkit-scrollbar-track:hover {
   background:transparent;
}
.dropdown-content ::-webkit-scrollbar-thumb {
   background: rgba(196, 196, 196, 0.50);
   border-radius:17px;
}
.dropdown-content::-webkit-scrollbar-thumb:hover {
   background: rgba(196, 196, 196, 0.50);
}
.dropdown-content::-webkit-scrollbar-button {
   display:none;
}
/*.dropdown-content .d-flex{
    margin-bottom: 20px;
}*/
.search-img {
    width: 50px;
    height: 50px;
    margin-right: 20px;
    margin-bottom: 20px;
    margin-left: 10px;
    top: 5px;
}
.search-img img {
    width: 50px;
    height: 50px;

    object-fit: cover;
}
.product-name {
    width: 90%;
}
.product-name h6 {
    font-size: 16px;
    font-weight: 700;
    text-transform: capitalize;
    margin: 0;
}
.product-name p {
    font-size: 15px;
    color: #df453e;
    font-weight: 500;
    margin: 0;
}
.dropdown-content a{

    color: black;
    text-decoration: none;


}
.footer_silder p{
    text-overflow: ellipsis;
  overflow: hidden;
}
.footer_silder p span{
     -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
  text-overflow: ellipsis;
   display: -webkit-box;
}


#txtSearch:not(:valid) ~ .close-search {
    display: none;
}
.close-icon {
    border:1px solid transparent;
    background-color: transparent;
    display: inline-block;
    vertical-align: middle;
  outline: 0;
  cursor: pointer;
}

</style>
  </head>


     <body class="body">

	<div class="co_header" id="dynamic">
		<div class="container">
			<div class="row row1">
				<div class="col-lg-3 col-md-3">
					<div class="logo">
						<a href="{{url('/')}}"><img src="/image/logo.png"></a>
					</div>
				</div> 
				<div class="col-lg-6 col-md-6">
				    <div class="search-box">

				    	<!-- <input type="search" placeholder="Search Products..." name="product" id="txtSearch" autocomplete="off">      -->              
				    	<button>search</button>
                       <!--  <button class="close-icon close-search" type="reset"><i class="fal fa-times"></i></button> -->


                                   
                                
                                 <!-- <input type="text"   />
                                   <span class="close-search"><i class="fal fa-times"></i></span> -->
                                
                                
                                    <form method="get" class="user_serach">
                                        <input type="text" placeholder="Search"  name="product" required class="search-box" id="txtSearch" autocomplete="off" />
                                        <button>search</button>
                                            <button class="close-icon close-search" type="reset"><i class="fal fa-times"></i></button>
                                        </form>

<style>
 
.close-icon {
    border:1px solid transparent;
    background-color: transparent;
    display: inline-block;
    vertical-align: middle;
  outline: 0;
  cursor: pointer;
}
.search-box:not(:valid) ~ .close-icon {
    display: none;
}
</style>
            
                                              
                              
                           
				    </div>

                    <div id="myDropdown" class="dropdown-content">
                        <div class="inner_droupdown">
                        <!--  <div class="d-flex">
                             <div class="search-img">
                                <img src="uploads/1649997251_cloth4.jpg">
                             </div>
                             <div class="product-name">
                                 <h6>p-name</h6>
                                 <p>cat</p>
                             </div>
                         </div>     -->
                     </div>
                    </div>
				</div>
                 @guest
				<div class="col-lg-3 col-md-3">
					<ul class="login">
					
                       <li><a href="{{url('/User/login_registration')}}">login</a></li>               
	
					 </ul>

				  </div>

                  @else               
                    
                  <div class="col-lg-3 col-md-3">
                    <div class="user-section">
                    <img src="/image/user.png">
                    <div class="user-dropdown">
                        <div class="user-functionality link">
                            <ul>
                                <li><a href="{{url('User/profile')}}">Edit Profile</a></li>
                                <li><a href="{{url('User/beg_item')}}">Beg Item</a></li>
                              <!--   <li><a href="checkout.html">Checkout</a></li> -->
                                <li><a href="{{url('/User/logout')}}">Logout</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                </div>                     

             @endguest

			</div>
		</div>
	</div>


	<div class="mobile_manu">
	   <div class="row row1">
	      <div class="col-md-6 col-6">
	        <div class="logo">
	          <a href="{{url('/')}}"><img src="/image/logo.png"></a>
	        </div>
	      </div>
	      <div class="col-md-6 col-6">
	         <div class="item">
	        <!--     <i class="icon1 fas fa-search"></i> -->
                 @guest
	            <a href="{{url('/User/login_registration')}}"><i class="fas fa-user-alt"></i></a>
                 @else 

                @endguest
	            <div class="mobile-menu">
	               <div id="mySidepanel" class="sidepanel" style="width: 0px;">
	                  <div class="m_menu">
	                     <a href="javascript:void(0)" class="closebtn" onclick="closeNav()"><i class="far fa-times"></i></a>
	                     <nav class="animated bounceInDown">
	                        <ul>

	                        	@foreach($category_menu as $c)
	                           <li class="sub-menu link1"><a href="#">{{$c->name}}</a><div class="fa fa-caret-down right"></div>
						               <ul style="display: none;">
						               	@foreach($subcategory_menu as $sc)

						               	  @if($c->id==$sc->category)

							                  <li><a href="{{url('/product')}}/{{$sc->id}}">{{$sc->name}}</a></li>
				                		    
				                		      @endif

			                		      @endforeach
						               </ul>
	                           </li>
	                           @endforeach
	                         
	                        </ul>
	                     </nav>
	                  </div>
	               </div>
	                  <button class="openbtn" onclick="openNav()"><i class="far fa-bars"></i></button> 
	            </div>
	         </div>
	      </div>
	   </div>
       <div class="search-box1">
			<form>
				<input type="text" placeholder="search &amp; enter" name="search" value="" autocomplete="off" >
			</form>
			<a class="srh-btn"><i class="fa fa-times" aria-hidden="true"></i></a>
		</div>
       </div>
	<div class="co_menu">
		<div class="container">
			<div class="menu">
				<nav class="navbar">
	               <ul class="nav">

	               	@foreach($category_menu as $c)
		               <li>
		                	<img src="/uploads/{{$c->icon_image}}">
			               {{$c->name}}<i class="fal fa-angle-down"></i>
		                	<ul class="dropdown">
		                		@foreach($subcategory_menu as $sc)

						            @if($c->id==$sc->category)

		                		        <li><a href="{{url('/product')}}/{{$sc->id}}">{{$sc->name}}</a></li>
		                		
		                		    @endif

			                	@endforeach

		                	</ul>
		               </li>
		               @endforeach
		               
	               </ul>
            </nav>	
			</div>
		</div>
	</div>

<div>

	 @yield('content')

    </div>

	 <div class="main_footer">
    	<div class="container1">
    		<div class="footer">
    			<div class="container">
    				<div class="footer_inner">
    					<div class="shape-1"></div>
    					<div class="left-image"></div>
    					<div class="row">
    						<div class="col-lg-4 col-md-4">
    							<div class="footer_silder">

                                   @foreach($footer_product as $fp)

    							    <div class="footer_img">

                                        @foreach($footer_product_image as $pi)
                                        @if($pi->product_id == $fp->id)

    								      <img src="/uploads/{{$pi->file}}">

                                           @break

                                        @endif

                                        @endforeach
    								    <p>{!!$fp->description !!}</p>
    								    <button><a href="{{url('/product_detail')}}/{{$fp->id}}">Book Now</a></button>
    							    </div>

                                    @endforeach
    							  
    							</div>

    						</div>
    						<div class="col-lg-5 col-md-5">
    							<div class="footer_right">
						    		<div class="info-footer">
						                <div class="footer-content">
						                    <div class="footer-title"><h4>Contact Details</h4></div>                   
						                    <div class="info">
						                        <ul>
						                            <li>
						                            	<i class="fas fa-map-marker-alt"></i>
						                            	<p>Shop No. 19, Shree Vinayak Homes Apartment, Opp. I, T.I, Bilimora, Navsari 396325</p>
						                            </li>
						                            <li>
						                                <i class="fas fa-phone-volume"></i>
						                                <p><a href="tel:+91-9558561212">+91-9558561212</a> /
						                                  <a href="tel:+91-9427112299">+91-9427112299</a></p>
						                            </li>
						                            <li>
						                                <i class="fas fa-envelope-open-text"></i>
						                                <p><a href="mailto:info@digitalinovation.com">info@digitalinovation.com</a></p>
						                            </li>
						                        </ul>
						                    </div>
						                </div>
						            </div>
    							</div>
    						</div>
    						<div class="col-lg-3 col-md-3 ">
    							<div class="footer-last">
    								<div class="footer-title"><h4>What We Do</h4></div>
									<ul>
										<li class="page_item"><a href="#">About Us</a></li>
										<li class="page_item"><a href="#">Contact</a></li>
										<li class="page_item"><a href="#">Renting Policy</a></li>
									</ul>
								</div>
    						</div>
    					</div>
    				</div>
    			</div>
    		</div>
    		<div class="footer-bottom">
	            <div class="container">
	                <div class="inner">
	                    <div class="copyright">Copyright © 2020 Langong. All Rights Reserved.</div>
                        <div class="social-links">
						    <ul>
						        <li><a href="#"><span class="fab fa-facebook-f"></span></a></li>
						        <li><a href="#"><span class="fab fa-twitter"></span></a></li>
						        <li><a href="#"><span class="fab fa-youtube"></span></a></li>
						        <li><a href="#"><span class="fab fa-linkedin"></span></a></li>
						    </ul>
						</div>
	                </div>
	            </div>
	        </div>
    	</div>
   </div>
   <a class="scrollToTop active">
      <i class="far fa-dot-circle"></i>
      <span>Top</span>
   </a>
	



	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <script type="text/javascript">
        

       	function openNav() {
            document.getElementById("mySidepanel").style.width = "100%";
        }
        function closeNav() {
            document.getElementById("mySidepanel").style.width = "0";
        }

           /* $(document).ready(function(){
              $(".search-box").click(function(){
                $(".dropdown-content").toggleClass('new__1');
              });
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

        $('.user-section').click(function(){
            $('.user-dropdown').slideToggle("slow");
        });

        $('.shopping-cart').click(function(){
            $('.cart-box').slideToggle("slow");
        });

        $('.toggle1').click(function(){
            $('.animated').slideToggle("slow");
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

    	$(window).scroll(function(){
            if ($(this).scrollTop() > 50) {
                $('#dynamic').addClass('newClass');
            } else {
                $('#dynamic').removeClass('newClass');
            }
        });

    	$('.slider_manu').slick({
    		autoplay:false,
            slidesToShow:6,
            slidesToScroll: 1,
            dots:false,
            arrows:false,
            prevArrow: '<div class="banner-arrow prev-arrow"><i class="fas fa-chevron-left"></i></div>',
            nextArrow: '<div class="banner-arrow next-arrow"><i class="fas fa-chevron-right"></i></div>'
        });

    	$('.banner-slider').slick({
    		autoplay:false,
    		autoplaySpeed:1500,
            slidesToShow: 1,
            slidesToScroll: 1,
            dots:false,
            arrows:true,
            prevArrow: '<div class="banner-arrow prev-arrow"><i class="fas fa-chevron-left"></i></div>',
            nextArrow: '<div class="banner-arrow next-arrow"><i class="fas fa-chevron-right"></i></div>'
        });

        $('.category_slider').slick({
            slidesToShow: 5,
            slidesToScroll: 1,
            dots: false,
            arrows: true,
            infinite: false,
            prevArrow: '<div class="slide-arrow1 prev-arrow1"><i class="fas fa-chevron-left"></i></div>',
            nextArrow: '<div class="slide-arrow1 next-arrow1"><i class="fas fa-chevron-right"></i></div>',
            responsive: [
                 {
                  breakpoint: 1367,
                  settings: {
                  slidesToShow:4,
                  slidesToScroll: 1,
                  adaptiveHeight: true,
                  },
                },
                {
                  breakpoint: 1024,
                  settings: {
                  slidesToShow:2,
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

        $('.selling_slider').slick({
            slidesToShow: 8,
            slidesToScroll: 1,
            dots: false,
            arrows: true,
            infinite:false,
            prevArrow: '<div class="slide-arrow1 prev-arrow1"><i class="fas fa-chevron-left"></i></div>',
            nextArrow: '<div class="slide-arrow1 next-arrow1"><i class="fas fa-chevron-right"></i></div>',
            responsive: [
                {
                  breakpoint: 1367,
                  settings: {
                  slidesToShow:7,
                  slidesToScroll: 1,
                  adaptiveHeight: true,
                  },
                },
                {
                  breakpoint: 1200,
                  settings: {
                  slidesToShow:6,
                  slidesToScroll: 1,
                  adaptiveHeight: true,
                  },
                },
                {
                  breakpoint: 1024,
                  settings: {
                  slidesToShow:3,
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

        $('.cloth_slider').slick({
            slidesToShow: 8,
            slidesToScroll: 1,
            dots: false,
            arrows: true,
            infinite: false,
            prevArrow: '<div class="slide-arrow1 prev-arrow1"><i class="fas fa-chevron-left"></i></div>',
            nextArrow: '<div class="slide-arrow1 next-arrow1"><i class="fas fa-chevron-right"></i></div>',
            responsive: [
                {
                  breakpoint: 1367,
                  settings: {
                  slidesToShow:7,
                  slidesToScroll: 1,
                  adaptiveHeight: true,
                  },
                },
                {
                  breakpoint: 1200,
                  settings: {
                  slidesToShow:6,
                  slidesToScroll: 1,
                  adaptiveHeight: true,
                  },
                },
                {
                  breakpoint: 1024,
                  settings: {
                  slidesToShow:3,
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

        $('.electronic_slider').slick({
            slidesToShow: 8,
            slidesToScroll: 1,
            dots: false,
            arrows: true,
            infinite: false,
            prevArrow: '<div class="slide-arrow1 prev-arrow1"><i class="fas fa-chevron-left"></i></div>',
            nextArrow: '<div class="slide-arrow1 next-arrow1"><i class="fas fa-chevron-right"></i></div>',
            responsive: [
                {
                  breakpoint: 1367,
                  settings: {
                  slidesToShow:7,
                  slidesToScroll: 1,
                  adaptiveHeight: true,
                  },
                },
                {
                  breakpoint: 1200,
                  settings: {
                  slidesToShow:6,
                  slidesToScroll: 1,
                  adaptiveHeight: true,
                  },
                },
                {
                  breakpoint: 1024,
                  settings: {
                  slidesToShow:3,
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

        $('.event_slider').slick({
            slidesToShow: 8,
            slidesToScroll: 1,
            dots: false,
            arrows: true,
            infinite: false,
            prevArrow: '<div class="slide-arrow1 prev-arrow1"><i class="fas fa-chevron-left"></i></div>',
            nextArrow: '<div class="slide-arrow1 next-arrow1"><i class="fas fa-chevron-right"></i></div>',
            responsive: [
                {
                  breakpoint: 1367,
                  settings: {
                  slidesToShow:7,
                  slidesToScroll: 1,
                  adaptiveHeight: true,
                  },
                },
               {
                  breakpoint: 1200,
                  settings: {
                  slidesToShow:6,
                  slidesToScroll: 1,
                  adaptiveHeight: true,
                  },
                },
                {
                  breakpoint: 1024,
                  settings: {
                  slidesToShow:3,
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
        
        $('.app_slider').slick({
            slidesToShow: 8,
            slidesToScroll: 1,
            dots: false,
            arrows: true,
            infinite: false,
            prevArrow: '<div class="slide-arrow1 prev-arrow1"><i class="fas fa-chevron-left"></i></div>',
            nextArrow: '<div class="slide-arrow1 next-arrow1"><i class="fas fa-chevron-right"></i></div>',
            responsive: [
                {
                  breakpoint: 1367,
                  settings: {
                  slidesToShow:7,
                  slidesToScroll: 1,
                  adaptiveHeight: true,
                  },
                },
               {
                  breakpoint: 1200,
                  settings: {
                  slidesToShow:6,
                  slidesToScroll: 1,
                  adaptiveHeight: true,
                  },
                },
                {
                  breakpoint: 1024,
                  settings: {
                  slidesToShow:3,
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

        $('.vehicle_slider').slick({
            slidesToShow: 8,
            slidesToScroll: 1,
            dots: false,
            arrows: true,
            infinite: false,
            prevArrow: '<div class="slide-arrow1 prev-arrow1"><i class="fas fa-chevron-left"></i></div>',
            nextArrow: '<div class="slide-arrow1 next-arrow1"><i class="fas fa-chevron-right"></i></div>',
            responsive: [
                {
                  breakpoint: 1367,
                  settings: {
                  slidesToShow:7,
                  slidesToScroll: 1,
                  adaptiveHeight: true,
                  },
                },
              {
                  breakpoint: 1200,
                  settings: {
                  slidesToShow:6,
                  slidesToScroll: 1,
                  adaptiveHeight: true,
                  },
                },
                {
                  breakpoint: 1024,
                  settings: {
                  slidesToShow:3,
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

        $('.construction_slider').slick({
            slidesToShow: 8,
            slidesToScroll: 1,
            dots: false,
            arrows: true,
            infinite: false,
            prevArrow: '<div class="slide-arrow1 prev-arrow1"><i class="fas fa-chevron-left"></i></div>',
            nextArrow: '<div class="slide-arrow1 next-arrow1"><i class="fas fa-chevron-right"></i></div>',
            responsive: [
                {
                  breakpoint: 1367,
                  settings: {
                  slidesToShow:7,
                  slidesToScroll: 1,
                  adaptiveHeight: true,
                  },
                },
               {
                  breakpoint: 1200,
                  settings: {
                  slidesToShow:6,
                  slidesToScroll: 1,
                  adaptiveHeight: true,
                  },
                },
                {
                  breakpoint: 1024,
                  settings: {
                  slidesToShow:3,
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

        $('.footer_silder2').slick({
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


            $(document).ready(function(){

    $('#txtSearch').on('keyup', function(){

        var text = $('#txtSearch').val();
         if(text=='')
        {
           $(".dropdown-content").css({"display":"none"});
            
        }

        $.ajax({

            type:"GET",
            url: '/search',
            data: {text: $('#txtSearch').val()},
            success: function(response) {


           $(".dropdown-content").css({"display":"block"});
                  
             
             /* $('#myDropdown').html('<a href="tel:7698877904">jinal</a>');*/
              $('#myDropdown').html(response);

                 console.log(response);
             }

        });


    });

});


  
   $(".close-search").click(function(){
                $(".dropdown-content").css({"display":"none"});
              
                
            });

    </script>
	
</body>
</html>