<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefSixstepBiomekanikStatus */

$this->title = 'Create Ref Sixstep Biomekanik Status';
$this->params['breadcrumbs'][] = ['label' => 'Ref Sixstep Biomekanik Statuses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-sixstep-biomekanik-status-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
