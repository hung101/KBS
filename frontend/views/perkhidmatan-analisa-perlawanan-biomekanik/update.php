<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PerkhidmatanAnalisaPerlawananBiomekanik */

//$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::perkhidmatan_analisa_perlawanan_biomekanik.': ' . ' ' . $model->perkhidmatan_analisa_perlawanan_biomekanik_id;
$this->title = GeneralLabel::updateTitle . ' Perkhidmatan Analisa Perlawanan/Biomekanik';
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::perkhidmatan_analisa_perlawananbiomekanik, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' Perkhidmatan Analisa Perlawanan/Biomekanik', 'url' => ['view', 'id' => $model->perkhidmatan_analisa_perlawanan_biomekanik_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="perkhidmatan-analisa-perlawanan-biomekanik-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'searchModelBiomekanikUjian' => $searchModelBiomekanikUjian,
        'dataProviderBiomekanikUjian' => $dataProviderBiomekanikUjian,
        'searchModelBiomekanikAnthropometrics' => $searchModelBiomekanikAnthropometrics,
        'dataProviderBiomekanikAnthropometrics' => $dataProviderBiomekanikAnthropometrics,
        'readonly' => $readonly,
    ]) ?>

</div>
