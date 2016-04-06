<?php

use app\models\general\GeneralLabel;

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefMaklumatProgram */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::maklumat_program;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::maklumat_program, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-maklumat-program-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
