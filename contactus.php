<?php require 'includes/header.php'; ?>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Contact Us</title>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <link rel="stylesheet" href="form.css" >
        <script src="form.js"></script>
    </head>
    <body >

        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <h1>Contact Us</h1> <br><br>  
                   
                    <form role="form" method="post" id="reused_form" >
                        <div class="form-group">
                            <label for="name"> Name:</label>
                            <input type="text" class="form-control" id="name" name="name" required maxlength="50">
                        </div>
                        <div class="form-group">
                            <label for="email"> Email:</label>
                            <input type="email" class="form-control" id="email" name="email" required maxlength="50">
                        </div>
                        <div class="form-group">
                            <label for="name"> Message:</label>
                            <textarea class="form-control" type="textarea" name="message" id="message" placeholder="Your Message Here" maxlength="6000" rows="7"></textarea>
                        </div>
                        <div class="row" style="margin-bottom:30px;">
                            <div class="col-sm-5">
                                <img src="captcha.php" id="captcha_image"/>
                                <br/>
                                <a id="captcha_reload" href="#">reload</a> 
                            </div>
                            <div class="col-sm-6">
                                <label for="email">Enter the code from the image here:</label>
                                <input type="text" class="form-control" required id="captcha" name="captcha" >
                            </div>
                        </div>
                        <button type="submit" class="btn btn-lg btn-success pull-right" id="btnContactUs">Post &rarr;</button>
                    </form>
                    <div id="success_message" style="width:100%; height:100%; display:none; "> <h3>Sent your message successfully!</h3> </div>
                    <div id="error_message" style="width:100%; height:100%; display:none; "> <h3>Error</h3> Sorry there was an error sending your form. </div>
                </div>
            </div>
        </div><br><div>
        <a href="https://www.kefri.org/OLD SITE/php-contact-form-with-captcha/formpage.html"><centre><b>CLICK for live testing</b></centre></a></div>

        <?php require 'includes/footer.php'; ?>
    </body>
</html>