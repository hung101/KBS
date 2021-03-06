<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PermohonanPenyelidikan Atlet::findOne($id)delete()*/

$this->title = GeneralLabel::createTitle . ' ' . GeneralLabel::permohonan_penyelidikan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::permohonan_penyelidikan, 'url' => ['index']];
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
        'searchModelBajetPenyelidikanSumbangan' => $searchModelBajetPenyelidikanSumbangan,
        'dataProviderBajetPenyelidikanSumbangan' => $dataProviderBajetPenyelidikanSumbangan,
        'readonly' => $readonly,
    ]) ?>

</div>
