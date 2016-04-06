<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefDelegasi */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::delegasi;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::delegasi, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-delegasi-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
