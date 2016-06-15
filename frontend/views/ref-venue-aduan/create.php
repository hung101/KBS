<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefVenueAduan */

$this->title = 'Create Ref Venue Aduan';
$this->params['breadcrumbs'][] = ['label' => 'Ref Venue Aduans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-venue-aduan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
