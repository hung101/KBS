<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PengurusanKehadiranMediaProgram */

$this->title = GeneralLabel::tambah_pengurusan_kehadiran_media_program;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::pengurusan_kehadiran_media_program, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-kehadiran-media-program-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
