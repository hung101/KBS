<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefSemesterTerkini */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::semester_terkini;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::semester_terkini, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-semester-terkini-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
