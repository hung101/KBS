<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;
/* @var $this yii\web\View */
/* @var $model app\models\RefHari */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::hari;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::hari, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-hari-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
