<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PermohonanKemudahanTicketKapalTerbangSukan */

$this->title = 'Update Permohonan Kemudahan Ticket Kapal Terbang Sukan: ' . $model->permohonan_kemudahan_ticket_kapal_terbang_sukan_id;
$this->params['breadcrumbs'][] = ['label' => 'Permohonan Kemudahan Ticket Kapal Terbang Sukans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->permohonan_kemudahan_ticket_kapal_terbang_sukan_id, 'url' => ['view', 'id' => $model->permohonan_kemudahan_ticket_kapal_terbang_sukan_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="permohonan-kemudahan-ticket-kapal-terbang-sukan-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
