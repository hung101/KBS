<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ElaporanDokumenSokongan */

$this->title = 'Update Elaporan Dokumen Sokongan: ' . ' ' . $model->elaporan_dokumen_sokongan_id;
$this->params['breadcrumbs'][] = ['label' => 'Elaporan Dokumen Sokongans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->elaporan_dokumen_sokongan_id, 'url' => ['view', 'id' => $model->elaporan_dokumen_sokongan_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="elaporan-dokumen-sokongan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
