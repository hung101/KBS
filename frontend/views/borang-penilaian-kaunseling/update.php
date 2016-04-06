<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\BorangPenilaianKaunseling */

//$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::borang_penilaian_kaunseling.': ' . ' ' . $model->borang_penilaian_kaunseling_id;
$this->title = GeneralLabel::updateTitle . ' ' . GeneralLabel::laporan_sesi_kaunseling;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::laporan_sesi_kaunseling, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' ' . GeneralLabel::laporan_sesi_kaunseling, 'url' => ['view', 'id' => $model->borang_penilaian_kaunseling_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="borang-penilaian-kaunseling-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
