<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PermohonanPerganjuran */

//$this->title = 'Update Permohonan Perganjuran: ' . ' ' . $model->permohonan_perganjuran_id;
$this->title = GeneralLabel::updateTitle . ' Permohonan Penganjuran';
$this->params['breadcrumbs'][] = ['label' => 'Permohonan Penganjuran', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' Permohonan Penganjuran', 'url' => ['view', 'id' => $model->permohonan_perganjuran_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permohonan-perganjuran-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'searchModelPermohonanPerganjuranInstructor' => $searchModelPermohonanPerganjuranInstructor,
        'dataProviderPermohonanPerganjuranInstructor' => $dataProviderPermohonanPerganjuranInstructor,
        'searchModelPermohonanPenganjuranKos' => $searchModelPermohonanPenganjuranKos,
        'dataProviderPermohonanPenganjuranKos' => $dataProviderPermohonanPenganjuranKos,
        'readonly' => $readonly,
    ]) ?>

</div>
