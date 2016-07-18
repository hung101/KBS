<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PermohonanPendidikanKeputusanSpm */

$this->title = 'Create Permohonan Pendidikan Keputusan Spm';
$this->params['breadcrumbs'][] = ['label' => 'Permohonan Pendidikan Keputusan Spms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permohonan-pendidikan-keputusan-spm-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
