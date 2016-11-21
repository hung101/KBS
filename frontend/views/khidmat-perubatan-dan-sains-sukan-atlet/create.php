<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\KhidmatPerubatanDanSainsSukanAtlet */

$this->title = 'Create Khidmat Perubatan Dan Sains Sukan Atlet';
$this->params['breadcrumbs'][] = ['label' => 'Khidmat Perubatan Dan Sains Sukan Atlets', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="khidmat-perubatan-dan-sains-sukan-atlet-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
