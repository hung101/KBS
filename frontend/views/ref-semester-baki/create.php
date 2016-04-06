<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefSemesterBaki */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::semester_baki;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::semester_baki, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-semester-baki-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
