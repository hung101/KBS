<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefKawasanTemuduga */

$this->title = GeneralLabel::createTitle.' '.'Ref Kawasan Temuduga';
$this->params['breadcrumbs'][] = ['label' => 'Ref Kawasan Temudugas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-kawasan-temuduga-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
