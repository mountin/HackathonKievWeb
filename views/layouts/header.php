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
    .site-about{
        padding: 15px;
    }
    .content-wrapper{
        /*padding: 15px;*/
    }
</style>
<header class="main-header">

    <?= Html::a('<span class="logo-mini">APP</span><span class="logo-lg"><img src="'.Yii::$app->request->hostInfo.'/img/logo1.jpg" border="0">'  . '</span>', Yii::$app->request->hostInfo, ['class' => 'logo']) ?>

    <nav class="navbar navbar-static-top" role="navigation">

        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">
                <li class="dropdown tasks-menu">

                    <a href="<?=Yii::$app->request->hostInfo;?>/site/add" style="background-color: #FF5610">
                        <i class="fa fa-plus-o" style="color: white; font-weight: normal; font-family: Verdana"; >+ Додати пункт</i>
                    </a>

</ul>
        </div>
    </nav>
</header>
