<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\RefBahagianProgram */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::bahagian_program;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::bahagian_program, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-bahagian-program-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
