<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PemberianJusPemulihan */

$this->title = 'Create Pemberian Jus Pemulihan';
$this->params['breadcrumbs'][] = ['label' => 'Pemberian Jus Pemulihans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pemberian-jus-pemulihan-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
