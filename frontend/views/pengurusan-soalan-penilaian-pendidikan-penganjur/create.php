<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PengurusanSoalanPenilaianPendidikanPenganjur */

$this->title = 'Tambah Pengurusan Soalan Penilaian Pendidikan Penganjur/Instructor';
$this->params['breadcrumbs'][] = ['label' => 'Pengurusan Soalan Penilaian Pendidikan Penganjur/Instructor', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-soalan-penilaian-pendidikan-penganjur-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
