<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PenilaianPrestasiAtlet */

//$this->title = 'Update Penilaian Prestasi Atlet: ' . ' ' . $model->penilaian_prestasi_atlet_id;
$this->title = GeneralLabel::updateTitle . ' Penilaian Prestasi Atlet';
$this->params['breadcrumbs'][] = ['label' => 'Penilaian Prestasi Atlet', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' Penilaian Prestasi Atlet', 'url' => ['view', 'id' => $model->penilaian_prestasi_atlet_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="penilaian-prestasi-atlet-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
