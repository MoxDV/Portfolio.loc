<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width"/>

    <style type="text/css">

        * {
            margin: 0;
            padding: 0;
            font-size: 100%;
            font-family: 'Avenir Next', "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
            line-height: 1.65; }

        img {
            max-width: 100%;
            margin: 0 auto;
            display: block; }

        body,
        .body-wrap {
            width: 100% !important;
            height: 100%;
            background: #efefef;
            -webkit-font-smoothing: antialiased;
            -webkit-text-size-adjust: none; }

        a {
            color: #3b3b3b;
            text-decoration: none; }

        .text-center {
            text-align: center; }

        .text-right {
            text-align: right; }

        .text-left {
            text-align: left; }

        .button {
            display: inline-block;
            color: white;
            background: #3b3b3b;
            border: solid #3b3b3b;
            border-width: 10px 20px 8px;
            font-weight: bold;
            border-radius: 4px; }

        h1, h2, h3, h4, h5, h6 {
            margin-bottom: 20px;
            line-height: 1.25; }

        h1 {
            font-size: 32px; }

        h2 {
            font-size: 28px; }

        h3 {
            font-size: 24px; }

        h4 {
            font-size: 20px; }

        h5 {
            font-size: 16px; }

        p, ul, ol {
            font-size: 16px;
            font-weight: normal;
            margin-bottom: 20px; }

        .container {
            display: block !important;
            clear: both !important;
            margin: 0 auto !important;
            max-width: 580px !important; }
        .container table {
            width: 100% !important;
            border-collapse: collapse; }
        .container .masthead {
            padding: 80px 0;
            background: #3b3b3b;
            color: white; }
        .container .masthead h1 {
            margin: 0 auto !important;
            max-width: 90%;
            text-transform: uppercase; }
        .container .content {
            background: white;
            padding: 30px 35px; }
        .container .content.footer {
            background: none; }
        .container .content.footer p {
            margin-bottom: 0;
            color: #888;
            text-align: center;
            font-size: 14px; }
        .container .content.footer a {
            color: #888;
            text-decoration: none;
            font-weight: bold; }


    </style>
</head>
<body>
<table class="body-wrap">
    <tr>
        <td class="container">

            <!-- Message start -->
            <table>
                <tr>
                    <td align="center" class="masthead">

                        <h1>{{ config('site.name') }}</h1>

                    </td>
                </tr>
                <tr>
                    <td class="content">

                        <h2>Здраствуйте{{ isset($name) ? ' '.$name : '' }},</h2>

                        <p>{!! $text_first !!}</p>

                        @if(isset($link) && isset($text_button))
                            <table>
                                <tr>
                                    <td align="center">
                                        <p>
                                            <a href="{{ $link }}" class="button">
                                                {{ $text_button }}
                                            </a>
                                        </p>
                                    </td>
                                </tr>
                            </table>
                        @endif

                        @if(isset($text_last))
                            <p>{!! $text_last !!}</p>
                        @endif

                        <p><em>– {{ env('MAIL_FROM_NAME', 'Администратор') }}</em></p>

                    </td>
                </tr>
            </table>

        </td>
    </tr>
    <tr>
        <td class="container">

            <!-- Message start -->
            <table>
                <tr>
                    <td class="content footer" align="center">
                        <p>Отправлено от  <a href="{{ route('home') }}">
                                {{ config('site.name') }}</a>,
                            {{--@foreach($data['address'] as $key => $address)
                                @if($address)
                                    {{ $address }},
                                @endif
                            @endforeach
                            @if(isset( $data['phone']))
                                <br />
                                телефон: {{ $data['phone'] }}
                            @endif--}}
                        </p>
                        <p>
                            <a href="mailto:">{{ env('EMAIL_MODER') }}</a>
                            @if(isset($unsubscribe) && $unsubscribe !== null)
                                | <a href="{{ $unsubscribe }}">
                                    Отказаться от подписки
                                </a>
                            @endif
                        </p>
                    </td>
                </tr>
            </table>

        </td>
    </tr>
</table>
</body>
</html>