<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefJenisPermohonanProgramBinaan */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::jenis_permohonan_program_binaan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::jenis_permohonan_program_binaan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-jenis-permohonan-program-binaan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
