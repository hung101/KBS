<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PengurusanAnjuranNegara */

$this->title = 'Create Pengurusan Anjuran Negara';
$this->params['breadcrumbs'][] = ['label' => 'Pengurusan Anjuran Negaras', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-anjuran-negara-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
