<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\BspPembayaran */

$this->title = 'Update Bsp Pembayaran: ' . ' ' . $model->bsp_pembayaran_id;
$this->params['breadcrumbs'][] = ['label' => 'Bsp Pembayarans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->bsp_pembayaran_id, 'url' => ['view', 'id' => $model->bsp_pembayaran_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="bsp-pembayaran-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
