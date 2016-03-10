<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefSokongan */

$this->title = 'Create Ref Sokongan';
$this->params['breadcrumbs'][] = ['label' => 'Ref Sokongans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-sokongan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
