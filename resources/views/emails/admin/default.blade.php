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
        background-color: #073B4C;
        padding: 4rem 3rem;
        color: #fff;
        margin-bottom: 2rem;
    }

    #message-box {
        padding: 0;
        background-color: #fff;
        border-radius: 1rem;
        box-shadow: 0 3px 10px 0 rgba(0,0,0,.2);
        margin: 0 auto;
        max-width: 600px;
    }

    #message-logo {
        margin-bottom: 2rem;
        text-align: center;
        margin: 0 auto;

    }

    #message-header {
        font-size: 25px;
        color: #fff;
        background-color: #06d6a0;
        padding: 1rem 2rem;
        border-top-left-radius: 1rem;
        border-top-right-radius: 1rem;
    }

    #message-body {
        line-height: 1.8;
        padding: .5rem 3rem 2rem 3rem;
        font-size: 16px;
        color: #073B4C;
    }

    #message-body #client-name {
        font-size: 18px;
        font-weight: 700;
        color: #06d6a0;
    }

    #message-body #info-box {
        display:inline-block;
        padding: 1rem 2rem;
        border-radius: 1rem;
        background-color:#eee;
        font-size:16px;
        font-weight: 700;
        color: #fff;
        margin: 1.5rem 0;
    }

    #message-body #info-box ul {
        width: 100%;
        display: flex;
        flex-direction: column;
    }

    #message-body #info-box ul li {
        flex: 1;
        display: grid;
        grid-template-columns: 100px auto;
        gap: 1rem;
    }

    #message-body #info-box ul li strong {
        border-right: 1px solid #eee;
        padding-right: 1rem;
        color: #06d6a0;
    }

    #message-footer {
        padding: 1.5rem 3rem 1.5rem 3rem;
        border-top: 1px solid #eee;

        font-size: 13px;
        text-align: center;
        color: #999;
        font-size: 16px;
    }

    #message-footer a {
        color: #06d6a0;
        text-decoration: none;
    }

    #message-footer a:hover {
        text-decoration: underline;
    }

</style>
</head>
<body>
    <div id="message-wrapper">

        <div id="message-logo"><img src="/#" title="{{ config('app.name') }}" alt="{{ config('app.name') }}">
        <div id="message-box">
            <h1 id="message-header">{{ $mailData['title'] }}</h1>
            <div id="message-body">@php echo $mailData['body']; @endphp</div>
            <div id="message-footer">{{ config('app.name') }} ({{ config('app.url') }})</div>
        </div>

    </div>
</body>
</html>
