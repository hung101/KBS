<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\User */

//$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::user.': ' . ' ' . $model->id;
$this->title = GeneralLabel::updateTitle . ' ' . GeneralLabel::e_biasiswa_public_user;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::e_biasiswa_public_user, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' ' . GeneralLabel::e_biasiswa_public_user, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
