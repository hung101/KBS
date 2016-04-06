<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\KursusPersatuan */

//$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::kursus_persatuan.': ' . ' ' . $model->kursus_persatuan_id;
$this->title = GeneralLabel::updateTitle . ' ' . GeneralLabel::kursus_persatuan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::kursus_persatuan, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' ' . GeneralLabel::kursus_persatuan, 'url' => ['view', 'id' => $model->kursus_persatuan_id]];
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
