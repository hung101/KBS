<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefJenisProgram */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::jenis_program;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::jenis_program, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-jenis-program-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
