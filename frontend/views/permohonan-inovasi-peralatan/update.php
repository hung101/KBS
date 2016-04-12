<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PermohonanInovasiPeralatan */

//$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::permohonan_inovasi_peralatan.': ' . ' ' . $model->permohonan_inovasi_peralatan_id;
$this->title = GeneralLabel::updateTitle . ' ' . GeneralLabel::permohonan_projek_inovasi;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::permohonan_projek_inovasi, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' ' . GeneralLabel::permohonan_projek_inovasi, 'url' => ['view', 'id' => $model->permohonan_inovasi_peralatan_id]];
$this->params['breadcrumbs'][] = $this->title ;
?>
<div class="permohonan-inovasi-peralatan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
