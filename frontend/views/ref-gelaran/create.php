<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefGelaran */

$this->title = 'Create Ref Gelaran';
$this->params['breadcrumbs'][] = ['label' => 'Ref Gelarans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-gelaran-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
