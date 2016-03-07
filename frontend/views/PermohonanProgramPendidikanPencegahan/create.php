<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PermohonanProgramPendidikanPencegahan */

$this->title = 'Tambah Permohonan Program Pendidikan Pencegahan';
$this->params['breadcrumbs'][] = ['label' => 'Permohonan Program Pendidikan Pencegahan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permohonan-program-pendidikan-pencegahan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
