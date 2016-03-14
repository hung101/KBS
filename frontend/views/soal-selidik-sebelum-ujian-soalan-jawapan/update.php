<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SoalSelidikSebelumUjianSoalanJawapan */

$this->title = 'Update Soal Selidik Sebelum Ujian Soalan Jawapan: ' . ' ' . $model->soal_selidik_sebelum_ujian_soalan_jawapan_id;
$this->params['breadcrumbs'][] = ['label' => 'Soal Selidik Sebelum Ujian Soalan Jawapans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->soal_selidik_sebelum_ujian_soalan_jawapan_id, 'url' => ['view', 'id' => $model->soal_selidik_sebelum_ujian_soalan_jawapan_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="soal-selidik-sebelum-ujian-soalan-jawapan-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
