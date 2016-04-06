<?php

use app\models\general\GeneralLabel;

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefDokumenPenyelidikan */

$this->title = GeneralLabel::createTitle.' '.'Ref Dokumen Penyelidikan';
$this->params['breadcrumbs'][] = ['label' => 'Ref Dokumen Penyelidikans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-dokumen-penyelidikan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
