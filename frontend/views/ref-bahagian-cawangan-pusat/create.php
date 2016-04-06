<?php

use app\models\general\GeneralLabel;

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefBahagianCawanganPusat */

$this->title = GeneralLabel::createTitle.' '.'Ref Bahagian Cawangan Pusat';
$this->params['breadcrumbs'][] = ['label' => 'Ref Bahagian Cawangan Pusats', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-bahagian-cawangan-pusat-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
