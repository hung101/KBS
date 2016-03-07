<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefAcara */

$this->title = 'Tambah Acara';
$this->params['breadcrumbs'][] = ['label' => 'Admin - Acara', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-acara-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
