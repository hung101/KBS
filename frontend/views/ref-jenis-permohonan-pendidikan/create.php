<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefJenisPermohonanPendidikan */

$this->title = 'Create Ref Jenis Permohonan Pendidikan';
$this->params['breadcrumbs'][] = ['label' => 'Ref Jenis Permohonan Pendidikans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-jenis-permohonan-pendidikan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
