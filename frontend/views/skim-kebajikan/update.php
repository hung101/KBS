<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\SkimKebajikan */

//$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::skim_kebajikan.': ' . ' ' . $model->skim_kebajikan_id;
$this->title = GeneralLabel::updateTitle . ' ' . GeneralLabel::permohonan_skim_kebajikan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::permohonan_skim_kebajikan, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' ' . GeneralLabel::permohonan_skim_kebajikan, 'url' => ['view', 'id' => $model->skim_kebajikan_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="skim-kebajikan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
