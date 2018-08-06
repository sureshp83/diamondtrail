<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>

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
                                        <img src="{{public_path('images/diamond_logo.png')}}" alt="Logo" title="Logo">
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
    <tr>
        <td>
            <table cellpadding="0" cellspacing="0" style="border-collapse: collapse;" border="0" width="100%">
                <tr>
                    <td>
                        <table cellspacing="0" cellpadding="0" align="center" width="100%">
                            <tr><td height="40px"></td></tr>
                            <tr>
                                <td align="center" valign="center">
                                    <ul style="padding: 0; margin: 0;">

                                        @foreach($diamond['diamond_all_image'][0] as $key => $img)

                                            <li style="display: inline-block; border: 1px solid #eee; margin: 5px;">
                                                <img src="{{public_path('uploads/diamond_img')}}/{{$img->name}}" alt="Diamond" title="Diamond" style="max-width: 141px;max-height: 120px;">
                                            </li>
                                        @endforeach
                                    </ul>
                                </td>
                            </tr>
                            <!-- <tr><td height="30px"></td></tr> -->
                            <tr>
                                <td align="center">
                                    <table width="500px" cellpadding="0" cellspacing="0" style="border:1px solid #ddd;">
                                        <tbody>
                                        <tr style="background-color: #e7ecef;">
                                            <td style="font-size: 12px; font-weight: bold; color: #304151; font-family: sans-serif; padding: 8px;">Date Posted</td>
                                            <td align="right" style="font-size: 12px; font-weight: normal; color: #738797; font-family: sans-serif; padding: 8px;">{{$diamond['created_at'][0]}}</td>
                                        </tr>
                                        <tr>
                                            <td style="font-size: 12px; font-weight: bold; color: #304151; font-family: sans-serif; padding: 8px;">ID</td>
                                            <td align="right" style="font-size: 12px; font-weight: normal; color: #738797; font-family: sans-serif; padding: 8px;">{{$diamond['id'][0]}}</td>
                                        </tr>
                                        <tr style="background-color: #e7ecef;">
                                            <td style="font-size: 12px; font-weight: bold; color: #304151; font-family: sans-serif; padding: 8px;">Carat</td>
                                            <td align="right" style="font-size: 12px; font-weight: normal; color: #738797; font-family: sans-serif; padding: 8px;">{{$diamond['carat'][0]}}</td>
                                        </tr>
                                        <tr>
                                            <td style="font-size: 12px; font-weight: bold; color: #304151; font-family: sans-serif; padding: 8px;">Clarity</td>
                                            <td align="right" style="font-size: 12px; font-weight: normal; color: #738797; font-family: sans-serif; padding: 8px;">{{$diamond['clarity_label'][0]}}</td>
                                        </tr>
                                        <tr style="background-color: #e7ecef;">
                                            <td style="font-size: 12px; font-weight: bold; color: #304151; font-family: sans-serif; padding: 8px;">Colour</td>
                                            <td align="right" style="font-size: 12px; font-weight: normal; color: #738797; font-family: sans-serif; padding: 8px;">{{$diamond['color_label'][0]}}</td>
                                        </tr>
                                        <tr>
                                            <td style="font-size: 12px; font-weight: bold; color: #304151; font-family: sans-serif; padding: 8px;">Cut</td>
                                            <td align="right" style="font-size: 12px; font-weight: normal; color: #738797; font-family: sans-serif; padding: 8px;">{{$diamond['cut_label'][0]}}</td>
                                        </tr>
                                        <tr style="background-color: #e7ecef;">
                                            <td style="font-size: 12px; font-weight: bold; color: #304151; font-family: sans-serif; padding: 8px;">Fluoresence</td>
                                            <td align="right" style="font-size: 12px; font-weight: normal; color: #738797; font-family: sans-serif; padding: 8px;">{{$diamond['florescence_type_label'][0]}}</td>
                                        </tr>
                                        <tr>
                                            <td style="font-size: 12px; font-weight: bold; color: #304151; font-family: sans-serif; padding: 8px;">Brand</td>
                                            <td align="right" style="font-size: 12px; font-weight: normal; color: #738797; font-family: sans-serif; padding: 8px;">{{$diamond['brand_label'][0]}}</td>
                                        </tr>
                                        <tr style="background-color: #e7ecef;">
                                            <td style="font-size: 12px; font-weight: bold; color: #304151; font-family: sans-serif; padding: 8px;">Certification Laboratory</td>
                                            <td align="right" style="font-size: 12px; font-weight: normal; color: #738797; font-family: sans-serif; padding: 8px;">{{$diamond['certification_laboratory_label'][0]}}</td>
                                        </tr>
                                        <tr>
                                            <td style="font-size: 12px; font-weight: bold; color: #304151; font-family: sans-serif; padding: 8px;">Certificate Number</td>
                                            <td align="right" style="font-size: 12px; font-weight: normal; color: #738797; font-family: sans-serif; padding: 8px;">{{$diamond['certification_number'][0]}}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr><td height="40px"></td></tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td>
            <table cellspacing="0" cellpadding="0" style="margin: 0 auto" border="0" width="1200px">
                <tr>
                    <td style="padding-left: 60px; padding-right: 60px;padding-top: 20px;padding-bottom: 20px;">
                        <!-- <table width="100%">
                            <tr>
                                <td>
                                    <ul style="margin: 0;padding: 0;">
                                        <li style="display: inline-block;border-right: 1px solid #000;padding-right: 10px;line-height: 15px;margin-right: 15px;">
                                            <a style="text-decoration: none;color: #738797;line-height: normal;font-size: 12px;font-family: sans-serif;" href="http://dddemo.net/php/diamondtrail/public/about-us">About Us</a>
                                        </li>
                                        <li style="display: inline-block;border-right: 1px solid #000;padding-right: 10px;line-height: 15px;margin-right: 15px;">
                                            <a style="text-decoration: none;color: #738797;line-height: normal;font-size: 12px;font-family: sans-serif;" href="http://dddemo.net/php/diamondtrail/public/contact-us">Contact Us</a>
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
                        </table> -->
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html>