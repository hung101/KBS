<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\BspTamatPengesahanPengajian */

$this->title = 'Update Bsp Tamat Pengesahan Pengajian: ' . ' ' . $model->bsp_tamat_pengesahan_pengajian_id;
$this->params['breadcrumbs'][] = ['label' => 'Bsp Tamat Pengesahan Pengajians', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->bsp_tamat_pengesahan_pengajian_id, 'url' => ['view', 'id' => $model->bsp_tamat_pengesahan_pengajian_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="bsp-tamat-pengesahan-pengajian-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
