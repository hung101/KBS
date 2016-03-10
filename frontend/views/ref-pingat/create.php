<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefPingat */

$this->title = 'Create Ref Pingat';
$this->params['breadcrumbs'][] = ['label' => 'Ref Pingats', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-pingat-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
