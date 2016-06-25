<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PembayaranInsentif */

//$this->title = 'Update Pembayaran Insentif: ' . $model->pembayaran_insentif_id;
$this->title = GeneralLabel::updateTitle . ' ' . GeneralLabel::pembayaran_insentif;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::pembayaran_insentif, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' ' . GeneralLabel::pembayaran_insentif, 'url' => ['view', 'id' => $model->pembayaran_insentif_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pembayaran-insentif-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'searchModelPembayaranInsentifAtlet' => $searchModelPembayaranInsentifAtlet,
        'dataProviderPembayaranInsentifAtlet' => $dataProviderPembayaranInsentifAtlet,
        'readonly' => $readonly,
    ]) ?>

</div>
