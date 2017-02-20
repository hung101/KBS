<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PermohonanKemudahanTicketKapalTerbangPengurusSukan */

$this->title = 'Update Permohonan Kemudahan Ticket Kapal Terbang Pengurus Sukan: ' . $model->permohonan_kemudahan_ticket_kapal_terbang_pengurus_sukan_id;
$this->params['breadcrumbs'][] = ['label' => 'Permohonan Kemudahan Ticket Kapal Terbang Pengurus Sukan', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->permohonan_kemudahan_ticket_kapal_terbang_pengurus_sukan_id, 'url' => ['view', 'id' => $model->permohonan_kemudahan_ticket_kapal_terbang_pengurus_sukan_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="permohonan-kemudahan-ticket-kapal-terbang-pengurus-sukan-update">

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
