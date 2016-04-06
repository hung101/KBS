<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefJantina */

$this->title = GeneralLabel::createTitle.' '.'Ref Jantina';
$this->params['breadcrumbs'][] = ['label' => 'Ref Jantinas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-jantina-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
