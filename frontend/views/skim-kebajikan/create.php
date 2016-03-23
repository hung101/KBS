<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\SkimKebajikan */

$this->title = GeneralLabel::createTitle . ' ' . GeneralLabel::skim_kebajikan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::skim_kebajikan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="skim-kebajikan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
