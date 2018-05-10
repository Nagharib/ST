<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <style type="text/css">
        body {margin: 0; padding: 0; min-width: 100%!important;}
        .content {width: 100%; max-width: 600px;}  
        </style>
    </head>
    <body yahoo bgcolor="#f6f8f1">
        <table width="100%" bgcolor="#f6f8f1" border="0" cellpadding="0" cellspacing="0">
            <tr>
                <td>
                    <table class="content" align="center" cellpadding="0" cellspacing="0" border="0">
                        <tr>
                            <td>
                                <h2>Pemesanan dari <b>{{ $name }}</b></h2>
                            </td>
                        </tr>
                        <tr><td>Nomor Whatsapp</td><td>{{ $Whatsapp }}</td></tr>
                        <tr><td>Email</td><td>{{ $email }}</td></tr>
                        <tr><td>Hotel</td><td>{{ $hotel_name }}</td></tr>
                        <tr><td>Kamar</td><td>{{ $room_name }}</td></tr>
                        <tr><td>Malam</td><td>{{ $duration }}</td></tr>
                        <tr><td>Check-In</td><td>{{ $checkindate }}</td></tr>
                        <tr><td>Check-Out</td><td>{{ $checkoutdate }}</td></tr>
                        <tr><td>Jumlah Kamar</td><td>{{ $jumlah_kamar }}</td></tr>
                        <tr><td>Total Harga</td><td>{{ $harga }}</td></tr>
                    </table>
                </td>
            </tr>
        </table>
    </body>
</html>