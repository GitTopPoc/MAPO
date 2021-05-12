<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="src/css/bootstrap.min.css">
    <link rel="stylesheet" href="src/css/style.css">
    <link rel="stylesheet" href="src/css/order.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <title>MAPO</title>
</head>

<body>


    <header>
        <div class="container wow animated animate__fadeInDown">
            <div class="row d-flex justify-content-between">
                <div class="col-lg-2 col-md-2">
                    <a href="/"><img src="src/image/logo.png" alt="logo"></a>
                </div>
                <div class="col-lg-5 col-md-5 nav-fill">
                    <nav class="col-lg-8 col-md-8">
                        <ul class="menu d-flex">
                            <li class="col-lg-3 col-md-3">
                                <a href="/">Головна</a>
                            </li>

                            <li class="col-lg-3 col-md-3">
                                <p></p>
                            </li>

                            <li class="col-lg-3 col-md-3">
                                <a href="/about.html">Про нас</a>
                            </li>
                        </ul>
                    </nav>
                    <a href="/order.php" class="btn blue-button col-lg-2 popup-link">Замовити</a>
                </div>
            </div>
        </div>
    </header>

   <section class="success-settings">
       <div class="container">
           <div class="row">
               <div class="success-sended">
               <h2 style="color: green; padding: 20px 0 20px 0;">Ви успішно відправили заявку на розгляд. <br> Чекайте нашої відповіді.</h2>
                <div class="home-button">
                <a class="go-main" href="/"> На головну</a>
                </div>
               </div>
           </div>
       </div>
   </section>

    <footer>
        <div class="container">
            <div class="row d-block justify-content-center">
                <div class="col-lg-2 m-auto">
                    <a href="#"><img class="img-center" src="src/image/logo.png" alt="logo"></a>
                </div>
                <div class="col-lg-6 m-auto text-center">
                    <nav>
                        <ul class="d-flex justify-content-center">
                            <li class="col-lg-3s">
                                <a href="/index.html">Головна</a>

                            </li>


                            <li class="col-lg-3">
                                <a href="/about.html">Про нас</a>
                            </li>

                        </ul>
                    </nav>

                    <nav class="col-lg-8" style="margin: 0 auto;">
                        <ul class="d-flex justify-content-center">
                            <li> <a class="footer-social" href="#"><i class="fa fa-facebook"></i></a></li>
                            <li> <a class="footer-social" href="#"><i class="fa fa-twitter"></i></a></li>
                            <li> <a class="footer-social" href="#"><i class="fa fa-linkedin"></i></a></li>
                            <li> <a class="footer-social" href="#"><i class="fa fa-github"></i></a></li>
                        </ul>
                    </nav>

                    <p class="regular-text footer-copyright">Copyright© AppLab 2021. All rights reserved
                    </p>
                </div>
            </div>
        </div>
    </footer>
    <div class="applab-logo-text">AppLab</div>
    <script src="src/js/jquerry.js"></script>
    <script src="src/js/main.js"></script>
    <script src="https://kit.fontawesome.com/972c4ebada.js" crossorigin="anonymous"></script>
    <script src="src/js/bootstrap.min.js"></script>
    <script src="src/js/wow.js"></script>
    <script>
        new WOW().init();
    </script>
</body>

</html>