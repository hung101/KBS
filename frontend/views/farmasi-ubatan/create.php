<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\FarmasiUbatan */

$this->title = 'Tambah Ubatan';
$this->params['breadcrumbs'][] = ['label' => 'Ubatan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="farmasi-ubatan-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
