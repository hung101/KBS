<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\Journal */

//$this->title = 'Update Journal: ' . ' ' . $model->journal_id;
$this->title = GeneralLabel::updateTitle . ' Penerbitan';
$this->params['breadcrumbs'][] = ['label' => 'Penerbitan', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' Penerbitan', 'url' => ['view', 'id' => $model->journal_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="journal-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
