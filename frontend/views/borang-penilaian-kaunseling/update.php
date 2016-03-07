<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\BorangPenilaianKaunseling */

//$this->title = 'Update Borang Penilaian Kaunseling: ' . ' ' . $model->borang_penilaian_kaunseling_id;
$this->title = GeneralLabel::updateTitle . ' Laporan Sesi Kaunseling';
$this->params['breadcrumbs'][] = ['label' => 'Laporan Sesi Kaunseling', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' Laporan Sesi Kaunseling', 'url' => ['view', 'id' => $model->borang_penilaian_kaunseling_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="borang-penilaian-kaunseling-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
