<?php
use app\models\general\GeneralLabel;
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefDokumenPengurusanInsurans */

$this->title = GeneralLabel::createTitle.' '.'Dokumen Pengurusan Insurans';
$this->params['breadcrumbs'][] = ['label' => 'Dokumen Pengurusan Insurans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-dokumen-pengurusan-insurans-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
