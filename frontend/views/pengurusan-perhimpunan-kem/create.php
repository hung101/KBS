<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanPerhimpunanKem */

$this->title = GeneralLabel::createTitle . ' '.GeneralLabel::bantuan_geran_penganjuran;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::bantuan_geran_penganjuran, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-perhimpunan-kem-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'searchModelPerhimpunanKemKos' => $searchModelPerhimpunanKemKos,
        'dataProviderPerhimpunanKemKos' => $dataProviderPerhimpunanKemKos,
        'searchModelPerhimpunanKemPeserta' => $searchModelPerhimpunanKemPeserta,
        'dataProviderPerhimpunanKemPeserta' => $dataProviderPerhimpunanKemPeserta,
        'readonly' => $readonly,
    ]) ?>

</div>
