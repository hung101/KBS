<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\InventoriPeralatan */

$this->title = 'Create Inventori Peralatan';
$this->params['breadcrumbs'][] = ['label' => 'Inventori Peralatans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inventori-peralatan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
