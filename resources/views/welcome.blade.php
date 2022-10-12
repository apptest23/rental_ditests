@extends('layouts.app')

@section('content')

    <div class="co_banner">
        <div class="banner-slider">
             @foreach($banner as $b)  
            <div>
                <div class="banner-section">
                    <div class="banner-img">
                       <img src="uploads/{{$b->image}}">
                    </div>
                    <div class="banner-content">
                         <h1>{{$b->title}}</h1>

                         @foreach($more_maintitle as $m)

                          @if($m->banner_id == $b->id)

                            <p>{{$m->more_maintitle }}</p>

                           @endif
 
                          @endforeach
                        <!-- <button class="button button-mat btn--7">
                            <div class="psuedo-text"><a href="#">learn more <i class="fal fa-arrow-right"></i></a></div>
                        </button> -->
                    </div>
                </div>
            </div>

            @endforeach
          
        </div>
    </div>
    <div class="grey-bg-2">
        <div class="all_category pt_01">
            <div class="container">
                <div class="bg-white">
                    <!-- <h1 class="product-title1">all categories</h1> -->
                    <div class="head-product">
                        <h1 class="product-title">all categories</h1>
                        <a href="{{url('/all_category')}}">view all</a>
                    </div>
                    <div class="category_slider mb-0">
                        @foreach($category as $c)
                        <div>
                            <div class="category">
                                <div class="category-img">
                                    <a href="#"><img src="uploads/{{$c->image}}"></a>
                                </div>
                                <div class="category-details">
                                    <h2>{{$c->name}}</h2>
                                    <p>{{$c->description}}</p>
                                </div>
                            </div>
                        </div>

                        @endforeach
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="co_product pt_01">
            <div class="container">
                <div class="bg-white">
                    <div class="head-product">
                        <h1 class="product-title">trending products</h1>
                        <a href="{{url('/tranding_product')}}">view all</a>
                    </div>
                    <div class="selling_slider p-slider seller-product">

                        @foreach($product as $p)

                         <div>
                            <div class="product-main">
                                <div class="product-img">

                                  @foreach($product_image as $pi)

                                     @if($p->id==$pi->product_id)

                                      <a href="{{url('product')}}/{{$p->subcategory}}"><img src="/uploads/{{$pi->file}}"></a>

                                      @break

                                     @endif

                                    @endforeach

                                </div>
                                <div class="product-details">
                                    <h1><i class="fal fa-rupee-sign"></i>{{$p->price}}/ 1 Day</h1>
                                    <h3>{{$p->name}}</h3>
                                </div>
                            </div>
                         </div>  

                        @endforeach                      
                        
                    </div>
                </div>
            </div>
        </div>
        @foreach($category as $c)  
        <div class="co_product cloth-product pt_01">
            <div class="container">
                <div class="bg-white">
                    <div class="head-product">
                        <h1 class="product-title">{{$c->name}}</h1>
                        <a href="{{url('category_product')}}/{{$c->id}}">view all</a>
                    </div>

                    <div class="cloth_slider p-slider">     
                  
                    @foreach($product1 as $cd)

                      @if($cd->category== $c->id)
                        <div>
                            <div class="product-main">
                                <div class="product-img">
                                    @foreach($product_image as $pi)

                                       @if($cd->id==$pi->product_id)

                                        <a href="{{url('product')}}/{{$cd->subcategory}}"><img src="uploads/{{$pi->file}}"></a>
                                        @break

                                     @endif

                                    @endforeach
                                 </div>
                                <div class="product-details">
                                    <h1><i class="fal fa-rupee-sign"></i>{{$cd->price}}/ 1 Day</h1>
                                    <h3>{{$cd->name}}</h3>
                                </div>
                            </div>
                        </div>
                        @endif

                     @endforeach
                      
                    </div>
                </div>
            </div>
        </div>

       @endforeach
      <!--   <div class="co_product electronic-product pt_01">
            <div class="container">
                <div class="bg-white">
                    <div class="head-product">
                        <h1 class="product-title">Electronic</h1>
                        <a href="cloth-product.html">view all</a>
                    </div>
                    <div class="electronic_slider p-slider">

                       
                      @foreach($elect_data as $ed)
                        <div>
                            <div class="product-main">
                                <div class="product-img">
                                    @foreach($product_image as $pi)

                                       @if($ed->id==$pi->product_id)

                                        <a href="product.html"><img src="uploads/{{$pi->file}}"></a>
                                        @break

                                      @endif

                                    @endforeach
                                 </div>
                                <div class="product-details">
                                    <h1><i class="fal fa-rupee-sign"></i>{{$ed->price}}/ 1 Day</h1>
                                    <h3>{{$ed->name}}</h3>
                                </div>
                            </div>
                        </div>

                     @endforeach
                       
                    </div>
                </div>
            </div>
        </div>
        <div class="co_product event-product pt_01">
            <div class="container">
                <div class="bg-white">
                    <div class="head-product">
                        <h1 class="product-title">Event</h1>
                        <a href="cloth-product.html">view all</a>
                    </div>
                    <div class="event_slider p-slider">

                       @foreach($event_data as $ev)
                        <div>
                            <div class="product-main">
                                <div class="product-img">
                                    @foreach($product_image as $pi)

                                       @if($ev->id==$pi->product_id)

                                        <a href="product.html"><img src="uploads/{{$pi->file}}"></a>
                                        @break

                                      @endif

                                    @endforeach
                                 </div>
                                <div class="product-details">
                                    <h1><i class="fal fa-rupee-sign"></i>{{$ev->price}}/ 1 Day</h1>
                                    <h3>{{$ev->name}}</h3>
                                </div>
                            </div>
                        </div>

                     @endforeach
                      
                    </div>
                </div>
            </div>
        </div>
        <div class="co_product appliance-product pt_01">
            <div class="container">
                <div class="bg-white">
                    <div class="head-product">
                        <h1 class="product-title">Appliance</h1>
                        <a href="cloth-product.html">view all</a>
                    </div>
                    <div class="app_slider p-slider">

                     @foreach($app_data as $ad)
                        <div>
                            <div class="product-main">
                                <div class="product-img">
                                    @foreach($product_image as $pi)

                                       @if($ad->id==$pi->product_id)

                                        <a href="product.html"><img src="uploads/{{$pi->file}}"></a>
                                        @break

                                      @endif

                                    @endforeach
                                 </div>
                                <div class="product-details">
                                    <h1><i class="fal fa-rupee-sign"></i>{{$ad->price}}/ 1 Day</h1>
                                    <h3>{{$ad->name}}</h3>
                                </div>
                            </div>
                        </div>

                     @endforeach
                      
                       
                    </div>
                </div>
            </div>
        </div>
        <div class="co_product vehicle-product pt_01">
            <div class="container">
                <div class="bg-white">
                    <div class="head-product">
                        <h1 class="product-title">vehicle</h1>
                        <a href="cloth-product.html">view all</a>
                    </div>
                    <div class="vehicle_slider p-slider">

                       @foreach($vehicle_data as $vd)
                          <div>
                            <div class="product-main">
                                <div class="product-img">
                                    @foreach($product_image as $pi)

                                       @if($vd->id==$pi->product_id)

                                        <a href="product.html"><img src="uploads/{{$pi->file}}"></a>
                                        @break

                                      @endif

                                    @endforeach
                                 </div>
                                <div class="product-details">
                                    <h1><i class="fal fa-rupee-sign"></i>{{$vd->price}}/ 1 Day</h1>
                                    <h3>{{$vd->name}}</h3>
                                </div>
                            </div>
                         </div>

                     @endforeach
                       
                    </div>
                </div>
            </div>
        </div>
        <div class="co_product construction-product pb_01 pt_01">
            <div class="container">
                <div class="bg-white">
                    <div class="head-product">
                        <h1 class="product-title">Construction</h1>
                        <a href="cloth-product.html">view all</a>
                    </div>
                    <div class="construction_slider p-slider">


                        @foreach($const_data as $const)
                          <div>
                            <div class="product-main">
                                <div class="product-img">
                                    @foreach($product_image as $pi)

                                       @if($const->id==$pi->product_id)

                                        <a href="product.html"><img src="uploads/{{$pi->file}}"></a>
                                        @break

                                      @endif

                                    @endforeach
                                 </div>
                                <div class="product-details">
                                    <h1><i class="fal fa-rupee-sign"></i>{{$const->price}}/ 1 Day</h1>
                                    <h3>{{$const->name}}</h3>
                                </div>
                            </div>
                         </div>

                     @endforeach
                     
                    </div>
                </div>
            </div>
        </div> -->
      </div>

@endsection