<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PermohonanProgramPendidikanKesihatan */

//$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::permohonan_program_pendidikan_kesihatan.': ' . ' ' . $model->permohonan_program_pendidikan_kesihatan_id;
$this->title = GeneralLabel::updateTitle . ' ' . GeneralLabel::permohonan_program_pendidikan_kesihatan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::permohonan_program_pendidikan_kesihatan, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' ' . GeneralLabel::permohonan_program_pendidikan_kesihatan, 'url' => ['view', 'id' => $model->permohonan_program_pendidikan_kesihatan_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permohonan-program-pendidikan-kesihatan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
