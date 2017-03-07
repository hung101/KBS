<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PembayaranInsentifPersatuan */

$this->title = 'Update Pembayaran Insentif Persatuan: ' . $model->pembayaran_insentif_persatuan_id;
$this->params['breadcrumbs'][] = ['label' => 'Pembayaran Insentif Persatuans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->pembayaran_insentif_persatuan_id, 'url' => ['view', 'id' => $model->pembayaran_insentif_persatuan_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pembayaran-insentif-persatuan-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
