<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefJenamaPeralatan */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::jenama_peralatan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::jenama_peralatan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-jenama-peralatan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
