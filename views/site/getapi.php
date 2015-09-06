<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        Ви можете скорисатись нашими данними, використовуючi наш API:
    </p>

    <code>http://146.185.190.210:3000</code>
    або за посиланням: http://cleancity.ml


    <br/><br/><br/>
    Приклад ajax code:
    <code>
    $.ajax({
    type: 'GET',
    url: 'http://146.185.190.210:3000/locations',
    crossDomain: true,
    dataType: 'jsonp',
    success: function(res){
    console.log(res);
    }
    });
    </code>







</div>
