<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PermohonanKemudahanTicketKapalTerbangAtletSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Permohonan Kemudahan Ticket Kapal Terbang Atlets';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permohonan-kemudahan-ticket-kapal-terbang-atlet-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Permohonan Kemudahan Ticket Kapal Terbang Atlet', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'permohonan_kemudahan_ticket_kapal_terbang_atlet_id',
            'permohonan_kemudahan_ticket_kapal_terbang_id',
            'atlet',
            'session_id',
            'created_by',
            // 'updated_by',
            // 'created',
            // 'updated',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
