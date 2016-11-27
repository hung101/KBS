<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PermohonanEBiasiswa */

$this->title = GeneralLabel::permohonan_e_biasiswa;
//$this->params['breadcrumbs'][] = ['label' => 'e-Biasiswa', 'url' => ['site/e-biasiswa-home']];
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
