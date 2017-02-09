<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PermohonanKemudahanTicketKapalTerbangAtlet */

$this->title = 'Create Permohonan Kemudahan Ticket Kapal Terbang Atlet';
$this->params['breadcrumbs'][] = ['label' => 'Permohonan Kemudahan Ticket Kapal Terbang Atlets', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permohonan-kemudahan-ticket-kapal-terbang-atlet-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
