<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefAcaraOlimpik */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::acara_olimpik;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::acara_olimpik, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-acara-olimpik-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
