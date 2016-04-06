<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefHubungan */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::hubungan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::hubungan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-hubungan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
