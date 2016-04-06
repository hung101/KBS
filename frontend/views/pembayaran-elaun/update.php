<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PembayaranElaun */

//$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::pembayaran_elaun.': ' . ' ' . $model->pembayaran_elaun_id;
$this->title = GeneralLabel::updateTitle . ' ' . GeneralLabel::pembayaran_elaun;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::pembayaran_elaun, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' ' . GeneralLabel::pembayaran_elaun, 'url' => ['view', 'id' => $model->pembayaran_elaun_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pembayaran-elaun-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
