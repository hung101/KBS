<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PermohonanPerganjuran */

//$this->title = GeneralLabel::tambah_permohonan_kursus_teknikal_;
$this->title = GeneralLabel::createTitle . ' Permohonan Penganjuran';
//$this->params['breadcrumbs'][] = ['label' => GeneralLabel::permohonan_kursus_teknikal, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::permohonan_penganjuran, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permohonan-perganjuran-create">

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
