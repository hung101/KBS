<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefFasilitiSatelit */

$this->title = GeneralLabel::createTitle.' '.'Ref Fasiliti Satelit';
$this->params['breadcrumbs'][] = ['label' => 'Ref Fasiliti Satelits', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-fasiliti-satelit-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
