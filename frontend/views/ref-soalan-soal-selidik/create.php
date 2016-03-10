<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefSoalanSoalSelidik */

$this->title = 'Create Ref Soalan Soal Selidik';
$this->params['breadcrumbs'][] = ['label' => 'Ref Soalan Soal Selidiks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-soalan-soal-selidik-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
