<?php

use yii\helpers\Html;
use app\models\general\GeneralLabel;
/* @var $this yii\web\View */
/* @var $model app\models\RefSilibus */

$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::silibus.': ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::silibus, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = GeneralLabel::updateTitle;
?>
<div class="ref-silibus-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
