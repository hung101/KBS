<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefVenueAduan */

$this->title = 'Update Ref Venue Aduan: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Venue Aduans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-venue-aduan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
