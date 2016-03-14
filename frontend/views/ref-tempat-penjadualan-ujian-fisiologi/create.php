<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefTempatPenjadualanUjianFisiologi */

$this->title = 'Create Ref Tempat Penjadualan Ujian Fisiologi';
$this->params['breadcrumbs'][] = ['label' => 'Ref Tempat Penjadualan Ujian Fisiologis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-tempat-penjadualan-ujian-fisiologi-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
