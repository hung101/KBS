<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\BspPembayaran */

//$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::bsp_pembayaran.': ' . ' ' . $model->bsp_pembayaran_id;
$this->title = GeneralLabel::updateTitle . ' Pembayaran Biasiswa Sukan Persekutuan';
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::pembayaran_biasiswa_sukan_persekutuan, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' Pembayaran Biasiswa Sukan Persekutuan', 'url' => ['view', 'id' => $model->bsp_pembayaran_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bsp-pembayaran-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
