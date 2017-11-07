<html>
    <head>
        <style>
            body {
                background-color: #c6c6ca;
                margin: 0;
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
                padding-top: 5px;
                padding-bottom: 5px;
                font-size: 20px;
            }

            .inner .body {
                padding: 20px;
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
                    <div style="float: right;"></div>
                    <div style="clear:both;"></div>
                </div>
                <div class="body">
                    <?php echo htmlspecialchars_decode($content); ?>
                </div>
                <div class="bottom">
                    <center>
                        <a href=""></a>
                        <a href=""></a>
                        <a href=""></a>
                    </center>
                </div>
                <div class="footer">
                    <center>
                        <p>&copy; 2017 247ureport. All Rights Reserved.</p>
                    </center>
                </div>
            </div>
        </div>
    </body>
</html>