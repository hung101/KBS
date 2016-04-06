<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanPermohonanPendidikan */

//$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::pengurusan_permohonan_pendidikan.': ' . ' ' . $model->pengurusan_permohonan_pendidikan_id;
$this->title = GeneralLabel::updateTitle . ' ' . GeneralLabel::permohonan_penganjuran_programkursusbengkel;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::permohonan_penganjuran_programkursusbengkel, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' ' . GeneralLabel::permohonan_penganjuran_programkursusbengkel, 'url' => ['view', 'id' => $model->pengurusan_permohonan_pendidikan_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-permohonan-pendidikan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
