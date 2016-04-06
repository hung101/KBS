<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PenganjuranKursus */

//$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::penganjuran_kursus.': ' . ' ' . $model->penganjuran_kursus_id;
$this->title = GeneralLabel::updateTitle . ' ' . GeneralLabel::penganjuran_kursus;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::akademi_kejurulatihan_kebangsaan_akk, 'url' => ['akademi-akk/index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::cce, 'url' => ['kursus/index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::penganjuran_kursus, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' ' . GeneralLabel::penganjuran_kursus, 'url' => ['view', 'id' => $model->penganjuran_kursus_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="penganjuran-kursus-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
