<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
<style>
.btn-primary:hover, .btn-primary:focus, .btn-primary:active {
    background: transparent;
    color: #7ea1ea;
    border-color: #7ea1ea;
    box-shadow: none !important;
}
.btn-primary, .btn-inverse {
    cursor: pointer;
    display: inline-block;
    text-align: center;
    color: #fff;
    background-color: #7ea1ea;
    border: 1px solid #7ea1ea;
    padding: 10px 25px;
    text-transform: uppercase;
    box-sizing: border-box;
    border-radius: 100px;
    transition: all 0.2s ease-out;
    /* font-size: 12px; */
    font-size: 10px;
    font-weight: 600;
    letter-spacing: 0.3px;
    font-family: 'Raleway', sans-serif;
    min-width: 110px;
        text-decoration:none;
}
</style>
</head>

<body>
<table cellpadding="0" cellspacing="0" border="0" style="border-collapse: collapse;" width="100%">
    <tr>
        <td style="border-bottom: 1px solid #7EA1EA;">
            <table cellspacing="0" cellpadding="0" style="margin: 0 auto" border="0" width="1200px">
                <tr>
                    <td style="padding-top: 10px;padding-bottom: 10px;">
                        <table width="100%">
                            <tr>
                                <td>
                                    <a href="{{\URL::to('/')}}">
                                        <img src="http://45.77.159.83/images/diamond_logo.png" alt="Logo" title="Logo">
                                    </a>
                                </td>
                                <td align="right">
                                    <ul style="margin: 0;padding: 0;">
                                        <li style="display: inline-block;padding: 10px;">
                                            <a style="text-decoration: none;color: #bac1ca;letter-spacing: 0.2px;font-size: 14px;font-family: sans-serif;" href="{{\URL::to('/')}}">Home</a>
                                        </li>
                                        <li style="display: inline-block;padding: 10px;">
                                            <a style="text-decoration: none;color: #bac1ca;letter-spacing: 0.2px;font-size: 14px;font-family: sans-serif;" href="{{URL::to('/about-us')}}">About Us</a>
                                        </li>
                                        <li style="display: inline-block;padding: 10px;">
                                            <a style="text-decoration: none;color: #bac1ca;letter-spacing: 0.2px;font-size: 14px;font-family: sans-serif;" href="{{URL::to('/traceability')}}">Traceability Program</a>
                                        </li>
                                        <li style="display: inline-block;padding: 10px 0 10px 10px;">
                                            <a style="text-decoration: none;color: #bac1ca;letter-spacing: 0.2px;font-size: 14px;font-family: sans-serif;" href="{{URL::to('/producers')}}">Producers</a>
                                        </li>

                                    </ul>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr><td style="padding-top: 10px;padding-bottom: 10px;"></td></tr>
    <tr>

        
        <td style="padding-top: 10px;padding-bottom: 10px;">
                                <table width="60%" style="margin:0  auto;  border-collapse: collapse;">
                                        <tr>
                                        <td style="color: #242424; padding:10px; background :#f8f8f8; letter-spacing: 0.2px;font-size: 26px;font-family: sans-serif;text-align:center">Contact Us</td>
                                       </tr>
                                        <tr>
                                        <td style="color: #242424; padding:10px 20px; background :#f8f8f8; letter-spacing: 0.2px;font-size: 16px;font-family: sans-serif;">{{$dataArr['full_name']}}, Contact To Diamondtrail.</td>
                                       </tr>
                                       <tr>
                                       <td style="color: #242424; padding:10px 20px; background:#f8f8f8; letter-spacing: 0.2px;font-size: 16px;font-family: sans-serif;">
                                           Here are contact detail.
                                       </td>
                                       </tr>
                                       <tr>
                                       <td style="color: #242424; padding:10px 20px; background :#f8f8f8; letter-spacing: 0.2px;font-size: 16px;font-family: sans-serif;">

                                       <table>
                                       <tr>
                                       <td >Company Name : </td><td>{{$dataArr['company_name']}}</td>
                                       </tr>
                                       <tr>
                                       <td >Person Name : </td><td>{{$dataArr['full_name']}}</td>
                                       </tr>
                                       <tr>
                                       <td >Email : </td><td>{{$dataArr['email']}}</td>
                                       </tr>
                                       <tr>
                                       <td >Subject : </td><td>{{$dataArr['subject']}}</td>
                                       </tr>
                                       <tr>
                                       <td >Message : </td><td>{{$dataArr['message']}}</td>
                                       </tr>
                                       </table>

                                         </td>
                                       </tr> 
                                       <tr>
                                       
                                       <td style="color: #242424; padding:10px; background :#f8f8f8; letter-spacing: 0.2px;font-size: 16px;font-family: sans-serif;"></td>
                                        </tr>
                                </table>
                            </td>


                
    </tr>
<tr><td style="padding-top: 10px;padding-bottom: 10px;"></td></tr>
    <tr>
        <td>
            <table cellspacing="0" cellpadding="0" style="margin: 0 auto" border="0" width="1200px">
                <tr>
                    <td style="padding-left: 60px; padding-right: 60px;padding-top: 20px;padding-bottom: 20px;">
                        <table width="100%">
                            <tr>
                                <td>
                                    <ul style="margin: 0;padding: 0;">
                                        <li style="display: inline-block;border-right: 1px solid #000;padding-right: 10px;line-height: 15px;margin-right: 15px;">
                                            <a style="text-decoration: none;color: #738797;line-height: normal;font-size: 12px;font-family: sans-serif;" href="{{URL::to('/about-us')}}">About Us</a>
                                        </li>
                                        <li style="display: inline-block;border-right: 1px solid #000;padding-right: 10px;line-height: 15px;margin-right: 15px;">
                                            <a style="text-decoration: none;color: #738797;line-height: normal;font-size: 12px;font-family: sans-serif;" href="{{URL::to('/contact-us')">Contact Us</a>
                                        </li>
                                        <li style="display: inline-block;border-right: 1px solid #000;padding-right: 10px;line-height: 15px;margin-right: 15px;">
                                            <a style="text-decoration: none;color: #738797;line-height: normal;font-size: 12px;font-family: sans-serif;" href="#">Privacy Policy</a>
                                        </li>
                                        <li style="display: inline-block;border-right: 1px solid #000;padding-right: 10px;line-height: 15px;margin-right: 15px;">
                                            <a style="text-decoration: none;color: #738797;line-height: normal;font-size: 12px;font-family: sans-serif;" href="#">Terms & Conditions</a>
                                        </li>
                                    </ul>
                                </td>
                                <td align="right">
                                    <p style="color: #738797;font-size: 13px;font-family: sans-serif;line-height: 1.39; margin: 0">
                                    &copy; 2017-2018 Bonas Group. All Rights Reserved
                                    </p>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html>
 <br>
<br>