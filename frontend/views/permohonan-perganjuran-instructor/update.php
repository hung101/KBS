<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PermohonanPerganjuranInstructor */

$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::permohonan_perganjuran_instructor.': ' . ' ' . $model->permohonan_perganjuran_instructor_id;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::permohonan_perganjuran_instructors, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->permohonan_perganjuran_instructor_id, 'url' => ['view', 'id' => $model->permohonan_perganjuran_instructor_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="permohonan-perganjuran-instructor-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
