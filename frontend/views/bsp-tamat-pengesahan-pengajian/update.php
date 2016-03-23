<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\BspTamatPengesahanPengajian */

//$this->title = 'Update Bsp Pengesahan Tamat Pengajian: ' . ' ' . $model->bsp_tamat_pengesahan_pengajian_id;
$this->title = GeneralLabel::updateTitle . ' ' . GeneralLabel::pengesahan_tamat_pengajian;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::pengesahan_tamat_pengajian, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' ' . GeneralLabel::pengesahan_tamat_pengajian, 'url' => ['view', 'id' => $model->bsp_tamat_pengesahan_pengajian_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="bsp-tamat-pengesahan-pengajian-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
