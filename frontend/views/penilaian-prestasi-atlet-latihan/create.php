<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PenilaianPrestasiAtletLatihan */

$this->title = GeneralLabel::createTitle . ' ' . GeneralLabel::jadual_latihan_periodisasi_jurulatih;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::jadual_latihan_periodisasi_jurulatih, 'url' => ['index', 'penilaian_prestasi_atlet_sasaran_id' =>$model->penilaian_prestasi_atlet_sasaran_id, 'atlet_id' =>$model->atlet_id, 'penilaian_pestasi_id' =>$model->penilaian_pestasi_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="penilaian-prestasi-atlet-latihan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
