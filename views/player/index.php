<?php if (Yii::$app->user->isGuest) return Yii::$app->response->redirect(['/']); ?>

<?php

use yii\helpers\Html;
use yii\bootstrap\Modal;
use yii\widgets\ActiveForm;

?>

<section>

    <div class="container">

        <div class="row">
            <div class="col-sm-2"></div>
            <div class="col-sm-8 ">
                <div class="player_wrap">
                    <div class="row pad">
                        <div class="col-sm-10">
                            <h2>Привет, <?= $user['name'] ?></h2>
                            <h4>Аудиоплеер</h4>
                        </div>
                        <div class="col-sm-2">
                            <a href="<?= \yii\helpers\Url::to(['/site/logout']) ?>">Выйти</a>
                        </div>

                    </div>
                    <div class="row pad">
                        <div class="col-sm-5 player_block_1">
                            <div class="row">
                                <div class="col-sm-12 list-music pad">
                                    <div class="mini-menu">
                                        <ul>
                                            <li class="sub">
                                                <a href="#">Плейлисты</a>
                                                <ul>
                                                    <?php foreach ($user_playlist as $upl): ?>
                                                    <li><a href="#"><?= $upl['playlist_name'] . ' / ' . $playlist->attributes['id'] ?></a></li>
                                                    <?php endforeach; ?>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-1"></div>
                        <div class="col-sm-6">
                            <div class="row">
                                <div class="col-sm-12">

                                </div>
                            </div>
                            <div class="row music-button">
                                <div class="col-sm-12">

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row pad">
                        <div class="col-sm-12">

                            <?php
                            // Добавление плейлиста
                            Modal::begin([
                                'header' => '<h2>Плейлист</h2>',
                                'toggleButton' => [
                                    'label' => 'Добавить плейлист',
                                    'tag' => 'button',
                                    'class' => 'btn btn-success'
                                ],

                            ]);

                            $form = ActiveForm::begin([
                                'action' => '/playlist/add',
                                'options' => ['class' => 'form-horizontal'],
                                'fieldConfig' => [
                                    'template' => "<div class=\"col-md-4\">{label}</div>\n<div class=\"col-md-8\">{input}</div>\n<div class=\"col-md-12 col-md-offset-4\">{error}</div>",
                                    'labelOptions' => ['class' => 'control-label'],
                                ],
                            ]); ?>

                            <?= $form->field($playlist, 'playlist_name')->textInput(['autofocus' => true]) ?>
                            <?= Html::activeHiddenInput($playlist, 'user_id', ['value' => $user['id']]); ?>
                            <?= Html::submitButton('Добавить плейлист', ['class' => 'btn btn-success']) ?>
                            <?php ActiveForm::end(); ?>

                            <?php Modal::end(); ?>



                            <?php
                            // Добавление песни
                            Modal::begin([
                                'header' => '<h2>Аудиозапись</h2>',
                                'toggleButton' => [
                                    'label' => 'Добавить аудиозапись',
                                    'tag' => 'button',
                                    'class' => 'btn btn-success'
                                ],

                            ]);

                            $form = ActiveForm::begin([
                                'action' => '/player',
                                'options' => ['class' => 'form-horizontal', 'enctype' => 'multipart/form-data'],
                                'fieldConfig' => [
                                    'template' => "<div class=\"col-md-4\">{label}</div>\n<div class=\"col-md-8\">{input}</div>\n<div class=\"col-md-12 col-md-offset-4\">{error}</div>",
                                    'labelOptions' => ['class' => 'control-label'],
                                ],
                            ]); ?>

                            <?= $form->field($player, 'music_name')->textInput(['autofocus' => true, 'placeholder' => 'Будет отображаться вместо имени файла']) ?>
                            <?= $form->field($player, 'playlist_id')->dropdownList(
                                \app\models\Playlist::find()->select(['playlist_name', 'id'])->indexBy('id')->column(), ['prompt'=>'Выберите']
                            ) ?>
                            <?= $form->field($player, 'music_default_name_file')->fileInput() ?>
                            <?= Html::activeHiddenInput($player, 'user_id', ['value' => $user['id']]); ?>

                            <?= Html::submitButton('Добавить аудозапись', ['class' => 'btn btn-success']) ?>
                            <?php ActiveForm::end(); ?>

                            <?php Modal::end(); ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-2"></div>
        </div>

    </div>

</section>