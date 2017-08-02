<h1>Проигрыватель</h1>

<?php if (Yii::$app->user->isGuest) return Yii::$app->response->redirect(['/']);?>

<a href="<?= \yii\helpers\Url::to(['/site/logout']) ?>">Выйти</a>