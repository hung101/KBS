<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\KursusPersatuan */

//$this->title = 'Update Kursus Persatuan: ' . ' ' . $model->kursus_persatuan_id;
$this->title = GeneralLabel::updateTitle . ' Kursus Persatuan';
$this->params['breadcrumbs'][] = ['label' => 'Kursus Persatuan', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' Kursus Persatuan', 'url' => ['view', 'id' => $model->kursus_persatuan_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kursus-persatuan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'searchModelTempahanKursusPersatuan' => $searchModelTempahanKursusPersatuan,
        'dataProviderTempahanKursusPersatuan' => $dataProviderTempahanKursusPersatuan,
        'searchModelPengurusanKosKursusPersatuan' => $searchModelPengurusanKosKursusPersatuan,
        'dataProviderPengurusanKosKursusPersatuan' => $dataProviderPengurusanKosKursusPersatuan,
        'readonly' => $readonly,
    ]) ?>

</div>
