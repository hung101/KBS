<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\AtletPerubatanSejarah */

$this->title = 'Tambah Sejarah Perubatan';
$this->params['breadcrumbs'][] = ['label' => 'Atlet Perubatan Sejarahs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="atlet-perubatan-sejarah-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
