<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <?=$this->getMeta();?>
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <!-- Place favicon.ico in the root directory -->
        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        <link rel="stylesheet" href="/assets/css/main.css">
    </head>
    <body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    
        <!-- Header Area Start -->   
		<header id="header-top">
            <div class="container">
                <div class="root header-wrapper">
                <div class="logo">
                    <span>LOGO SITE</span>
                </div>
                <div class="main-menu">
                    <ul class="menu-items inline">
                        <li class="menu-item"><a href="/">Home</a></li>
                        <li class="menu-item"><a href="#">About</a></li>
                        <li class="menu-item"><a href="#">Contacts</a></li>
                    </ul>
                </div>
                <div class="account-user">
                    <a class="dropdown-toggle" href="#">
                        Account &nbsp;<i class="fa fa-angle-down"></i>
                    </a>
                    <ul class="dropdown-list">
                        <?php if(Core\Session\Session::get('currentUser', null)):?>
                        <li>Welcome: User</li>
                        <li><a href="/user/logout">Enter</a></li>
                        <?php else:?>
                        <li><a href="/user/login">Login</a></li>
                        <li><a href="/user/signup">Signup</a></li>
                        <?php endif;?>
                    </ul>
                </div>
            </div>
            </div>
		</header>
		<!-- Header Area End -->
	    <div class="content-area">
            <div class="container arrea-errors">
                <div class="row">
                    <div class="col-md-12">
                        <?php if(isset($errors)):?>
                            <div class="alert alert-danger">
                                <?=$errors; ?>
                            </div>
                        <?php endif;?>
                        <?php if(isset($success)):?>
                            <div class="alert alert-success">
                                <?=$success; ?>
                            </div>
                        <?php endif;?>
                    </div>
                </div>
            </div>
            <div class="container">
                <?=$content;?>
            </div>

        </div>
        <!-- Footer Start -->
        <footer class="footer-area">
            <div class="main-footer">
                <div class="container">
                    <div class="row">
                        top footer
                    </div>
                </div>
            </div>   
            <div class="footer-bottom text-center">
                <div class="container">
                    <div class="row">
                        bot footer
                    </div>
                </div>    
            </div>
        </footer>
        <script
                src="https://code.jquery.com/jquery-3.3.1.min.js"
                integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
                crossorigin="anonymous"></script>
        <!-- Footer End -->

        <script src="/assets/validation/jquery.validate.min.js"></script>
        <script src="/assets/js/bundle.js"></script>
    </body>
</html>
