<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PembayaranElaun */

//$this->title = 'Update Pembayaran Elaun: ' . ' ' . $model->pembayaran_elaun_id;
$this->title = GeneralLabel::updateTitle . ' Pembayaran Elaun';
$this->params['breadcrumbs'][] = ['label' => 'Pembayaran Elauns', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' Pembayaran Elaun', 'url' => ['view', 'id' => $model->pembayaran_elaun_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pembayaran-elaun-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
