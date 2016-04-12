<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\SoalSelidikSebelumUjian */

//$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::soal_selidik_sebelum_ujian.': ' . ' ' . $model->soal_selidik_sebelum_ujian_id;
$this->title = GeneralLabel::updateTitle . ' ' . GeneralLabel::fisiologi_sistem_pangkalan_data_atlet_dan_journal;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::fisiologi_sistem_pangkalan_data_atlet_dan_journal, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' ' . GeneralLabel::fisiologi_sistem_pangkalan_data_atlet_dan_journal, 'url' => ['view', 'id' => $model->soal_selidik_sebelum_ujian_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="soal-selidik-sebelum-ujian-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'searchModelSoalSelidikSebelumUjianSoalanJawapan' => $searchModelSoalSelidikSebelumUjianSoalanJawapan,
        'dataProviderSoalSelidikSebelumUjianSoalanJawapan' => $dataProviderSoalSelidikSebelumUjianSoalanJawapan,
        'readonly' => $readonly,
    ]) ?>

</div>
