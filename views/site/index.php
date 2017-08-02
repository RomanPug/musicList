<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>
<section>

    <div class="container container-middle">

        <div class="row row-middle">
            <div class="col-sm-3"></div>
            <div class="col-sm-6 ">
                <div class="login_wrap">
                    <h1>Войдите на сайт</h1>
                    <?php $form = ActiveForm::begin([
                        'id' => 'login-form',
                        'options' => ['class' => 'form-horizontal'],
                        'fieldConfig' => [
                            'template' => "<div class=\"col-md-2\">{label}</div>\n<div class=\"col-md-10\">{input}</div>\n<div class=\"col-md-12 col-md-offset-2\">{error}</div>",
                            'labelOptions' => ['class' => 'control-label'],
                        ],
                    ]); ?>

                    <?= $form->field($login_model, 'email')->textInput(['autofocus' => true]) ?>
                    <?= $form->field($login_model, 'password')->passwordInput() ?>
                    <?= $form->field($login_model, 'rememberMe')->checkbox([
                        'template' => "<div class=\"col-lg-offset-1 col-lg-3\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
                    ]) ?>
                    <?= Html::submitButton('Войти', ['class' => 'btn btn-success btn-sign clearfix ']) ?>
                    <div class="signup">или <a class="singup_reg" href="<?= \yii\helpers\Url::to('signup') ?>">
                            зарегестрироваться!</a></div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>

            <div class="col-sm-3"></div>
        </div>

    </div>

</section>