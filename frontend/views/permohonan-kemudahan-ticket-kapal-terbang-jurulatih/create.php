<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PermohonanKemudahanTicketKapalTerbangJurulatih */

$this->title = 'Create Permohonan Kemudahan Ticket Kapal Terbang Jurulatih';
$this->params['breadcrumbs'][] = ['label' => 'Permohonan Kemudahan Ticket Kapal Terbang Jurulatihs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permohonan-kemudahan-ticket-kapal-terbang-jurulatih-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
