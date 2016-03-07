<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PermohonanPenyelidikan */

$this->title = GeneralLabel::createTitle . ' Permohonan Penyelidikan';
$this->params['breadcrumbs'][] = ['label' => 'Permohonan Penyelidikan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permohonan-penyelidikan-create">

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
