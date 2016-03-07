<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\AtletAset */

$this->title = 'Tambah Aset';
$this->params['breadcrumbs'][] = ['label' => 'Atlet Asets', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="atlet-aset-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
