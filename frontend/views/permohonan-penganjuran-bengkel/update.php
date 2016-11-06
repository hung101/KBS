<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PermohonanPenganjuranBengkel */

//$this->title = 'Update Permohonan Penganjuran Bengkel: ' . $model->permohonan_penganjuran_bengkel_id;
$this->title = GeneralLabel::updateTitle . ' ' . GeneralLabel::permohonan_penganjuran_bengkel;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::permohonan_penganjuran_bengkel, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' ' . GeneralLabel::permohonan_penganjuran_bengkel, 'url' => ['view', 'id' => $model->permohonan_penganjuran_bengkel_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permohonan-penganjuran-bengkel-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
