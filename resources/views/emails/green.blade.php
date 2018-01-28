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
                    <div style="float: left;">
                        <img src="{{ asset('images/logo.png') }}" alt="logo">
                    </div>
                    <div style="float: right;">
                        <a href="{{ $settings['website_url'] }}" target="_blank">Visit Website</a>
                    </div>
                    <div style="clear:both;"></div>
                </div><hr/>
                <div class="body">
                    <?php echo htmlspecialchars_decode($content); ?>
                    <hr/>
                    <center>
                        <p style="color:grey;font-size:11px;"><em><strong>{{ $settings['signature'] }}</strong></em></p>
                    </center>
                </div>
                <div class="bottom">
                    <center>
                        <a href="{{ $settings['facebook'] }}" target="_blank"><img src="{{ asset('images/facebook.png') }}" height="50" width="50"></a>
                        <a href="{{ $settings['twitter'] }}" target="_blank"><img src="{{ asset('images/twitter.png') }}" height="50" width="50"></a>
                        <a href="{{ $settings['youtube'] }}" target="_blank"><img src="{{ asset('images/youtube.png') }}" height="50" width="50"></a>
                        <a href="{{ $settings['youtube'] }}" target="_blank"><img src="{{ asset('images/googleplus.png') }}" height="50" width="50"></a>
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