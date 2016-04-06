<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PenganjuranKursusPenganjur */

//$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::penganjuran_kursus_penganjur.': ' . ' ' . $model->penganjuran_kursus_penganjur_id;
$this->title = GeneralLabel::updateTitle . ' ' . GeneralLabel::penganjuran_kursus_penganjur;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::penganjuran_kursus_penganjur, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' ' . GeneralLabel::penganjuran_kursus_penganjur, 'url' => ['view', 'id' => $model->penganjuran_kursus_penganjur_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="penganjuran-kursus-penganjur-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
