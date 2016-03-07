<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PengurusanDokumenMediaProgram */

$this->title = 'Tambah Pengurusan Dokumen Media Program';
$this->params['breadcrumbs'][] = ['label' => 'Pengurusan Dokumen Media Program', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-dokumen-media-program-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
