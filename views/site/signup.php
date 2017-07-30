<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;

?>

<section >

    <div class="container container-middle">

        <div class="row row-middle">
            <div class="col-sm-3"></div>
            <div class="col-sm-6 ">
                <div class="login_wrap">
                    <h1>Регистрация</h1>

                    <?php $form = ActiveForm::begin([
                        'options' => ['class' => 'form-horizontal', 'id' => 'add'],
                        'fieldConfig' => [
                            'template' => "<div class=\"col-md-2\">{label}</div>\n<div class=\"col-md-10\">{input}</div>\n<div class=\"col-md-12 col-md-offset-2\">{error}</div>",
                            'labelOptions' => ['class' => 'control-label'],
                        ],
                    ]); ?>

                    <?= $form->field($signup_model, 'name')->textInput(['autofocus' => true])?>
                    <?= $form->field($signup_model, 'email')?>
                    <?= $form->field($signup_model, 'password')->passwordInput()?>
                    <?= Html::submitButton('Регистрация', ['class' => 'btn btn-success clearfix btn-sign']) ?>
                    <div class="signup">или <a class="singup_reg" href="<?= \yii\helpers\Url::to('/') ?>"> зайти на сайт!</a></div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>

            <div class="col-sm-3"></div>
        </div>

    </div>

</section>