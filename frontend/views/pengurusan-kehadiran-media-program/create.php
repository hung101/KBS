<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PengurusanKehadiranMediaProgram */

$this->title = 'Tambah Pengurusan Kehadiran Media Program';
$this->params['breadcrumbs'][] = ['label' => 'Pengurusan Kehadiran Media Program', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-kehadiran-media-program-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
