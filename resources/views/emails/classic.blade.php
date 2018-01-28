<html>
    <head>
        <style>
            body {
                background-color: #c6c6ca;
                margin: 0;
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            }

            .container {
                margin-left: 20%;
                margin-right: 20%;
            }

            .inner {
                background-color: white;
            }

            .inner .header {
                padding-left: 20px;
                padding-top: 10px;
                padding-bottom: 10px;
                background-color: white;
            }

            .inner .header a {
                padding: 10px;
                color: blue;
                text-decoration: none;
                border-radius: 10px;
                margin-top: 20px;
                margin-right: 20px;
            }

            .inner .body {
                padding: 30px;
            }

            .inner .body p {
                font-size: 16px;
            }

            .inner .bottom {
                background-color: #90F392;
                padding-left: 20px;
                padding-top: 15px;
                color: white;
            }

            .inner .bottom a {
                padding: 5px;
                margin-right:20px;
            }

            .inner .footer {
                background-color: #6FC271;
                padding: 5px;
                border-bottom-right-radius: 5px;
                border-bottom-left-radius: 5px;
                font-size: 12px;
                border-bottom: 10px solid green ;
                color:white;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="inner">
                <div class="header">
                    <center><img src="{{ asset('images/22-1.png') }}" height="50" width="200"></center>
                </div>
                <div class="body">
                    <?php echo htmlspecialchars_decode($content); ?>
                    <p style="color:grey;font-size:11px;"><em><strong>{{ $settings['signature'] }}</strong></em></p>
                </div>
                <div class="bottom">
                    <center>
                        <a href="{{ $settings['facebook'] }}" target="_blank"><img src="{{ asset('images/facebook.png') }}" height="30" width="30"></a>
                        <a href="{{ $settings['twitter'] }}" target="_blank"><img src="{{ asset('images/twitter.png') }}" height="30" width="30"></a>
                        <a href="{{ $settings['youtube'] }}" target="_blank"><img src="{{ asset('images/youtube.png') }}" height="30" width="30"></a>
                    </center>
                </div>
                <div class="footer">
                    <center>
                        <p>&copy; 2017 {{ $settings['company_name'] }}. All Rights Reserved.</p>
                    </center>
                </div>
            </div>
        </div>
    </body>
</html>