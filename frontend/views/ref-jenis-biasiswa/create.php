<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefJenisBiasiswa */

$this->title = GeneralLabel::createTitle.' '.'Ref Jenis Biasiswa';
$this->params['breadcrumbs'][] = ['label' => 'Ref Jenis Biasiswas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-jenis-biasiswa-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
