<?php
require "includes/db.php";
$data = $_POST;
?>

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
                    <a class="btn blue-button col-lg-2 popup-link">Замовити</a>
                </div>
            </div>
        </div>
    </header>

    <section class="heading">
        <div class="container ">
            <div class="row">
            <div class="order-form">
                    <h2>Формування замовлення</h2>
                    <div class="order-info col-lg-6">
                    <h3><span class="order-info-important">[ВАЖЛИВО]</span> Ваша заявка повинна містити:</h3>
                    <div class="order-info-paragraph">
                        <p class="regular-text">
                            - Опис проекту <br>
                            - Бюджет <br>
                            - Термін на розробку <br>
                            - Ваші контакти <br>

                        </p>
                    </div>
                </div>
                    <form class="form" action="order.php" method="post">
                        <div class="small-form-fields">
                            <input type="name" id="name" name="name" class="input-field col-lg-3" placeholder="Ім'я" value="<?php echo $data['name'] ?>">
                            <input type="email" id="email" name="email" class="input-field col-lg-3" placeholder="Пошта" value="<?php echo $data['email'] ?>">
                            <input type="text" id="subject" name="subject" class="input-field col-lg-3" placeholder="Назва проекту" value="<?php echo $data['subject'] ?>">
                        </div>
                        <textarea id="description" name="description" class="textarea col-lg-9" placeholder="Опис проекту"></textarea>
                        <br>
                        <?php
                        $errors = array();
                        if (isset($data['send_order'])) {
                           
                            if (trim($data['name']) == '') {
                                $errors[] = 'Заповніть всі поля форми!';
                            }
                            if (trim($data['email']) == '') {
                                $errors[] = 'Введіть email!';
                            }
                            if (trim($data['subject']) == '') {
                                $errors[] = 'Введіть назву проекту!';
                            }
                            if (trim($data['description']) == '') {
                                $errors[] = 'Введіть опис замовлення!';
                            }
                            if (empty($errors) && $success == false) {
                                $updateOrder = R::dispense('order');
                                $updateOrder['name'] = $data['name'];
                                $updateOrder['email'] = $data['email'];
                                $updateOrder['subject'] = $data['subject'];
                                $updateOrder['description'] = $data['description'];
                                $updateOrder['date_add'] = date('d.m.y.h:i');
                                $updateOrder['status'] = 0;
                                R::store($updateOrder);
                                exit("<meta http-equiv='refresh' content='0; url= /success.php'>");
                        ?>
                        
                        <?php
                            } else {
                               
                                echo '<div style="color: red; text-align: center; padding-top:15px; font-size: 20px">' . array_shift($errors) . '</div> <br>';
                            }
                        }

                        ?>
                        <button  type="submit" class="form-button" name="send_order">Відправити</button>
                    </form>



                </div>
                <div class="col-lg-12 order-heading">
                    <h2>Оформлення заявок</h2>
                    <p class="regular-text">Ви можете зробити замовлення на нашому сайті або</p>
                    <div class="contacts d-flex justify-content-around">
                        <div class="contact-block col-lg-3">
                            <div class="contact-block-top contact-block-top-email">
                                <i class="far fa-envelope"></i>
                            </div>
                            <div class="contact-block-bottom">
                                <h3>Email</h3>
                                <p class="regular-text">
                                    applab@gmail.com
                                </p>
                            </div>
                        </div>

                        <div class="contact-block col-lg-3">
                            <div class="contact-block-top contact-block-top-phone">
                                <i class="fas fa-phone"></i>
                            </div>
                            <div class="contact-block-bottom">
                                <h3>Телефон</h3>
                                <p class="regular-text">+(38)-0424-424-44</p>
                            </div>
                        </div>

                        <div class="contact-block col-lg-3">
                            <div class="contact-block-top contact-block-top-adress">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div class="contact-block-bottom">
                                <h3>Адреса</h3>
                                <p class="regular-text">
                                    м. Київ,<br> вул. Генерала Родимцева, 7А
                                </p>
                            </div>
                        </div>
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