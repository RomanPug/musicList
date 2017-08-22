<?php if (Yii::$app->user->isGuest) return Yii::$app->response->redirect(['/']); ?>

<?php

use yii\helpers\Html;
use yii\bootstrap\Modal;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

$this->title = 'Аудиоплеер';

?>
<?php static $fm; ?>
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
                            <?= Html::a('Выйти', ['/site/logout'], ['class'=>'btn btn-danger exit']) ?>
                        </div>
                    </div>
                    <div class="row pad">
                        <div class="col-sm-5 player_block_1">
                            <div class="row">
                                <div class="col-sm-12 list-music pad">
                                    <div class="mini-menu">
                                        <h5>Плейлисты</h5>
                                        <ul>
                                            <?php foreach ($user_playlist as $upl): ?>
                                                <li>
                                                    <a href="<?= Url::to(['/player', 'playlist_id' => $upl['id']]) ?>"
                                                       data="<?= $upl['id'] ?>"><?= $upl['playlist_name'] ?></a>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-1 special"></div>
                        <div class="col-sm-6 player_block_1">
                            <div class="row">
                                <div class="col-sm-12 player-music pad">
                                    <div class="mini-menu-player">
                                        <h5>Аудиозаписи</h5>
                                        <?php $r ?>
                                        <?php if (count($find_music) === 0): ?>
                                            <p> Тут аудио пока нет. Добавте песню в этот плейлист</p>
                                        <?php else: ?>
                                        <ul class="playlist">
                                            <?php foreach ($find_music as $fm): ?>
                                                <li audiourl="uploads/<?= $fm['playlist_id'] ?>/<?= $fm['music_default_name'] ?>.mp3">
                                                    <?= $fm['music_name'] ?>
                                                </li>
                                            <?php endforeach; ?>

                                            <?php endif; ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <?php if (count($find_music) != 0): ?>
                                    <div class="player">
                                        <div class="title"></div>
                                        <div class="controls">
                                            <div class="play"></div>
                                            <div class="pause"></div>
                                            <div class="rew"></div>
                                            <div class="fwd"></div>
                                        </div>
                                        <div class="volume_block">
                                            <input class="volume" id="volume" type="range" min="0" max="100" value="80">
                                        </div>
                                        <div class="time_block">
                                            <span class="curtime" id="curtime">00:00</span>
                                            <div class="tracker ui-state"></div>
                                            <span class="durtime" id="durtime">00:00</span>
                                            <!--                                            <div class="mute" id="mute">Mute</div>-->
                                        </div>
                                    </div>
                                    <?php endif; ?>
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
                                \app\models\Playlist::find()->select(['playlist_name', 'id'])->indexBy('id')->column(), ['prompt' => 'Выберите']
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