<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PengurusanDokumenMediaProgram */

$this->title = GeneralLabel::tambah_pengurusan_dokumen_media_program;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::pengurusan_dokumen_media_program, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-dokumen-media-program-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
