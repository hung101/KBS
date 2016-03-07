<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PermohonanMembaikiPeralatan */

//$this->title = 'Update Permohonan Membaiki Peralatan: ' . ' ' . $model->permohonan_membaiki_peralatan_id;
$this->title = GeneralLabel::updateTitle . ' Permohonan Membaiki Peralatan';
$this->params['breadcrumbs'][] = ['label' => 'Permohonan Membaiki Peralatan', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' Permohonan Membaiki Peralatan', 'url' => ['view', 'id' => $model->permohonan_membaiki_peralatan_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permohonan-membaiki-peralatan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
