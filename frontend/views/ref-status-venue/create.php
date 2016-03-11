<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefStatusVenue */

$this->title = 'Create Ref Status Venue';
$this->params['breadcrumbs'][] = ['label' => 'Ref Status Venues', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-status-venue-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
