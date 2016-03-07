<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanPermohonanKursusPersatuan */

//$this->title = 'Update Pengurusan Permohonan Kursus Persatuan: ' . ' ' . $model->pengurusan_permohonan_kursus_persatuan_id;
$this->title = GeneralLabel::updateTitle . ' Pengurusan Permohonan Kursus Persatuan';
$this->params['breadcrumbs'][] = ['label' => 'Pengurusan Permohonan Kursus Persatuan', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' Pengurusan Permohonan Kursus Persatuan', 'url' => ['view', 'id' => $model->pengurusan_permohonan_kursus_persatuan_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-permohonan-kursus-persatuan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
