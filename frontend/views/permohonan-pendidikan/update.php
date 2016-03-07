<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PermohonanPendidikan */

//$this->title = 'Update Permohonan Pendidikan: ' . ' ' . $model->permohonan_pendidikan_id;
$this->title = GeneralLabel::updateTitle . ' Permohonan Pendidikan';
$this->params['breadcrumbs'][] = ['label' => 'Permohonan Pendidikan', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' Permohonan Pendidikan', 'url' => ['view', 'id' => $model->permohonan_pendidikan_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permohonan-pendidikan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
