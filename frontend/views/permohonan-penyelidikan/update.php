<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PermohonanPenyelidikan */

//$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::permohonan_penyelidikan.': ' . ' ' . $model->permohonana_penyelidikan_id;
$this->title = GeneralLabel::updateTitle . ' ' . GeneralLabel::permohonan_penyelidikan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::permohonan_penyelidikan, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' ' . GeneralLabel::permohonan_penyelidikan, 'url' => ['view', 'id' => $model->permohonana_penyelidikan_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permohonan-penyelidikan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'searchModelPenyelidikanKomposisiPasukan' => $searchModelPenyelidikanKomposisiPasukan,
        'dataProviderPenyelidikanKomposisiPasukan' => $dataProviderPenyelidikanKomposisiPasukan,
        'searchModelDokumenPenyelidikan' => $searchModelDokumenPenyelidikan,
        'dataProviderDokumenPenyelidikan' => $dataProviderDokumenPenyelidikan,
        'searchModelBajetPenyelidikan' => $searchModelBajetPenyelidikan,
        'dataProviderBajetPenyelidikan' => $dataProviderBajetPenyelidikan,
        'searchModelBajetPenyelidikanSumbangan' => $searchModelBajetPenyelidikanSumbangan,
        'dataProviderBajetPenyelidikanSumbangan' => $dataProviderBajetPenyelidikanSumbangan,
        'readonly' => $readonly,
    ]) ?>

</div>
