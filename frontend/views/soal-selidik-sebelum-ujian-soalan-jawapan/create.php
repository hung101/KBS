<?php

use app\models\general\GeneralLabel;

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\SoalSelidikSebelumUjianSoalanJawapan */

$this->title = GeneralLabel::createTitle.' '.'Soal Selidik Sebelum Ujian Soalan Jawapan';
$this->params['breadcrumbs'][] = ['label' => 'Soal Selidik Sebelum Ujian Soalan Jawapans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="soal-selidik-sebelum-ujian-soalan-jawapan-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
