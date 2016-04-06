<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefDelegasi */

$this->title = GeneralLabel::createTitle.' '.'Ref Delegasi';
$this->params['breadcrumbs'][] = ['label' => 'Ref Delegasis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-delegasi-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
