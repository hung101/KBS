<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AtletAset */

//$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::atlet_aset.': ' . ' ' . $model->aset_id;
$this->title = GeneralLabel::updateTitle.' '.'Aset';
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::atlet_asets, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->aset_id, 'url' => ['view', 'id' => $model->aset_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="atlet-aset-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
