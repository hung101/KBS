<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefKerjaPengurusanKemudahanPeralatan */

$this->title = 'Update Ref Kerja Pengurusan Kemudahan Peralatan: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Kerja Pengurusan Kemudahan Peralatans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-kerja-pengurusan-kemudahan-peralatan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
