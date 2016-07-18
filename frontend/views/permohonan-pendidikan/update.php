<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PermohonanPendidikan */

//$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::permohonan_pendidikan.': ' . ' ' . $model->permohonan_pendidikan_id;
$this->title = GeneralLabel::updateTitle . ' ' . GeneralLabel::permohonan_pendidikan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::permohonan_pendidikan, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' ' . GeneralLabel::permohonan_pendidikan, 'url' => ['view', 'id' => $model->permohonan_pendidikan_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permohonan-pendidikan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'searchModelPermohonanPendidikanKeputusanSpm' => $searchModelPermohonanPendidikanKeputusanSpm,
        'dataProviderPermohonanPendidikanKeputusanSpm' => $dataProviderPermohonanPendidikanKeputusanSpm,
        'searchModelPermohonanPendidikanKursusPengajian' => $searchModelPermohonanPendidikanKursusPengajian,
        'dataProviderPermohonanPendidikanKursusPengajian' => $dataProviderPermohonanPendidikanKursusPengajian,
        'readonly' => $readonly,
    ]) ?>

</div>
