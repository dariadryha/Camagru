<?php
/** @var string $body
 * @var string $username
 * @var string $email
 * @var string $link
 */
return <<<HTML
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>
    <body style="margin: 0; padding: 0;">
        <table border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr>
                <td style="font-family:Helvetica Neue,Helvetica,Lucida Grande,tahoma,verdana,arial,sans-serif;color:#565a5c; font-size: 18px">
                    <table align="center" border="0" cellpadding="0" cellspacing="0" width="430" style="border-collapse: collapse;">
                        <tr>
                            <td align="center">
                                <p>ﾍ(=￣∇￣)ﾉ Hi <span style="font-weight: bold">$username</span> ! ﾍ(=￣∇￣)ﾉ</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                $body
                            </td>
                        </tr>
                        <tr>
                            <td style="font-size: 10px">
                                <p> © Camagru. This message was sent to <a style="font-weight:bold;color:#565a5c;text-decoration:none">$email</a> and intended for <span style="font-weight: bold">$username</span>. </p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </body>
</html>
HTML;
