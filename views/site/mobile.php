<?php
/**
 * Created by PhpStorm.
 * User: mountin
 * Date: 09.09.15
 * Time: 1:27
 */
use yii\helpers\Html;

$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
       Допоможiть нам зробити гарне мобiльний додаток! Приймiть учать у тестуваннi на подiлiться своiми враженнями: </br>
        <a href="https://play.google.com/apps/testing/com.goodcodeforfun.cleancitybattery">https://play.google.com/apps/testing/com.goodcodeforfun.cleancitybattery</a>
    </p>

    <code><?= __FILE__ ?></code>
</div>
