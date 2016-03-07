<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;


/* @var $this yii\web\View */
/* @var $model app\models\PengurusanMediaProgram */

$this->title = GeneralLabel::createTitle . ' Pengurusan Media';
$this->params['breadcrumbs'][] = ['label' => 'Pengurusan Media', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-media-program-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'searchModelDokumenMediaProgram' => $searchModelDokumenMediaProgram,
        'dataProviderDokumenMediaProgram' => $dataProviderDokumenMediaProgram,
        'searchModelKehadiranMediaProgram' => $searchModelKehadiranMediaProgram,
        'dataProviderKehadiranMediaProgram' => $dataProviderKehadiranMediaProgram,
        'readonly' => $readonly,
    ]) ?>

</div>
