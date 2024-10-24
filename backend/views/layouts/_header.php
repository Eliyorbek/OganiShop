<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>

<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="index3.html" class="nav-link">Home</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link">Contact</a>
        </li>
    </ul>

    <ul class="navbar-nav ml-auto">

        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">

            <div class="dropdown">
                <button class="btn  dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="far fa-user"></i>
                    <?php if (!\Yii::$app->user->isGuest): ?>
                        <span><?= \Yii::$app->user->identity->username ?></span>
                    <?php endif; ?>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="#">
                            <?= Html::a('Logout', ['/site/logout'], [
                                    'data-method' => 'post',
                                    'style'=>'text-decoration: none; color: black;padding:0 0 0 10px;'
                            ]); ?> &nbsp;&nbsp;<i class="fa fa-arrow-left"></i>
                    </a>


                </div>
            </div>
        </li>

    </ul>

</nav>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">

            <div class="info">
                <h4 class=" h4" style="color:white;">Eliyorbek Tojimatov</h4>
            </div>
        </div>

        <!-- Sidebar Menu -->
      <?=$this->render('_menus')?>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
<div class="content-wrapper">
<!--    <div class="content-header">-->
<!--        <div class="container-fluid">-->
<!--            <div class="row mb-2">-->
<!--                <div class="col-sm-6">-->
<!--                    <h1 class="m-0">Dashboard</h1>-->
<!--                </div>-->
<!--                <div class="col-sm-6">-->
<!--                    <ol class="breadcrumb float-sm-right">-->
<!--                        <li class="breadcrumb-item"><a href="#">Home</a></li>-->
<!--                        <li class="breadcrumb-item active">Dashboard v1</li>-->
<!--                    </ol>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->

    <section class="content">
        <div class="container-fluid pt-4">