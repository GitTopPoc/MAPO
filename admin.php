<?php
require "includes/db.php";
$data = $_POST;
?>
<?php
 R::trash( $book, "WHERE id=2"); 

if (isset($data['do_login'])) {
    $admin = R::findOne('admin', 'login = ?', array($data['login']));
    if (trim($data['login']) == '') {
        $errors[] = 'Заповніть всі поля';
    }
    if (trim($data['password']) == '') {
        $errors[] = 'Заповніть всі поля';
    }

    if ($admin) {
        if (password_verify($data['password'], $admin->password)) {
            // Правильний логін пароль
            $_SESSION['logged_user'] = $admin;
        } else {
            $errors[] = 'Невірний пароль';
        }
    } else {
        $errors[] = 'Невірний логін';
    }
}

if (isset($data['logout'])) {
    unset($_SESSION['logged_user']);
}

if (isset($data['move_new'])) {
    $editingOrder = R::findOne('order', 'WHERE id =' . $data['editOrder']);
    $editingOrder->status = 0;
    R::store($editingOrder);
    $data['editOrder'] = 0;
}

if (isset($data['move_processing_one'])) {
    $editingOrder = R::findOne('order', 'WHERE id =' . $data['editOrder']);
    $editingOrder->status = 6;
    R::store($editingOrder);
    $data['editOrder'] = 0;
}
if (isset($data['move_processing_two'])) {
    $editingOrder = R::findOne('order', 'WHERE id =' . $data['editOrder']);
    $editingOrder->status = 7;
    R::store($editingOrder);
    $data['editOrder'] = 0;
}
if (isset($data['move_processing_three'])) {
    $editingOrder = R::findOne('order', 'WHERE id =' . $data['editOrder']);
    $editingOrder->status = 8;
    R::store($editingOrder);
    $data['editOrder'] = 0;
}
if (isset($data['move_processing_four'])) {
    $editingOrder = R::findOne('order', 'WHERE id =' . $data['editOrder']);
    $editingOrder->status = 9;
    R::store($editingOrder);
    $data['editOrder'] = 0;
}

if (isset($data['move_done'])) {
    $editingOrder = R::findOne('order', 'WHERE id =' . $data['editOrder']);
    $editingOrder->status = 2;
    R::store($editingOrder);
    $data['editOrder'] = 0;
}

if (isset($data['cancel_delete'])) {
    $data['editOrder'] = 0;
}

if (isset($data['order_delete'])) {
    $deleteOrder = R::findOne('order', 'WHERE id =' . $data['editOrder']);
    $deleteOrder->status = 12;
    R::store($deleteOrder);
    $data['editOrder'] = 0;
}


?>

<html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="src/css/bootstrap.min.css">
    <link rel="stylesheet" href="src/css/style.css">
    <link rel="stylesheet" href="src/css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <title>MAPO</title>
</head>

<body>


    <header>
        <div class="container wow animated animate__fadeInDown">
            <div class="row d-flex justify-content-between">
                <div class="col-lg-3 col-md-2 d-flex justify-content-lg-center">
                    <a href="/"><img src="src/image/logo.png" alt="logo"></a>
                    <?php if (isset($_SESSION['logged_user'])) {
                    ?>
                        <form action="admin.php" method="post"> <button class="admin-logout" name="logout">Вийти</button></form>
                    <?php
                    } ?>
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

    <section class="admin-section">
        <?php if (!isset($_SESSION['logged_user'])) { ?>
            <form action="admin.php" method="POST" class="admin-auth">
                <div class="container">
                    <div class="form-inputs col-lg-6 d-block justify-content-center">
                        <p class="regular-text admin-auth-text">Для перегляду цієї сторінки потрібно авторизуватися</p>
                        <div class="input-fields">
                            <input name="login" type="text" class="auth-admin" placeholder="Логін"> <br>
                            <input name="password" type="password" class="auth-admin" placeholder="Пароль"><br>
                            <?php
                            if (!empty($errors)) {
                                echo '<div class="form-content" style="color: #ff0000; text-align:center; padding: 0 0 10px 0">' . array_shift($errors) . '</div>';
                            }
                            ?>
                            <button name="do_login" class="admin-auth-button" type="submit">Увійти</button>
                        </div>
                    </div>
                </div>
            </form>

        <?php 
        } else {
        ?>



<?php 
                    // Фільтр
                   
                    if (isset($data['show_done'])) {
                        $zaprosType = $data['zapros-type-done'];
                        $_SESSION['zaprosType'] = $zaprosType;
                    }
                    if (isset($data['show_processing'])) {
                        $zaprosType = $data['zapros-type-processing'];
                        $_SESSION['zaprosType'] = $zaprosType;
                    }
                    if (isset($data['show_new'])) {
                        $zaprosType = $data['zapros-type-new'];
                        $_SESSION['zaprosType'] = $zaprosType;
                    }
                    if (isset($data['show_all'])) {
                        $zaprosType = $data['zapros-type-all'];
                        $_SESSION['zaprosType'] = $zaprosType;
                    }
                    if ($zaprosType == '') {
                        if ($_SESSION['zaprosType'] != '') {
                            $zaprosType = $_SESSION['zaprosType'];
                        }
                    }
                    if ($zaprosType == 3 || $zaprosType == '' || $_SESSION['zapros-type'] == 3) {
                        $zapros = "WHERE status<=10 ORDER BY date_add DESC";
                        $orders = R::findCollection('order', $zapros);
                    } else if($zaprosType >= 6) {
                        $zapros = "WHERE status>5 AND status<=10" . ' ORDER BY date_add DESC';
                        $orders = R::findCollection('order', $zapros);
                    } else {
                        $zapros = "WHERE status =" . $zaprosType . ' ORDER BY date_add DESC';
                        $orders = R::findCollection('order', $zapros);
                    }
                    ?>
            <div class="container orders-field">
                <div class="order-filters col-lg-7 d-flex jusify-content-between">
                    <?php
                    if($zaprosType == 3) {
                        ?><form class="col-lg-3" action="admin.php" method="post"><input type="hidden" value="3" name="zapros-type-all"><button type="submit" class="col-lg-11 filter-button  filter-button-active" name="show_all"><?php echo ' <p class="regular-text" >Всі</p> ' ?></button></form> <?php
                    }else { 
                        ?> <form class="col-lg-3" action="admin.php" method="post"><input type="hidden" value="3" name="zapros-type-all"><button type="submit" class="col-lg-11 filter-button " name="show_all"><?php echo ' <p class="regular-text" >Всі</p> ' ?></button></form> <?php
                    }
                    ?>

                    <?php
                    if($zaprosType == 0) {
                        ?><form class="col-lg-3" action="admin.php" method="post"><input type="hidden" value="0" name="zapros-type-new"><button class="col-lg-11 filter-button filter-button-active" name="show_new"><?php echo ' <p class="regular-text" >Нові</p> ' ?></button></form> <?php
                    }else { 
                        ?> <form class="col-lg-3" action="admin.php" method="post"><input type="hidden" value="0" name="zapros-type-new"><button class="col-lg-11 filter-button" name="show_new"><?php echo ' <p class="regular-text" >Нові</p> ' ?></button></form> <?php
                    }
                    ?>

                    <?php
                    if($zaprosType == 6) {
                        ?><form class="col-lg-3" action="admin.php" method="post"><input type="hidden" value="6" name="zapros-type-processing"><button class="col-lg-11 filter-button filter-button-active" name="show_processing"><?php echo ' <p class="regular-text" >Виконуються</p> ' ?></button></form> <?php
                    }else { 
                        ?> <form class="col-lg-3" action="admin.php" method="post"><input type="hidden" value="6" name="zapros-type-processing"><button class="col-lg-11 filter-button" name="show_processing"><?php echo ' <p class="regular-text" >Виконуються</p> ' ?></button></form> <?php
                    }
                    ?>

                    <?php
                    if($zaprosType == 2) {
                        ?><form class="col-lg-3" action="admin.php" method="post"><input type="hidden" value="2" name="zapros-type-done"><button class="col-lg-11 filter-button filter-button-active" name="show_done"><?php echo ' <p class="regular-text" >Виконані</p> ' ?></button></form> <?php
                    }else {
                        ?> <form class="col-lg-3" action="admin.php" method="post"><input type="hidden" value="2" name="zapros-type-done"><button class="col-lg-11 filter-button" name="show_done"><?php echo ' <p class="regular-text" >Виконані</p> ' ?></button></form> <?php
                    }
                    ?>


                    
                    
                    
                    
                    

                </div>
                <div class="orders">
                    <?php

                    while ($order = $orders->next()) {
                    ?>

                        <div class="order col-lg-8">
                            <div class="order-status col-lg-6">
                                <?php
                                if ($order->status == 0) { ?>
                                    <p class="order-status-text order-status-text-new col-lg-3">НОВА</p>
                                    
                                <?php
                                }
                                if ($order->status == 6) { 
                                    ?>
                                    <p class="order-status-text order-status-text-processing col-lg-7">ВИКОНУЄТЬСЯ</p>
                                    <div class="box">
                                        <div class="percent percent-step-one">
                                            <svg>
                                                <circle cx="70" cy="70" r="70"></circle>
                                                <circle cx="70" cy="70" r="70"></circle>
                                            </svg>
                                            <div class="num">
                                                <h2>50<span>%</span></h2>
                                            </div>
                                        </div>
                                        <h2 class="text">Виконання верстки</h2>
                                    </div>
                                <?php
                                }
                                if ($order->status == 7) { 
                                    ?>
                                    <p class="order-status-text order-status-text-processing col-lg-7">ВИКОНУЄТЬСЯ</p>
                                    <div class="box">
                                        <div class="percent percent-step-two">
                                            <svg>
                                                <circle cx="70" cy="70" r="70"></circle>
                                                <circle cx="70" cy="70" r="70"></circle>
                                            </svg>
                                            <div class="num">
                                                <h2>75<span>%</span></h2>
                                            </div>
                                        </div>
                                        <h2 class="text">Написання логіки</h2>
                                    </div>
                                <?php
                                }
                                if ($order->status == 8) { 
                                    ?>
                                    <p class="order-status-text order-status-text-processing col-lg-7">ВИКОНУЄТЬСЯ</p>
                                    <div class="box">
                                        <div class="percent percent-step-three">
                                            <svg>
                                                <circle cx="70" cy="70" r="70"></circle>
                                                <circle cx="70" cy="70" r="70"></circle>
                                            </svg>
                                            <div class="num">
                                                <h2>85<span>%</span></h2>
                                            </div>
                                        </div>
                                        <h2 class="text">Тестування сайту та завантаження на хостинг</h2>
                                    </div>
                                <?php
                                }
                                if ($order->status == 9) { 
                                    ?>
                                    <p class="order-status-text order-status-text-processing col-lg-7">ВИКОНУЄТЬСЯ</p>
                                    <div class="box">
                                        <div class="percent percent-step-four">
                                            <svg>
                                                <circle cx="70" cy="70" r="70"></circle>
                                                <circle cx="70" cy="70" r="70"></circle>
                                            </svg>
                                            <div class="num">
                                                <h2>95<span>%</span></h2>
                                            </div>
                                        </div>
                                        <h2 class="text">Передача сайта клієнту</h2>
                                    </div>
                                <?php
                                }
                                if ($order->status == 2) { ?>
                                    <p class="order-status-text order-status-text-done col-lg-6">ВИКОНАНО</p>
                                    <div class="box">
                                        <div class="percent percent-done">
                                            <svg>
                                                <circle cx="70" cy="70" r="70"></circle>
                                                <circle cx="70" cy="70" r="70"></circle>
                                            </svg>
                                            <div class="num">
                                                <h2>100<span>%</span></h2>
                                            </div>
                                        </div>
                                        <h2 class="text">Виконана</h2>
                                    </div>
                                <?php
                                }

                                ?>
                            </div>

                            <?php


                            if ($data['editOrder'] != $order->id) {
                            ?>
                                <div class="editing col-lg-3">
                                    <form action="admin.php" method="post" class="editing-form">
                                        <input type="hidden" value="<?php echo $order->id; ?>" name="editOrder">
                                        <button type="submit" class="order-move-button order-edit-button" name="move_order">Перемістити</button>
                                        <button class="order-delete-button order-edit-button" name="delete_order">Видалити</button>


                                    </form>
                                </div>
                            <?php
                            } else if (isset($data['move_order'])) {
                                $zaprosType = $_SESSION['zaprosType'];
                            ?>
                                <div class="editing col-lg-8">
                                    <p class="regular-text editing-heading">Оберіть новий статус заявки</p>
                                    <form class=" editing d-flex justify-content-lg-between" action="admin.php" method="POST">
                                        <input type="hidden" value="<?php echo $order->id; ?>" name="editOrder">

                                        <button type="submit" class="order-move-new-button order-edit-button" name="move_new">Нова</button>
                                        <button type="submit" class="order-move-processing-button order-edit-button" name="move_processing_one">Верстка</button>
                                        <button type="submit" class="order-move-processing-button order-edit-button" name="move_processing_two">Логіка</button>
                                        <button type="submit" class="order-move-processing-button order-edit-button" name="move_processing_three">Перевірка</button>
                                        <button type="submit" class="order-move-processing-button order-edit-button" name="move_processing_four">Передача</button>
                                        <button type="submit" class="order-delete-button order-edit-button" name="move_done">Виконана</button>
                                    </form>
                                </div>

                            <?php
                            } else if (isset($data['delete_order'])) {
                                $zaprosType = $_SESSION['zaprosType'];
                            ?>
                                <div class="editing col-lg-6">
                                    <p class="regular-text editing-heading">Ви точно хочете видалити запис?</p>
                                    <form class=" editing col-lg-6 d-flex justify-content-between" action="admin.php" method="POST">
                                        <input type="hidden" value="<?php echo $order->id; ?>" name="editOrder">
                                        <button type="submit" class="order-delete-button  order-edit-button" name="order_delete">Видалити</button>
                                        <button type="submit" class="order-move-new-button  order-edit-button" name="cancel_delete">Скасувати</button>

                                    </form>
                                </div>

                            <?php
                            }
                            ?>



                            <div class="order-info">
                                <div class="order-heading d-flex justify-content-lg-center">
                                    <p class="regular-text col-lg-4"> Від: <?php echo $order->name ?></p>
                                    <p class="regular-text col-lg-4"> Пошта: <?php echo $order->email ?></p>
                                    <p class="regular-text col-lg-4"> Назва: <?php echo $order->subject ?></p>
                                </div>
                                <p class="regular-text" style="text-align: center;">Опис замовлення:</p>
                                <div class="order-description">
                                    <p class="regular-text"><?php echo $order->description ?> </p>
                                </div>
                                <div class="order-time">
                                    <p class="regular-text"> Дата замовлення: <?php echo $order->date_add ?> </p>
                                </div>
                            </div>
                        </div>


                    <?php
                    }

                    ?>
                </div>
            </div>
        <?php
        } ?>
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