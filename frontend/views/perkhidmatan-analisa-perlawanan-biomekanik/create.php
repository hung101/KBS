<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PerkhidmatanAnalisaPerlawananBiomekanik */

$this->title = GeneralLabel::createTitle . ' Perkhidmatan Analisa Perlawanan/Biomekanik';
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::perkhidmatan_analisa_perlawananbiomekanik, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="perkhidmatan-analisa-perlawanan-biomekanik-create">

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
