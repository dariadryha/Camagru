<?php
/**
 * @var string $link
 */
return <<<HTML
    <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse;">
        <tr>
            <td>
                <p>We got a request to reset your Camagru password.</p>
            </td>
        </tr>
        <tr>
            <td>
                <a href="$link" style="color: #ffffff;text-decoration:none;display:block">
                    <table width="100%" border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse;">
                        <tbody>
                        <tr>
                            <td bgcolor="#47a2ea" align="center" style="border-radius:3px;padding: 10px 16px 14px 16px">
                                <a href="$link" style="color: #ffffff;text-decoration:none;display:block"><span style="font-family:Helvetica Neue,Helvetica,Roboto,Arial,sans-serif;font-weight: bold">Reset password</span></a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </a>
            </td>
        </tr>
        <tr>
            <td>
                <p>If you ignore this message, your password will not be changed.</p>
            </td>
        </tr>
    </table>
HTML;
