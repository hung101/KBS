<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PenganjuranKursusPeserta */

//$this->title = 'Update Penganjuran Kursus Peserta: ' . ' ' . $model->penganjuran_kursus_peserta_id;
$this->title = GeneralLabel::updateTitle . ' Penganjuran Kursus Peserta';
$this->params['breadcrumbs'][] = ['label' => 'Penganjuran Kursus : Senarai Peserta', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' Penganjuran Kursus Peserta', 'url' => ['view', 'id' => $model->penganjuran_kursus_peserta_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="penganjuran-kursus-peserta-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
