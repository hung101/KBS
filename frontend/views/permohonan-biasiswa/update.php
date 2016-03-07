<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PermohonanBiasiswa */

//$this->title = 'Update Permohonan Biasiswa: ' . ' ' . $model->permohonan_biasiswa_id;
$this->title = GeneralLabel::updateTitle . ' Permohonan Biasiswa';
$this->params['breadcrumbs'][] = ['label' => 'Permohonan Biasiswa', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' Permohonan Biasiswa', 'url' => ['view', 'id' => $model->permohonan_biasiswa_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permohonan-biasiswa-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
