<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefStatusElaun */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::status_elaun;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::status_elaun, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-status-elaun-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
