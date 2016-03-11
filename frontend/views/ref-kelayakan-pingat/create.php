<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefKelayakanPingat */

$this->title = 'Create Ref Kelayakan Pingat';
$this->params['breadcrumbs'][] = ['label' => 'Ref Kelayakan Pingats', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-kelayakan-pingat-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
