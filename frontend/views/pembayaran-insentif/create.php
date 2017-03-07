<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PembayaranInsentif */

$this->title = GeneralLabel::createTitle . ' ' . GeneralLabel::pembayaran_insentif;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::pembayaran_insentif, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pembayaran-insentif-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'searchModelPembayaranInsentifAtlet' => $searchModelPembayaranInsentifAtlet,
        'dataProviderPembayaranInsentifAtlet' => $dataProviderPembayaranInsentifAtlet,
        'searchModelPembayaranInsentifJurulatih' => $searchModelPembayaranInsentifJurulatih,
        'dataProviderPembayaranInsentifJurulatih' => $dataProviderPembayaranInsentifJurulatih,
        'searchModelPembayaranInsentifPersatuan' => $searchModelPembayaranInsentifPersatuan,
        'dataProviderPembayaranInsentifPersatuan' => $dataProviderPembayaranInsentifPersatuan,
        'readonly' => $readonly,
    ]) ?>

</div>
