<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PermohonanProgramPendidikanPencegahan */

$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::permohonan_program_pendidikan_pencegahan.': ' . ' ' . $model->program_pendidikan_pencegahan_id;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::permohonan_program_pendidikan_pencegahan, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->program_pendidikan_pencegahan_id, 'url' => ['view', 'id' => $model->program_pendidikan_pencegahan_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="permohonan-program-pendidikan-pencegahan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
