<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefInstructorPenilaianPendidikan */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::instructor_penilaian_pendidikan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::instructor_penilaian_pendidikan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-instructor-penilaian-pendidikan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
