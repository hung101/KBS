<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PenganjuranKursus */

//$this->title = 'Update Penganjuran Kursus: ' . ' ' . $model->penganjuran_kursus_id;
$this->title = GeneralLabel::updateTitle . ' Penganjuran Kursus';
$this->params['breadcrumbs'][] = ['label' => 'Akademi Kejurulatihan Kebangsaan (AKK)', 'url' => ['akademi-akk/index']];
$this->params['breadcrumbs'][] = ['label' => 'CCE', 'url' => ['kursus/index']];
$this->params['breadcrumbs'][] = ['label' => 'Penganjuran Kursus', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' Penganjuran Kursus', 'url' => ['view', 'id' => $model->penganjuran_kursus_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="penganjuran-kursus-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
