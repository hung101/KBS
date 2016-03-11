<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefSoalanPenilaianPendidikanPenganjurInstructor */

$this->title = 'Update Ref Soalan Penilaian Pendidikan Penganjur Instructor: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Soalan Penilaian Pendidikan Penganjur Instructors', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-soalan-penilaian-pendidikan-penganjur-instructor-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
