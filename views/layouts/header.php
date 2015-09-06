<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;

/* @var $this \yii\web\View */
/* @var $content string */
//$this->registerJsFile('/css/myskin.css');
?>
<style>
    .skin-black .main-header > .logo {

        background-color: #2DC100 !important;
        color: #EEEEEE !important;
        border-bottom: 0 solid transparent !important;
        border-right: 1px solid #eee !important;
        font-family: open-sans;
        font-size: 12;
    }
    .content-wrapper{
        padding: 15px;
    }
</style>
<header class="main-header">

    <?= Html::a('<span class="logo-mini">APP</span><span class="logo-lg"><img src="http://greenapi.loc/img/logo1.jpg" border="0">'  . '</span>', Yii::$app->homeUrl, ['class' => 'logo']) ?>

    <nav class="navbar navbar-static-top" role="navigation">

        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">


        </div>
    </nav>
</header>
