<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PenilaianPenganjurKursus */

//$this->title = 'Update Penilaian Penganjur Kursus: ' . $model->penilaian_peserta_terhadap_kursus_id;
$this->title = GeneralLabel::updateTitle . ' ' . GeneralLabel::penilaian_peserta_terhadap_kursus;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::penilaian_peserta_terhadap_kursus, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' ' . GeneralLabel::penilaian_peserta_terhadap_kursus, 'url' => ['view', 'id' => $model->penilaian_peserta_terhadap_kursus_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="penilaian-peserta-terhadap-kursus-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'searchModelPenilaianPesertaTerhadapKursusSoalan' => $searchModelPenilaianPesertaTerhadapKursusSoalan,
        'dataProviderPenilaianPesertaTerhadapKursusSoalan' => $dataProviderPenilaianPesertaTerhadapKursusSoalan,
        'readonly' => $readonly,
    ]) ?>

</div>
