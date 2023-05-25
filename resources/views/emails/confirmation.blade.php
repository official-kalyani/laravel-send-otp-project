<html>
    <head>
        <title></title>
    </head>
    <body>
        <table>
            <tr>
                <td>Dear {{$name}},</td>
            </tr>
            <tr>
                <td>Assalamu Alaikum, Thank You For Register in Our Website. Now, Please Click On "Confirmation Link" For Activate Your Account : </td>
            </tr>
            <tr>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><a class="btn btn-primary" style="color: #6f42c1" href="{{url('confirm/'.$code) }}">Confirmation Link</a></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>Thank You & Regards,</td>
            </tr>
            <tr>
                <td>team E-Commerce</td>
            </tr>
        </table>
    </body>
</html>