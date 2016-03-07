<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\BspDokumenSokongan */

$this->title = 'Update Bsp Dokumen Sokongan: ' . ' ' . $model->bsp_dokumen_sokongan_id;
$this->params['breadcrumbs'][] = ['label' => 'Bsp Dokumen Sokongans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->bsp_dokumen_sokongan_id, 'url' => ['view', 'id' => $model->bsp_dokumen_sokongan_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="bsp-dokumen-sokongan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
