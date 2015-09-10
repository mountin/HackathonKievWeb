<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Про команду';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        Команда яка процювала над проектом:<br/>
        <img src="<?=Yii::$app->request->hostInfo;?>/img/team.jpg">
    </p>

    <code>Далi буде...</code>
</div>
