<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PermohonanPenyelidikan */

//$this->title = 'Update Permohonan Penyelidikan: ' . ' ' . $model->permohonana_penyelidikan_id;
$this->title = GeneralLabel::updateTitle . ' Permohonan Penyelidikan';
$this->params['breadcrumbs'][] = ['label' => 'Permohonan Penyelidikan', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::updateTitle . ' Permohonan Penyelidikan', 'url' => ['view', 'id' => $model->permohonana_penyelidikan_id]];
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
        'readonly' => $readonly,
    ]) ?>

</div>
