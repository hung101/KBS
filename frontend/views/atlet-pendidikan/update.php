<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AtletPendidikan */

//$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::pendidikan.': ' . ' ' . $model->pendidikan_atlet_id;
$this->title = GeneralLabel::updateTitle.' '.'Pendidikan';
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::pendidikan, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->pendidikan_atlet_id, 'url' => ['view', 'id' => $model->pendidikan_atlet_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="atlet-pendidikan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
