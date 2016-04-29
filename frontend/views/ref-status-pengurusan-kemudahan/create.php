<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefStatusPengurusanKemudahan */

$this->title = 'Create Ref Status Pengurusan Kemudahan';
$this->params['breadcrumbs'][] = ['label' => 'Ref Status Pengurusan Kemudahans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-status-pengurusan-kemudahan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
