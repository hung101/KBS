<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefJawapanSoalSelidik */

$this->title = 'Update Ref Jawapan Soal Selidik: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Jawapan Soal Selidiks', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-jawapan-soal-selidik-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
