<h1>Проигрыватель</h1>

<?php if (Yii::$app->user->isGuest){ echo 'Guest'; } else{ debug( Yii::$app->user);} ?>

<a href="<?= Yii::$app->user->logout() ?>">Выйти</a>