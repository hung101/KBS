<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = GeneralLabel::createTitle . ' ' . GeneralLabel::e_bantuan_public_user;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::e_bantuan_public_user, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
