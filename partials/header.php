<?php
include_once('../models/campaign.php');
session_start();
if (!(isset($_SESSION['authenticated_user']))) header('Location: login.php');
?>

<!doctype html>
<html lang="es" class="light-theme">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--plugins-->
    <link href="../assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
    <link href="../assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
    <link href="../assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../assets/plugins/notifications/css/lobibox.min.css" />

    <!-- CSS Files -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/bootstrap.css" rel="stylesheet">
    <link href="../assets/css/bootstrap.css.map" rel="stylesheet">
    <link href="../assets/css/bootstrap-extended.css" rel="stylesheet">
    <link href="../assets/css/style.css" rel="stylesheet">
    <link href="../assets/css/icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">

    <!-- CSS Files -->
    <link href="../assets/plugins/fancy-file-uploader/fancy_fileupload.css" rel="stylesheet" />
    <link href="../assets/plugins/Drag-And-Drop/dist/imageuploadify.min.css" rel="stylesheet" />


    <!--Theme Styles-->
    <link href="../assets/css/dark-theme.css" rel="stylesheet" />
    <link href="../assets/css/semi-dark.css" rel="stylesheet" />
    <link href="../assets/css/header-colors.css" rel="stylesheet" />
    <link href="../assets/plugins/select2/css/select2.min.css" rel="stylesheet" />
    <link href="../assets/plugins/select2/css/select2-bootstrap4.css" rel="stylesheet" />


    <link href="../assets/plugins/datetimepicker/css/classic.css" rel="stylesheet" />
    <link href="../assets/plugins/datetimepicker/css/classic.time.css" rel="stylesheet" />
    <link href="../assets/plugins/datetimepicker/css/classic.date.css" rel="stylesheet" />
    <link rel="stylesheet" href="../assets/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <link rel="stylesheet" type="text/css" href="../assets/librerias/alertify/css/alertify.css">
    <link rel="stylesheet" type="text/css" href="../assets/librerias/alertify/css/themes/bootstrap.css">


    <title>CRM - Contagiando voluntad</title>
</head>

<body>
    <!--start wrapper-->
    <div class="wrapper">
        <!--start sidebar -->
        <aside class="sidebar-wrapper" data-simplebar="true">
            <div class="sidebar-header">
                <img src="../../assets/img/logo.png" class="logo-icon" alt="logo icon">
                <h5 class="logo-text">Contagiando Voluntad</h5>
                <div class="toggle-icon ms-auto">
                    <ion-icon name="menu-sharp"></ion-icon>
                </div>
            </div>
            <!--navigation-->
            <ul class="metismenu" id="menu">
                <li>
                    <a href="index.php">
                        <div class="parent-icon">
                            <ion-icon name="home-sharp" />
                        </div>
                        <div class="menu-title">Estadísticas</div>
                    </a>
                </li>
                <li>
                    <a href="javascript:;" class="has-arrow">
                        <div class="parent-icon">
                            <ion-icon name="people-sharp" />>
                        </div>
                        <div class="menu-title">Usuarios</div>
                    </a>
                    <ul>
                        <li><a href="/views/usuarios.php">
                                Todos los usuarios
                            </a></li>
                        <li><a href="/views/usuario-nuevo.php">
                                Registrar usuario
                            </a></li>
                        <li><a href="/views/usuario.php">
                                Detalle de usuario
                            </a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:;" class="has-arrow">
                        <div class="parent-icon">
                            <ion-icon name="megaphone-sharp" />>
                        </div>
                        <div class="menu-title">Campañas</div>
                    </a>
                    <ul>
                        <li><a href="/views/campañas.php">
                                Todas las campañas
                            </a></li>
                        <li><a href="/views/campaña-nueva.php">
                                Registrar campaña
                            </a></li>
                        <li><a href="/views/campaña.php">
                                Detalle de campaña
                            </a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:;" class="has-arrow">
                        <div class="parent-icon">
                            <ion-icon name="gift-sharp" />>
                        </div>
                        <div class="menu-title">Donaciones</div>
                    </a>
                    <ul>
                        <li><a href="/views/donaciones.php">
                                Todas las donaciones
                            </a></li>
                        <li><a href="/views/donacion-nueva.php">
                                Registrar donación
                            </a></li>
                        <li><a href="/views/donacion.php">
                                Detalle de donación
                            </a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:;">
                        <div class="parent-icon">
                            <ion-icon name="document-sharp" />>
                        </div>
                        <div class="menu-title">Reconocimientos?</div>
                    </a>
                </li>

                <li class="menu-label">Mi perfil</li>
                <li>
                    <a href="/views/importar.php">
                        <div class="parent-icon">
                            <ion-icon name="cloud-upload-sharp" />>
                        </div>
                        <div class="menu-title">Importar desde csv</div>
                    </a>
                </li>
            </ul>
            <!--end navigation-->
        </aside>
        <!--end sidebar -->

        <!--start top header-->
        <header class="top-header">
            <nav class="navbar navbar-expand gap-3">
                <div class="mobile-menu-button">
                    <ion-icon name="menu-sharp"></ion-icon>
                </div>
                <form class="searchbar">
                    <div class="position-absolute top-50 translate-middle-y search-icon ms-3">
                        <ion-icon name="search-sharp"></ion-icon>
                    </div>
                    <input class="form-control" type="text" placeholder="Search for anything">
                    <div class="position-absolute top-50 translate-middle-y search-close-icon">
                        <ion-icon name="close-sharp"></ion-icon>
                    </div>
                </form>
                <div class="top-navbar-right ms-auto">

                    <ul class="navbar-nav align-items-center">
                        <li class="nav-item mobile-search-button">
                            <a class="nav-link" href="javascript:;">
                                <div class="">
                                    <ion-icon name="search-sharp"></ion-icon>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link dark-mode-icon" href="javascript:;">
                                <div class="mode-icon">
                                    <ion-icon name="moon-sharp"></ion-icon>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item dropdown dropdown-large dropdown-apps">
                            <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="javascript:;" data-bs-toggle="dropdown">
                                <div class="">
                                    <ion-icon name="apps-sharp"></ion-icon>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end dropdown-menu-dark">
                                <div class="row row-cols-3 g-3 p-3">
                                    <div class="col text-center">
                                        <div class="app-box mx-auto bg-gradient-purple text-white">
                                            <ion-icon name="cart-sharp"></ion-icon>
                                        </div>
                                        <div class="app-title">Orders</div>
                                    </div>
                                    <div class="col text-center">
                                        <div class="app-box mx-auto bg-gradient-info text-white">
                                            <ion-icon name="people-sharp"></ion-icon>
                                        </div>
                                        <div class="app-title">Teams</div>
                                    </div>
                                    <div class="col text-center">
                                        <div class="app-box mx-auto bg-gradient-success text-white">
                                            <ion-icon name="shield-checkmark-sharp"></ion-icon>
                                        </div>
                                        <div class="app-title">Tasks</div>
                                    </div>
                                    <div class="col text-center">
                                        <div class="app-box mx-auto bg-gradient-danger text-white">
                                            <ion-icon name="videocam-sharp"></ion-icon>
                                        </div>
                                        <div class="app-title">Media</div>
                                    </div>
                                    <div class="col text-center">
                                        <div class="app-box mx-auto bg-gradient-warning text-white">
                                            <ion-icon name="file-tray-sharp"></ion-icon>
                                        </div>
                                        <div class="app-title">Files</div>
                                    </div>
                                    <div class="col text-center">
                                        <div class="app-box mx-auto bg-gradient-branding text-white">
                                            <ion-icon name="notifications-sharp"></ion-icon>
                                        </div>
                                        <div class="app-title">Alerts</div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item dropdown dropdown-large">
                            <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="javascript:;" data-bs-toggle="dropdown">
                                <div class="position-relative">
                                    <span class="notify-badge">8</span>
                                    <ion-icon name="notifications-sharp"></ion-icon>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a href="javascript:;">
                                    <div class="msg-header">
                                        <p class="msg-header-title">Notifications</p>
                                        <p class="msg-header-clear ms-auto">Marks all as read</p>
                                    </div>
                                </a>
                                <div class="header-notifications-list">
                                    <a class="dropdown-item" href="javascript:;">
                                        <div class="d-flex align-items-center">
                                            <div class="notify text-primary">
                                                <ion-icon name="cart-outline"></ion-icon>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="msg-name">New Orders <span class="msg-time float-end">2 min
                                                        ago</span></h6>
                                                <p class="msg-info">You have recived new orders</p>
                                            </div>
                                        </div>
                                    </a>
                                    <a class="dropdown-item" href="javascript:;">
                                        <div class="d-flex align-items-center">
                                            <div class="notify text-danger">
                                                <ion-icon name="person-outline"></ion-icon>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="msg-name">New Customers<span class="msg-time float-end">14 Sec
                                                        ago</span></h6>
                                                <p class="msg-info">5 new user registered</p>
                                            </div>
                                        </div>
                                    </a>
                                    <a class="dropdown-item" href="javascript:;">
                                        <div class="d-flex align-items-center">
                                            <div class="notify text-success">
                                                <ion-icon name="document-outline"></ion-icon>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="msg-name">24 PDF File<span class="msg-time float-end">19 min
                                                        ago</span></h6>
                                                <p class="msg-info">The pdf files generated</p>
                                            </div>
                                        </div>
                                    </a>

                                    <a class="dropdown-item" href="javascript:;">
                                        <div class="d-flex align-items-center">
                                            <div class="notify text-info">
                                                <ion-icon name="checkmark-done-outline"></ion-icon>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="msg-name">New Product Approved <span class="msg-time float-end">2 hrs ago</span></h6>
                                                <p class="msg-info">Your new product has approved</p>
                                            </div>
                                        </div>
                                    </a>
                                    <a class="dropdown-item" href="javascript:;">
                                        <div class="d-flex align-items-center">
                                            <div class="notify text-warning">
                                                <ion-icon name="send-outline"></ion-icon>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="msg-name">Time Response <span class="msg-time float-end">28 min
                                                        ago</span></h6>
                                                <p class="msg-info">5.1 min avarage time response</p>
                                            </div>
                                        </div>
                                    </a>
                                    <a class="dropdown-item" href="javascript:;">
                                        <div class="d-flex align-items-center">
                                            <div class="notify text-danger">
                                                <ion-icon name="chatbox-ellipses-outline"></ion-icon>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="msg-name">New Comments <span class="msg-time float-end">4 hrs
                                                        ago</span></h6>
                                                <p class="msg-info">New customer comments recived</p>
                                            </div>
                                        </div>
                                    </a>
                                    <a class="dropdown-item" href="javascript:;">
                                        <div class="d-flex align-items-center">
                                            <div class="notify text-primary">
                                                <ion-icon name="albums-outline"></ion-icon>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="msg-name">New 24 authors<span class="msg-time float-end">1 day
                                                        ago</span></h6>
                                                <p class="msg-info">24 new authors joined last week</p>
                                            </div>
                                        </div>
                                    </a>
                                    <a class="dropdown-item" href="javascript:;">
                                        <div class="d-flex align-items-center">
                                            <div class="notify text-success">
                                                <ion-icon name="shield-outline"></ion-icon>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="msg-name">Your item is shipped <span class="msg-time float-end">5 hrs
                                                        ago</span></h6>
                                                <p class="msg-info">Successfully shipped your item</p>
                                            </div>
                                        </div>
                                    </a>
                                    <a class="dropdown-item" href="javascript:;">
                                        <div class="d-flex align-items-center">
                                            <div class="notify text-warning">
                                                <ion-icon name="cafe-outline"></ion-icon>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="msg-name">Defense Alerts <span class="msg-time float-end">2 weeks
                                                        ago</span></h6>
                                                <p class="msg-info">45% less alerts last 4 weeks</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <a href="javascript:;">
                                    <div class="text-center msg-footer">View All Notifications</div>
                                </a>
                            </div>
                        </li>
                        <li class="nav-item dropdown dropdown-user-setting">
                            <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="javascript:;" data-bs-toggle="dropdown">
                                <div class="user-setting">
                                    <img src="../images/avatars/06.png" class="user-img" alt="">
                                </div>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <div class="d-flex flex-row align-items-center gap-2">
                                            <img src="../images/avatars/06.png" alt="" class="rounded-circle" width="54" height="54">
                                            <div class="">
                                                <h6 class="mb-0 dropdown-user-name">
                                                    <?php

                                                    echo $_SESSION['usuarioR'];
                                                    ?>
                                                </h6>
                                                <small class="mb-0 dropdown-user-designation text-secondary">KBB Marketing</small>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <a class="dropdown-item" href="pages-user-profile.html">
                                        <div class="d-flex align-items-center">
                                            <div class="">
                                                <ion-icon name="person-outline"></ion-icon>
                                            </div>
                                            <div class="ms-3"><span>Perfil</span></div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <div class="d-flex align-items-center">
                                            <div class="">
                                                <ion-icon name="settings-outline"></ion-icon>
                                            </div>
                                            <div class="ms-3"><span>Configuración</span></div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="../php/index.php">
                                        <div class="d-flex align-items-center">
                                            <div class="">
                                                <ion-icon name="speedometer-outline"></ion-icon>
                                            </div>
                                            <div class="ms-3"><span>Escritorio</span></div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <div class="d-flex align-items-center">
                                            <div class="">
                                                <ion-icon name="wallet-outline"></ion-icon>
                                            </div>
                                            <div class="ms-3"><span>Analitícas</span></div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <div class="d-flex align-items-center">
                                            <div class="">
                                                <ion-icon name="cloud-download-outline"></ion-icon>
                                            </div>
                                            <div class="ms-3"><span>Descargas</span></div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <a class="dropdown-item" href="../php/logout.php">
                                        <div class="d-flex align-items-center">
                                            <div class="">
                                                <ion-icon name="log-out-outline"></ion-icon>
                                            </div>
                                            <div class="ms-3"><span>Cerrar sesión</span></div>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </li>

                    </ul>

                </div>
            </nav>
        </header>
        <!--end top header-->