<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PermohonanEBiasiswa */

$this->title = 'Permohonan E-Biasiswa';
//$this->params['breadcrumbs'][] = ['label' => 'Permohonan E-Biasiswa', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permohonan-ebiasiswa-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'searchModelPermohonanEBiasiswaPenyertaanKejohanan' => $searchModelPermohonanEBiasiswaPenyertaanKejohanan,
        'dataProviderPermohonanEBiasiswaPenyertaanKejohanan' => $dataProviderPermohonanEBiasiswaPenyertaanKejohanan,
        'readonly' => $readonly,
    ]) ?>

</div>
