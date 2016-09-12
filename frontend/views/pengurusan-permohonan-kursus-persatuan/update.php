<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanPermohonanKursusPersatuan */

//$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::permohonan_penganjuran.': ' . ' ' . $model->pengurusan_permohonan_kursus_persatuan_id;
$this->title = GeneralLabel::updateTitle . ' ' . GeneralLabel::permohonan_penganjuran;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::permohonan_penganjuran, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' ' . GeneralLabel::permohonan_penganjuran, 'url' => ['view', 'id' => $model->pengurusan_permohonan_kursus_persatuan_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-permohonan-kursus-persatuan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'searchModelPengurusanPermohonanKursusPersatuanPenasihat' => $searchModelPengurusanPermohonanKursusPersatuanPenasihat,
        'dataProviderPengurusanPermohonanKursusPersatuanPenasihat' => $dataProviderPengurusanPermohonanKursusPersatuanPenasihat,
        'readonly' => $readonly,
    ]) ?>

</div>
