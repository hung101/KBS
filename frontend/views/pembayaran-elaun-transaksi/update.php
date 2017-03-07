<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PermohonanKemudahanTicketKapalTerbangPegawai */

$this->title = 'Update Pembayaran Elaun Transaksi: ' . $model->pembayaran_elaun_transaksi_id;
$this->params['breadcrumbs'][] = ['label' => 'Pembayaran Elaun Transaksi', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->pembayaran_elaun_transaksi_id, 'url' => ['view', 'id' => $model->pembayaran_elaun_transaksi_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="permohonan-kemudahan-ticket-kapal-terbang-pegawai-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
