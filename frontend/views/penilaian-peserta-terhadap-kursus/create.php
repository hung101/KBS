<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PenilaianPenganjurKursus */

$this->title = GeneralLabel::createTitle . ' ' . GeneralLabel::penilaian_peserta_terhadap_kursus;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::penilaian_peserta_terhadap_kursus, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="penilaian-peserta-terhadap-kursus-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'searchModelPenilaianPesertaTerhadapKursusSoalan' => $searchModelPenilaianPesertaTerhadapKursusSoalan,
        'dataProviderPenilaianPesertaTerhadapKursusSoalan' => $dataProviderPenilaianPesertaTerhadapKursusSoalan,
        'readonly' => $readonly,
    ]) ?>

</div>
