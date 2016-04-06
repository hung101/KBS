<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefInstructorPenilaianPendidikan */

$this->title = GeneralLabel::createTitle.' '.'Ref Instructor Penilaian Pendidikan';
$this->params['breadcrumbs'][] = ['label' => 'Ref Instructor Penilaian Pendidikans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-instructor-penilaian-pendidikan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
