<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PenilaianPenganjurKursus */

//$this->title = 'Update Penilaian Penganjur Kursus: ' . $model->penilaian_penganjur_kursus_id;
$this->title = GeneralLabel::updateTitle . ' ' . GeneralLabel::penilaian_penganjur_kursus;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::penilaian_penganjur_kursus, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' ' . GeneralLabel::penilaian_penganjur_kursus, 'url' => ['view', 'id' => $model->penilaian_penganjur_kursus_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="penilaian-penganjur-kursus-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'searchModelPenilaianPenganjurKursusSoalan' => $searchModelPenilaianPenganjurKursusSoalan,
        'dataProviderPenilaianPenganjurKursusSoalan' => $dataProviderPenilaianPenganjurKursusSoalan,
        'readonly' => $readonly,
    ]) ?>

</div>
