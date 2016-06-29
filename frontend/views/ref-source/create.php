<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefSource */

$this->title = 'Create Ref Source';
$this->params['breadcrumbs'][] = ['label' => 'Ref Sources', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-source-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
