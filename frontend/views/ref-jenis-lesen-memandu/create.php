<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefJenisLesenMemandu */

$this->title = 'Create Ref Jenis Lesen Memandu';
$this->params['breadcrumbs'][] = ['label' => 'Ref Jenis Lesen Memandus', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-jenis-lesen-memandu-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
