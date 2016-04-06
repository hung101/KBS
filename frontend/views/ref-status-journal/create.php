<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefStatusJournal */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::status_journal;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::status_journal, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-status-journal-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
