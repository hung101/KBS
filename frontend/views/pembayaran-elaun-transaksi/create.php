<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PermohonanKemudahanTicketKapalTerbangPegawai */

$this->title = 'Create Pembayaran Elaun Transaksi';
$this->params['breadcrumbs'][] = ['label' => 'Create Pembayaran Elaun Transaksi', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permohonan-kemudahan-ticket-kapal-terbang-pegawai-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
