<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PenganjuranKursusPenganjur */

//$this->title = 'Update Penganjuran Kursus Penganjur: ' . ' ' . $model->penganjuran_kursus_penganjur_id;
$this->title = GeneralLabel::updateTitle . ' Penganjuran Kursus : Penganjur';
$this->params['breadcrumbs'][] = ['label' => 'Penganjuran Kursus : Penganjur', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' Penganjuran Kursus : Penganjur', 'url' => ['view', 'id' => $model->penganjuran_kursus_penganjur_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="penganjuran-kursus-penganjur-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
