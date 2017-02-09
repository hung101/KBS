<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\PermohonanKemudahanTicketKapalTerbangSukan */

$this->title = $model->permohonan_kemudahan_ticket_kapal_terbang_sukan_id;
$this->params['breadcrumbs'][] = ['label' => 'Permohonan Kemudahan Ticket Kapal Terbang Sukans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permohonan-kemudahan-ticket-kapal-terbang-sukan-view">

    <!--<h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->permohonan_kemudahan_ticket_kapal_terbang_sukan_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->permohonan_kemudahan_ticket_kapal_terbang_sukan_id], [
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
            'permohonan_kemudahan_ticket_kapal_terbang_sukan_id',
            'permohonan_kemudahan_ticket_kapal_terbang_id',
            'sukan',
            'session_id',
            'created_by',
            'updated_by',
            'created',
            'updated',
        ],
    ]);*/ ?>

</div>
