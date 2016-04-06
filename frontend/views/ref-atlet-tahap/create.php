<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefAtletTahap */

$this->title = GeneralLabel::createTitle.' '.'Ref Atlet Tahap';
$this->params['breadcrumbs'][] = ['label' => 'Ref Atlet Tahaps', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-atlet-tahap-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
