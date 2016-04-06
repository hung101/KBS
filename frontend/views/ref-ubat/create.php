<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefUbat */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::ubat;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::ubat, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-ubat-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
