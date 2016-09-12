<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefLawatan */

$this->title = 'Create Ref Lawatan';
$this->params['breadcrumbs'][] = ['label' => 'Ref Lawatans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-lawatan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
