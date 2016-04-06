<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\JurulatihKursusTertinggi */

//$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::jurulatih_kursus_tertinggi.': ' . ' ' . $model->kursus_tertinggi_id;
$this->title = GeneralLabel::updateTitle . ' Kelayakan Kursus Tertinggi';
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::kelayakan_kursus_tertinggi, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' Kelayakan Kursus Tertinggi', 'url' => ['view', 'id' => $model->kursus_tertinggi_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jurulatih-kursus-tertinggi-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
