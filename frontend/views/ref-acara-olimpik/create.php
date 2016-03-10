<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefAcaraOlimpik */

$this->title = 'Create Ref Acara Olimpik';
$this->params['breadcrumbs'][] = ['label' => 'Ref Acara Olimpiks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-acara-olimpik-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
