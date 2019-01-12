<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <?=$this->getMeta();?>
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <!-- Place favicon.ico in the root directory -->
    </head>
    <body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    
        <!-- Header Area Start -->   
		<header>

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
            <?=$content;?>
        </div>
        <!-- Footer Start -->
        <footer class="footer-area">
            <div class="main-footer">
                <div class="container">
                    <div class="row">

                    </div>
                </div>
            </div>   
            <div class="footer-bottom text-center">
                <div class="container">
                    <div class="row">

                    </div>
                </div>    
            </div>
        </footer>
        <!-- Footer End -->
    </body>
</html>
