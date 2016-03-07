<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\AtletPerubatan */

$this->title = 'Perubatan';
$this->params['breadcrumbs'][] = ['label' => 'Atlet Perubatans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="atlet-perubatan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
