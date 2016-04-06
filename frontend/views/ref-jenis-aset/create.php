<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefJenisAset */

$this->title = GeneralLabel::createTitle.' '.'Ref Jenis Aset';
$this->params['breadcrumbs'][] = ['label' => 'Ref Jenis Asets', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-jenis-aset-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
