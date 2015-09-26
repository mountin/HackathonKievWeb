<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\AddpointForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

//use PetraBarus\Yii2\GooglePlacesAutoComplete\GooglePlacesAutoComplete;
use app\components\GooglePlacesAutoComplete;


$this->title = 'Додати точку';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">
    <h1 style="text-align:center; padding:30px 0"><?= Html::encode($this->title) ?></h1>

    <?php if (Yii::$app->session->hasFlash('addpointFormSubmitted')): ?>

        <div class="alert alert-success">
            Дякуємо Ваш за вклад у нашу базу данних, ваша точко з'явиться на карті найближчим часом.
        </div>

    <?php elseif (Yii::$app->session->hasFlash('addpointFormError')): ?>

        <div class="alert alert-error">
            Щось трапилось - ваша точка не додалася!
        </div>
    <?php else: ?>
        <div class="row">
            <div class="col-lg-5" style="margin-left:20px;">

                <?php $form = ActiveForm::begin(['id' => 'addpoint-form']); ?>
                   
                    <?= $form->field($model, 'name') ?>
                    <?= $form->field($model, 'address') ?>

                    <?php GooglePlacesAutoComplete::widget([
                        'name' => 'AddpointForm[address]',
                        'value' => 'Велика Васильківська, 57/3',
                        'id' => 'addpointform-address',
                        'class' => 'form-control',
                    ]) ?>

                    <?php echo $form->field($model, 'type')->dropDownList(['battery' => 'Батарейки', 'glass' => 'Скло']); ?>
                    <?= $form->field($model, 'longitude')->hiddenInput()->label(false) ?>
                    <?= $form->field($model, 'latitude')->hiddenInput()->label(false) ?>
                    <?= $form->field($model, 'phone') ?>

            </div>

            <div class="col-lg-6" style="margin-left:20px;">
            
                    <?= $form->field($model, 'comment')->textArea(['rows' => 11]) ?>

            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-10" style="margin:20px 0 10px 20px; text-align:center;">
                <div class="form-group">
                    <?= Html::submitButton('Відправити', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>

    <?php endif; ?>
</div>

