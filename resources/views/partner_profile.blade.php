@extends('layouts.app')

@section('content')

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


    <style type="text/css">
.profile img {
    width: 100px;
    height:120px;
    border-radius: 10px;
    object-fit: cover;
}
.profile {
    padding-bottom: 10px;
    text-align: center;
}
.profile_main {
    padding:50px;
}
.item img{
    width: 100%;
}
.sub_profile{
    border-radius: 10px;
    box-shadow: 0 2px 4px 0 rgb(0 0 0 / 30%);
}
.vender-profile{
    padding:100px 0;
}
.vender_img {
    padding: 50px 0;
}
.item {
    padding-bottom: 31px;
}
.details {
    text-align: center;
}
.con_vender:before {
    position: absolute;
    content: " ";
    width: 92%;
    height: 1px;
    background-color: #1d21245c;
    left: 15px;
    top: 257px;
}
.v_pro {
    padding: 20px;
}
.de_head:before {
    position: absolute;
    content: " ";
    width: 100%;
    height: 1px;
    background-color: #1d21245c;
    left: -16px;
    top: 68px;
}
.con_vender h3 {
    font-size: 21px;
    font-weight: 600;
    padding: 20px 0;
}
.e_address h6 {
    font-size: 17px;
    font-weight: 600;
}
.e_address p {
    font-size: 15px;
    color: #00000075;
}
.v_pro:before {
    position: absolute;
    content: " ";
    top: 0;
    left: -16px;
    height: 100%;
    border: 0.1px solid #1d212429;
}
 
.pagination{
     width:100%;
     border-radius:0px;
    justify-content: flex-end;
    padding-right: 20px;
   }
  
.even li {
    padding: 3px 10px;
    border-radius: 17px;
    margin: 3px;
}
.pagination a{
    color: #1b3e41;
 } 
 .active_1{
    color:white;
    background-color: #df453e;
    border:1px solid  #df453e;
 }
 .active_1 a{
    color:white;
 }
 .even li: hover{
    background-color:#df453e;
 }
 .de_head h3 {
    color: #df453e;
    font-weight: 700;
}

</style>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
    <script type="text/javascript">
        $('.pagination-responsive').each(function() {

        var listItems = $(this).children();
  
        if (listItems.length%2 == 0){
            $(this).addClass('even');
        } else{
            $(this).addClass('odd');
        }
  
});
    </script>






 @endsection