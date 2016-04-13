<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\SoalSelidikSebelumUjianHpt */

$this->title = GeneralLabel::createTitle . ' ' . GeneralLabel::soal_selidik_sebelum_ujian_hpt;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::soal_selidik_sebelum_ujian_hpt, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="soal-selidik-sebelum-ujian-hpt-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'searchModelSoalSelidikSebelumUjianSoalanJawapanHpt' => $searchModelSoalSelidikSebelumUjianSoalanJawapanHpt,
        'dataProviderSoalSelidikSebelumUjianSoalanJawapanHpt' => $dataProviderSoalSelidikSebelumUjianSoalanJawapanHpt,
        'readonly' => $readonly,
    ]) ?>

</div>
