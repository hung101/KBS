<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PembayaranInsentifAtlet */

$this->title = 'Update Pembayaran Insentif Atlet: ' . $model->pembayaran_insentif_atlet_id;
$this->params['breadcrumbs'][] = ['label' => 'Pembayaran Insentif Atlets', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->pembayaran_insentif_atlet_id, 'url' => ['view', 'id' => $model->pembayaran_insentif_atlet_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pembayaran-insentif-atlet-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
