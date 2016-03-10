<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefInstructorPenilaianPendidikan */

$this->title = 'Update Ref Instructor Penilaian Pendidikan: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Instructor Penilaian Pendidikans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-instructor-penilaian-pendidikan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
