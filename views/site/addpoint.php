<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\AddpointForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

use yii\helpers\ArrayHelper;

use app\models\AddpointForm;

$this->title = 'Додати точку';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">
    <h1 style="text-align:center;"><?= Html::encode($this->title) ?></h1>

    <?php if (Yii::$app->session->hasFlash('addpointFormSubmitted')): ?>

        <div class="alert alert-success">
            Thank you for contacting us. We will respond to you as soon as possible.
        </div>

    <?php else: ?>

        <div class="row">
            <div class="col-lg-5" style="margin-left:20px;">

                <?php $form = ActiveForm::begin(['id' => 'addpoint-form']); ?>

                   
                        <?php echo $form->field($model, 'name')->dropDownList(['a' => 'Item A', 'b' => 'Item B', 'c' => 'Item C']); ?>
                        <? echo $form->field($model, 'name')->dropDownList($listData, ['prompt'=>'Choose...']);>

                    <?= $form->field($model, 'name') ?>
                    <?= $form->field($model, 'longitude') ?>
                    <?= $form->field($model, 'latitude') ?>
                    <?= $form->field($model, 'type') ?>
                    <?= $form->field($model, 'phone') ?>
                    <?= $form->field($model, 'address') ?>

                    <?= $form->field($model, 'comment')->textArea(['rows' => 6]) ?>

                    <div class="form-group">
                        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                    </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>

    <?php endif; ?>
</div>
