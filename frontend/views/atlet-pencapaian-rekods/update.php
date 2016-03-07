<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AtletPencapaianRekods */

$this->title = 'Update Atlet Pencapaian Rekods: ' . ' ' . $model->pencapaian_rekods_id;
$this->params['breadcrumbs'][] = ['label' => 'Atlet Pencapaian Rekods', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->pencapaian_rekods_id, 'url' => ['view', 'id' => $model->pencapaian_rekods_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="atlet-pencapaian-rekods-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
