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
                border-top: 10px solid  #5499c7 ;
                border-bottom: 1px solid grey;
                border-top-left-radius: 5px;
                border-top-right-radius: 5px;
            }

            .inner .title {
                background-color: #f2f3f4;
                padding-left: 20px;
                padding-right: 20px;
                padding-top: 5px;
                padding-bottom: 5px;
            }

            .inner .title a {
                width: 100px;
                padding: 10px;
                color: white;
                text-decoration: none;
                background-color: #5499c7;
                border-radius: 10px;
                display: block;
                margin-top: 10px;
            }

            .inner .title p {
                color: #5499c7;
                margin-top:0px;
                font-size: 28px;
            }

            .inner .title span {
                color: grey;
                font-size: 10px;
            }

            .inner .body {
                padding: 20px;
                font-size: 13px;
            }

            .inner .body p {
                font-size: 14px;
            }

            .inner .bottom {
                background-color: #f2f3f4;
                padding-left: 20px;
                padding-top: 5px;
                padding-bottom: 5px;
                border-bottom: 1px solid grey;
                font-size: 13px;
            }

            .inner .bottom a {
                padding: 5px;
                margin-right:10px;
            }

            .inner .footer {
                background-color: white;
                padding: 5px;
                border-bottom-right-radius: 5px;
                border-bottom-left-radius: 5px;
                font-size: 12px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="inner">
                <div class="header">
                    <img src="{{ asset('images/22-1.png') }}" height="50" width="200">
                </div>
                <div class="title">
                    <div style="float: left;">
                        <span>News update from: </span>
                        <p>{{ $settings['company_name'] }}</p>
                    </div>
                    <div style="float: right;">
                        <a href="{{ $settings['website_url'] }}" target="_blank">Visit Website</a>
                    </div>
                    <div style="clear:both;"></div>
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