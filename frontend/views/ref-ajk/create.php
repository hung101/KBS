<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefAjk */

$this->title = 'Create Ref Ajk';
$this->params['breadcrumbs'][] = ['label' => 'Ref Ajks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-ajk-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
