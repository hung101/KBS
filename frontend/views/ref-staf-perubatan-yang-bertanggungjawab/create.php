<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefStafPerubatanYangBertanggungjawab */

$this->title = 'Create Ref Staf Perubatan Yang Bertanggungjawab';
$this->params['breadcrumbs'][] = ['label' => 'Ref Staf Perubatan Yang Bertanggungjawabs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-staf-perubatan-yang-bertanggungjawab-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
