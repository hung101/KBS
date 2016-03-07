<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PermohonanEBiasiswa */

//$this->title = 'Update Permohonan Ebiasiswa: ' . ' ' . $model->permohonan_e_biasiswa_id;
$this->title = GeneralLabel::updateTitle . ' Permohonan E-Biasiswa';
$this->params['breadcrumbs'][] = ['label' => 'Permohonan E-Biasiswa', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' Permohonan E-Biasiswa', 'url' => ['view', 'id' => $model->permohonan_e_biasiswa_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permohonan-ebiasiswa-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'searchModelPermohonanEBiasiswaPenyertaanKejohanan' => $searchModelPermohonanEBiasiswaPenyertaanKejohanan,
        'dataProviderPermohonanEBiasiswaPenyertaanKejohanan' => $dataProviderPermohonanEBiasiswaPenyertaanKejohanan,
        'readonly' => $readonly,
    ]) ?>

</div>
