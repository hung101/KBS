<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PermohonanKemudahanTicketKapalTerbangAtlet */

$this->title = 'Update Permohonan Kemudahan Ticket Kapal Terbang Atlet: ' . $model->permohonan_kemudahan_ticket_kapal_terbang_atlet_id;
$this->params['breadcrumbs'][] = ['label' => 'Permohonan Kemudahan Ticket Kapal Terbang Atlets', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->permohonan_kemudahan_ticket_kapal_terbang_atlet_id, 'url' => ['view', 'id' => $model->permohonan_kemudahan_ticket_kapal_terbang_atlet_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="permohonan-kemudahan-ticket-kapal-terbang-atlet-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
