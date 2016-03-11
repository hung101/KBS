<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefShuttle */

$this->title = 'Create Ref Shuttle';
$this->params['breadcrumbs'][] = ['label' => 'Ref Shuttles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-shuttle-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
