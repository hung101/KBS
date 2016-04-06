<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefAnthropometricsUjian */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::anthropometrics_ujian;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::anthropometrics_ujian, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-anthropometrics-ujian-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
