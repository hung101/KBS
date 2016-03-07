<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\SoalSelidikSebelumUjian */

//$this->title = 'Update Soal Selidik Sebelum Ujian: ' . ' ' . $model->soal_selidik_sebelum_ujian_id;
$this->title = GeneralLabel::updateTitle . ' Soal Selidik Sebelum Ujian';
$this->params['breadcrumbs'][] = ['label' => 'Soal Selidik Sebelum Ujian', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' Soal Selidik Sebelum Ujian', 'url' => ['view', 'id' => $model->soal_selidik_sebelum_ujian_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="soal-selidik-sebelum-ujian-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
