<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\PermohonanKemudahanTicketKapalTerbangPegawai */

$this->title = $model->pembayaran_elaun_transaksi_id;
$this->params['breadcrumbs'][] = ['label' => 'Pembayaran Elaun Transaksi', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permohonan-kemudahan-ticket-kapal-terbang-pegawai-view">

    <!--<h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->pembayaran_elaun_transaksi_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->pembayaran_elaun_transaksi_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>-->
    
    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

    <?php /*echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'permohonan_kemudahan_ticket_kapal_terbang_pegawai_id',
            'permohonan_kemudahan_ticket_kapal_terbang_id',
            'pegawai',
            'session_id',
            'created_by',
            'updated_by',
            'created',
            'updated',
        ],
    ]);*/ ?>

</div>
