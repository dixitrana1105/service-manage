<!-- resources/views/emails/broadcast-details.blade.php -->

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>{{ $broadcast->title }}</title>
</head>

<body style="font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 20px; color: #333;">

    <table width="100%" cellpadding="0" cellspacing="0"
        style="max-width: 600px; margin: auto; background-color: #fff; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
        <tr>
            <td
                style="background-color: #007bff; color: white; padding: 20px; text-align: center; border-top-left-radius: 8px; border-top-right-radius: 8px;">
                <h1 style="margin: 0; font-size: 24px;">📢 Broadcast Notification</h1>
            </td>
        </tr>
        <tr>
            <td style="padding: 30px;">
                <h2 style="margin-top: 0;">{{ $broadcast->title }}</h2>
                <p style="font-size: 16px; line-height: 1.5;">{!! $broadcast->message !!}</p>
                <hr style="margin: 30px 0;">
                <p style="font-size: 14px; color: #777;">Best regards,<br>Your Company</p>
            </td>
        </tr>
    </table>

</body>

</html>