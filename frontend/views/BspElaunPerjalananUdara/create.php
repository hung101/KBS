<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\BspElaunPerjalananUdara */

$this->title = 'Tambah Elaun Perjalanan Udara';
$this->params['breadcrumbs'][] = ['label' => 'Elaun Perjalanan Udara', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bsp-elaun-perjalanan-udara-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
