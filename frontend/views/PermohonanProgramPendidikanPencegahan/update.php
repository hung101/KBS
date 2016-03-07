<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PermohonanProgramPendidikanPencegahan */

$this->title = 'Update Permohonan Program Pendidikan Pencegahan: ' . ' ' . $model->program_pendidikan_pencegahan_id;
$this->params['breadcrumbs'][] = ['label' => 'Permohonan Program Pendidikan Pencegahans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->program_pendidikan_pencegahan_id, 'url' => ['view', 'id' => $model->program_pendidikan_pencegahan_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="permohonan-program-pendidikan-pencegahan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
