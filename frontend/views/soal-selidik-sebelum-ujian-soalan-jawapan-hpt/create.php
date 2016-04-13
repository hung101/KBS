<?php

use app\models\general\GeneralLabel;

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\SoalSelidikSebelumUjianSoalanJawapan */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::soal_selidik_sebelum_ujian_soalan_jawapan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::soal_selidik_sebelum_ujian_soalan_jawapan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="soal-selidik-sebelum-ujian-soalan-jawapan-hpt-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
