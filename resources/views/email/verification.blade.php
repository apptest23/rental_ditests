<!doctype html>
<html lang="en-US">

<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <title> </title>
    <meta name="description" content="New Account Email Template.">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <style type="text/css">
        a:hover {text-decoration: underline !important;}
    </style>
</head>
<style type="text/css">
img{
    position: absolute;
    top: 107px;
    left: 50%;
    transform: translateX(-50%);
}
</style>
<body marginheight="0" topmargin="0" marginwidth="0" style="margin: 0px; background-color: #f2f3f8;" leftmargin="0">
    <!-- 100% body table -->
    <table cellspacing="0" border="0" cellpadding="0" width="100%" bgcolor="#f2f3f8"
       >
        <tr>
            <td>
                <table style="background-color: #f2f3f8; max-width:670px; margin:0 auto;" width="100%" border="0"
                    align="center" cellpadding="0" cellspacing="0">
                    <tr>
                        <td style="height:80px;">&nbsp;</td>
                    </tr>
                    <tr>
                        <td style="text-align:center;">
                        </td>
                    </tr>
                    <tr>
                        <td style="height:20px;">&nbsp;</td>
                    </tr>
                    <tr>
                        <td>
                            <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0"
                                style="max-width:670px; background:#fff; border-radius:3px; text-align:center;-webkit-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);-moz-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);box-shadow:0 6px 18px 0 rgba(0,0,0,.06);">
                                <tr>
                                    <td style="height:40px;">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td style="padding:0px 35px 0px;">
                                        <div class="icon">
                                            <i style="font-size: 60px; color: #0c0c0c;" class="fas fa-envelope-open-text"></i>
                                        </div>

                                        <h1 style="color:#df453e; font-weight:500; margin:0;font-size:35px;padding-bottom: 10px; padding-top: 10px; font-family:'Rubik',sans-serif;"><b>Verification of account</b>
                                        </h1>

                                        <h1 style="color:#1e1e2d; font-weight:500; margin:0;font-size:17px;line-height: 1.5; margin-top:10px;font-family:'Rubik',sans-serif;">Hello , I am {{$name1}} from {{$address}}. I want to become a partner of RENTAL. 
                                        </h1>
                                     
                                        <div class="account_btn">
                                            <button style="margin:40px 0;padding: 13px 45px;background-color: #0263f6;border: none;border-radius: 7px;"><a href="{{url('admin/home')}}/{{$id}}" style="font-size: 20px; color:white;text-decoration: none;">verify account</a></button>
                                         <h5 style="font-size:17px">Details For Contact :</h5>

                                         <h3 style="font-size: 15px">Email:<a href="email:{{$email1}}">{{$email1}}</a></h3>
                                         <h3 style="font-size: 15px">Mobile No:<a href="tel:{{$phone_no}}">{{$phone_no}}</a></h3>


                                         <h5 style="font-size:17px">Our Product For Rent:</h5>


                                                @foreach($products_name as $bill)
                                                   <p>{{$bill->name}} </p>
                                                @endforeach
                                         

                                          

                                          </div>
                                        <div>

                                            
                                            


                                        </div>


                                      <!--   <p style="font-size:15px">* token will expire in 10 minits</p>
                                        <p style="padding-bottom: 36px;font-size: 15px;width: 75%;margin: 0 auto;line-height: 1.5;">If you did not forgot your password you can safely ignore this email.</p> -->
                                      <!--   <span style="font-size: 15px;">Need more help?</span><br>
                                        <a href=""
                                             style="text-decoration:none !important; display:inline-block; font-weight:500;color:#df453e; font-size:14px;"><b> we are here, ready to talk </b>
                                        </a> -->
                                    </td>
                                </tr>
                                <tr>
                                    <td style="height:40px;">&nbsp;</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style="height:20px;">&nbsp;</td>
                    </tr>
                    <tr>
                        
                    </tr>
                    <tr>
                        <td style="height:80px;">&nbsp;</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <!--/100% body table-->
</body>

</html>