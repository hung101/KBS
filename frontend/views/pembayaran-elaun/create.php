<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PembayaranElaun */

$this->title = GeneralLabel::createTitle . ' ' . GeneralLabel::pembayaran_elaun;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::pembayaran_elaun, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pembayaran-elaun-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'searchModelPembayaranElaunTransaksi' => $searchModelPembayaranElaunTransaksi,
        'dataProviderPembayaranElaunTransaksi' => $dataProviderPembayaranElaunTransaksi,
        'readonly' => $readonly,
    ]) ?>

</div>
