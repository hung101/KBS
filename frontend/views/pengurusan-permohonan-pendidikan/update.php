<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanPermohonanPendidikan */

//$this->title = 'Update Pengurusan Permohonan Pendidikan: ' . ' ' . $model->pengurusan_permohonan_pendidikan_id;
$this->title = GeneralLabel::updateTitle . ' Permohonan Penganjuran Program/Kursus/Bengkel';
$this->params['breadcrumbs'][] = ['label' => 'Permohonan Penganjuran Program/Kursus/Bengkel', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' Permohonan Penganjuran Program/Kursus/Bengkel', 'url' => ['view', 'id' => $model->pengurusan_permohonan_pendidikan_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-permohonan-pendidikan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
