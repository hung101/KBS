<?php

use yii\helpers\Html;
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\RefStatusJawatan */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::status_jawatan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::status_jawatan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-status-jawatan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
