<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefPeringkatProgram */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::peringkat_program;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::peringkat_program, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-peringkat-program-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
