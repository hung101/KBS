<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::agensi;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::agensi, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-agensi-jkk-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
