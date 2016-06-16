<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PermohonanPelantikanSue */

$this->title = 'Update Permohonan Pelantikan Sue: ' . $model->permohonan_pelantikan_sue_id;
$this->params['breadcrumbs'][] = ['label' => 'Permohonan Pelantikan Sues', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->permohonan_pelantikan_sue_id, 'url' => ['view', 'id' => $model->permohonan_pelantikan_sue_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="permohonan-pelantikan-sue-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
