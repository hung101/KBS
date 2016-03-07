<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\BajetPenyelidikan */

$this->title = 'Tambah Bajet Penyelidikan';
$this->params['breadcrumbs'][] = ['label' => 'Bajet Penyelidikan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bajet-penyelidikan-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
