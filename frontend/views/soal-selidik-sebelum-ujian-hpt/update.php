<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\SoalSelidikSebelumUjianHpt */

//$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::soal_selidik_sebelum_ujian.': ' . ' ' . $model->soal_selidik_sebelum_ujian_id;
$this->title = GeneralLabel::updateTitle . ' ' . GeneralLabel::soal_selidik_sebelum_ujian_hpt;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::soal_selidik_sebelum_ujian_hpt, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' ' . GeneralLabel::soal_selidik_sebelum_ujian_hpt, 'url' => ['view', 'id' => $model->soal_selidik_sebelum_ujian_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="soal-selidik-sebelum-ujian-hpt-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'searchModelSoalSelidikSebelumUjianSoalanJawapanHpt' => $searchModelSoalSelidikSebelumUjianSoalanJawapanHpt,
        'dataProviderSoalSelidikSebelumUjianSoalanJawapanHpt' => $dataProviderSoalSelidikSebelumUjianSoalanJawapanHpt,
        'readonly' => $readonly,
    ]) ?>

</div>
