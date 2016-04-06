<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefDarjah */

$this->title = GeneralLabel::createTitle.' '.'Ref Darjah';
$this->params['breadcrumbs'][] = ['label' => 'Ref Darjahs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-darjah-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
