<?php

use yii\helpers\Html;
use app\models\general\GeneralLabel;


/* @var $this yii\web\View */
/* @var $model app\models\RefSubjekSpm */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::subjek;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::subjek, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-subjek-spm-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
