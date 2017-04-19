<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefSoalanPenilaianPendidikanPenganjurInstructor */

$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::soalan_penilaian_pendidikan_penganjur_instructor.': ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::soalan_penilaian_pendidikan_penganjur_instructor, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = GeneralLabel::updateTitle;
?>
<div class="ref-soalan-penilaian-pendidikan-penganjur-instructor-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
