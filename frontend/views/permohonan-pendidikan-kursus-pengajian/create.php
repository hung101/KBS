<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PermohonanPendidikanKursusPengajian */

$this->title = 'Create Permohonan Pendidikan Kursus Pengajian';
$this->params['breadcrumbs'][] = ['label' => 'Permohonan Pendidikan Kursus Pengajians', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permohonan-pendidikan-kursus-pengajian-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
