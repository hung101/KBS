<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PermohonanKemudahanTicketKapalTerbangSukan */

$this->title = 'Create Permohonan Kemudahan Ticket Kapal Terbang Sukan';
$this->params['breadcrumbs'][] = ['label' => 'Permohonan Kemudahan Ticket Kapal Terbang Sukans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permohonan-kemudahan-ticket-kapal-terbang-sukan-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
