<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefStatusBantuanPenyertaanPegawaiTeknikal */

$this->title = 'Update Ref Status Bantuan Penyertaan Pegawai Teknikal: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Status Bantuan Penyertaan Pegawai Teknikals', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-status-bantuan-penyertaan-pegawai-teknikal-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
