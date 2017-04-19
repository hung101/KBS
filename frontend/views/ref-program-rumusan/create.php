<?php

use yii\helpers\Html;
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\RefProgramRumusan */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::program;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::program, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-program-rumusan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
