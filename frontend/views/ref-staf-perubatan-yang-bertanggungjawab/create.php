<?php

use yii\helpers\Html;
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\RefStafPerubatanYangBertanggungjawab */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::staf_perubatan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::staf_perubatan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-staf-perubatan-yang-bertanggungjawab-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
