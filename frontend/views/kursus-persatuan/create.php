<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\KursusPersatuan */

$this->title = GeneralLabel::createTitle . ' ' . GeneralLabel::kursus_persatuan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::kursus_persatuan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kursus-persatuan-create">

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
