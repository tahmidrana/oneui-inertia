<!doctype html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="x-apple-disable-message-reformatting" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="color-scheme" content="light dark" />
    <meta name="supported-color-schemes" content="light dark" />
    <title>Service Bill | PHWC</title>
    <style type="text/css" rel="stylesheet" media="all">
        @import url("https://fonts.googleapis.com/css?family=Nunito+Sans:400,700&display=swap");

        body {
            width: 100% !important;
            height: 100%;
            margin: 0;
            -webkit-text-size-adjust: none;
        }

        a {
            color: #3869D4;
        }
        td {
            word-break: break-word;
        }

        /* Type ------------------------------ */

        body,
        td,
        th {
            font-family: "Nunito Sans", Helvetica, Arial, sans-serif;
        }

        h1 {
            margin-top: 0;
            color: #333333;
            font-size: 22px;
            font-weight: bold;
            text-align: left;
        }

        h2 {
            margin-top: 0;
            color: #333333;
            font-size: 16px;
            font-weight: bold;
            text-align: left;
        }

        h3 {
            margin-top: 0;
            color: #333333;
            font-size: 14px;
            font-weight: bold;
            text-align: left;
        }

        p,
        ul,
        ol,
        blockquote {
            margin: .4em 0 1.1875em;
            font-size: 16px;
            line-height: 1.625;
        }
        body {
            background-color: #F4F4F7;
            color: #51545E;
        }

        p {
            color: #51545E;
        }

        .email-body {
            width: 100%;
            margin: 0;
            padding: 10px;
            background-color: #FFFFFF;
        }
    </style>
</head>

<body>
    <div class="email-body">
        <h1>Dear Client,</h1>
        <p class="preheader" style="margin-bottom: 2px;">Thank you for staying with Psychological Health and Wellness Clinic.</p>
        <p style="margin-bottom: 2px;">Kindly find attached your service bill copy between <?= date('d M Y', strtotime($from_date)) ?> and
            <?= date('d M Y', strtotime($to_date)) ?>.</p>
        <p>If you have any query, call +8809609013000 or send mail to reception@phwcbd.org</p>

        <p style="margin-bottom: 1px;">Best Regards,</p>
        <p>Psychological Health and Wellness Clinic</p>
    </div>
</body>

</html>
