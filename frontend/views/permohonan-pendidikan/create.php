<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PermohonanPendidikan */

$this->title = GeneralLabel::createTitle . ' ' . GeneralLabel::permohonan_pendidikan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::permohonan_pendidikan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permohonan-pendidikan-create">

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
