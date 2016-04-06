<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefJenisPermohonanProgramBinaan */

$this->title = GeneralLabel::createTitle.' '.'Ref Jenis Permohonan Program Binaan';
$this->params['breadcrumbs'][] = ['label' => 'Ref Jenis Permohonan Program Binaans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-jenis-permohonan-program-binaan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
