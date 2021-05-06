<html>
    <head>
        <style>
            html,
            body {
                height: 100vh;
                background-image: url({{ $file ? "uploads/".$file : "img/banner-1.png" }});
                background-size:  100%;
                background-repeat: no-repeat;
            }
            h3{
                display: block;
                font-size: 90px;
                text-align: center;
                margin-top: 200px;
                margin-bottom: 0;
                width: 100%;
            }
            p {
                display: block;
                font-size: 40px;
                text-align: center;
                width: 100%;
                padding: 0 15%
            }
        </style>
    </head>
    <body>
        <h3>{{ $title ?? '' }}</h3>
        <p>{{ $details ?? '' }}</p>
    </body>
</html>
