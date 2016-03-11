<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefProgram */

$this->title = 'Create Ref Program';
$this->params['breadcrumbs'][] = ['label' => 'Ref Programs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-program-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
