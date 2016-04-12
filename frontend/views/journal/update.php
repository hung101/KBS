<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\Journal */

//$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::journal.': ' . ' ' . $model->journal_id;
$this->title = GeneralLabel::updateTitle . ' ' . GeneralLabel::penerbitan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::penerbitan, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' ' . GeneralLabel::penerbitan, 'url' => ['view', 'id' => $model->journal_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="journal-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
