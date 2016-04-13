<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PermohonanProgramPendidikanKesihatan */

$this->title = GeneralLabel::createTitle . ' ' . GeneralLabel::permohonan_program_pendidikan_kesihatan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::permohonan_program_pendidikan_kesihatan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permohonan-program-pendidikan-kesihatan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
