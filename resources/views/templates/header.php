<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Desafio técnico</title>

        <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <meta name="description" content="Admindek Bootstrap admin template made using Bootstrap 4 and it has huge amount of ready made feature, UI components, pages which completely fulfills any dashboard needs." />
        <meta name="keywords" content="flat ui, admin Admin , Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app">
        <meta name="author" content="colorlib" />

        <link rel="stylesheet" type="text/css" href="<?= asset('vendors/ladda/css/ladda.min.css') ?>">

        <!-- Os styles abaixo vieram juntamente com o tema -->
        <link rel="icon" href="https://colorlib.com/polygon/admindek/files/assets/images/favicon.ico" type="image/x-icon">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Quicksand:500,700" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="<?= asset('theme/css/bootstrap.min.css') ?>">
        <link rel="stylesheet" type="text/css" href="<?= asset('theme/css/waves.min.css') ?>"  media="all">
        <link rel="stylesheet" type="text/css" href="<?= asset('theme/css/feather.css') ?>">
        <link rel="stylesheet" type="text/css" href="<?= asset('theme/css/font-awesome-n.min.css') ?>">
        <link rel="stylesheet" type="text/css" href="<?= asset('theme/css/chartist.css') ?>" media="all">
        <link rel="stylesheet" type="text/css" href="<?= asset('theme/css/style.css') ?>">
        <link rel="stylesheet" type="text/css" href="<?= asset('theme/css/widget.css') ?>">

        <!-- Os styles são os que realmente eu uso na regra de negócio do sistema -->
        <link rel="stylesheet" type="text/css" href="<?= asset('app/app.css') ?>">

        <?php
        if (!empty($assets['css'])) {
            foreach ($assets['css'] as $css) {
                ?>
                <link rel="stylesheet" type="text/css" href="<?= asset($css) ?>">
                <?php
            }
        }
        ?>
    </head>
    <body>
        <?php $user = $shared['user']; ?>
        <div class="loader-bg">
            <div class="loader-bar"></div>
        </div>

        <div id="pcoded" class="pcoded">
            <div class="pcoded-overlay-box"></div>
            <div class="pcoded-container navbar-wrapper">

                <nav class="navbar header-navbar pcoded-header">
                    <div class="navbar-wrapper">
                        <div class="navbar-logo">
                            <a href="#">
                                <label>Bem Vindo :)</label>
                                <!--<img class="img-fluid" src="<?= asset('theme/png/logo.png') ?>" alt="Theme-Logo" />-->
                            </a>
                            <a class="mobile-menu" id="mobile-collapse" href="#!">
                                <i class="feather icon-menu icon-toggle-right"></i>
                            </a>
                            <a class="mobile-options waves-effect waves-light">
                                <i class="feather icon-more-horizontal"></i>
                            </a>
                        </div>
                        <div class="navbar-container container-fluid">
                            <ul class="nav-left">
                                <li class="header-search">
                                    <div class="main-search morphsearch-search">
                                        <div class="input-group">
                                            <span class="input-group-prepend search-close">
                                                <i class="feather icon-x input-group-text"></i>
                                            </span>
                                            <input type="text" class="form-control" placeholder="Digite aqui ...">
                                            <span class="input-group-append search-btn">
                                                <i class="feather icon-search input-group-text"></i>
                                            </span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <a href="#!" onclick="if (!window.__cfRLUnblockHandlers) return false; javascript:toggleFullScreen()" class="waves-effect waves-light">
                                        <i class="full-screen feather icon-maximize"></i>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav-right">
                                <li class="user-profile header-notification">
                                    <div class="dropdown-primary dropdown">
                                        <div class="dropdown-toggle" data-toggle="dropdown">
                                            <i class="feather icon-chevron-down"></i>
                                        </div>
                                        <ul class="show-notification profile-notification dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                            <li>
                                                <a href="#">
                                                    <i class="feather icon-log-out"></i> Sair
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>

                <div class="pcoded-main-container">
                    <div class="pcoded-wrapper">

                        <nav class="pcoded-navbar">
                            <?php include template('left_menu.php'); ?>
                        </nav>

                        <div class="pcoded-content">
                            <div class="pcoded-inner-content">
                                <div class="main-body">
                                    <div class="page-wrapper">
                                        <div class="page-body">
                                            <div id="top-message-box"></div>
                                            <?php if (!empty($messages['error'])) { ?>
                                                <div class="alert alert-danger" role="alert">
                                                    <?= $messages['error'] ?>
                                                </div>
                                            <?php } ?>
                                            <?php if (!empty($messages['success'])) { ?>
                                                <div class="alert alert-success" role="alert">
                                                    <?= $messages['success'] ?>
                                                </div>
                                            <?php } ?>
