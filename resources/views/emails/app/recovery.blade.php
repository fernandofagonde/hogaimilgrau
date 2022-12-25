<!DOCTYPE html>
<html>
<head>
 <title>{{ $mailData['title'] }}</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
    body {
        font-family: 'Poppins', 'Arial';
        font-size: 16px;
        color: #333;
    }

    #message-wrapper {
        background-color: #eee;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 3rem;
    }

    #message-box {
        padding: 0;
        background-color: #fff;
        border-radius: 1rem;
        box-shadow: 0 3px 10px 0 rgba(0,0,0,.2);
        margin: 0 auto;
    }

    #message-logo {
        margin-bottom: 2rem;
        text-align: center;
        margin: 0 auto;

    }

    #message-header {
        font-size: 2rem;
        color: #fff;
        background-color: #06d6a0;
        padding: 1rem 2rem;
        border-top-left-radius: 1rem;
        border-top-right-radius: 1rem;
    }

    #message-body {
        line-height: 1.8;
        padding: 2rem 3rem;
        font-size: 16px;
    }

    #message-footer {
        padding: 1rem 3rem;
        margin-top: 0;
        border-top: 1px solid #eee;

        text-align: center;
        color: #333;
        font-size: 16px;
    }

</style>
</head>
<body>
    <div id="message-wrapper">

        <div id="message-logo"><img src="/#" title="{{ config('app.name') }}" alt="{{ config('app.name') }}">
        <div id="message-box">
            <h1 id="message-header">{{ $mailData['title'] }}</h1>
            <div id="message-body">@php echo $mailData['body']; @endphp</div>
            <div id="message-footer">{{ config('app.name') }}<br>{{ config('app.url') }}</div>
        </div>

    </div>
</body>
</html>
