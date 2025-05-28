<!DOCTYPE html>
<html>
<head>
    <title>New Lead Assigned</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f5f5f5; padding: 30px;">
    <table width="100%" cellpadding="0" cellspacing="0" style="max-width: 600px; margin: 0 auto; background-color: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
        <tr style="background-color: #4a90e2; color: #ffffff;">
            <td style="padding: 20px;">
                <h2 style="margin: 0;">New Lead Assigned</h2>
            </td>
        </tr>
        <tr>
            <td style="padding: 30px;">
                <p style="font-size: 16px;">Hello <strong>{{ $lead->assignedTo->name ?? 'Agent' }}</strong>,</p>
                <p style="font-size: 16px;">A new lead has been assigned to you. Please find the details below:</p>

                <table cellpadding="5" cellspacing="0" style="margin: 20px 0; width: 100%; font-size: 15px;">
                    <tr>
                        <td style="width: 120px;"><strong>Name:</strong></td>
                        <td>{{ $lead->name }}</td>
                    </tr>
                    <tr>
                        <td><strong>Email:</strong></td>
                        <td>{{ $lead->email }}</td>
                    </tr>
                    <tr>
                        <td><strong>Phone:</strong></td>
                        <td>{{ $lead->phone }}</td>
                    </tr>
                </table>

                <p style="text-align: center;">
                    <p style="text-align: center;">
                        <a href="{{ config('app.url') . '/leads/' . $lead->id }}" style="display: inline-block; background-color: #4a90e2; color: #ffffff; padding: 10px 20px; text-decoration: none; border-radius: 5px;">View Lead</a>
                    </p>

                </p>

                <p style="font-size: 14px; color: #777;">Thank you,<br>{{ config('app.name') }}</p>
            </td>
        </tr>
    </table>
</body>
</html>
