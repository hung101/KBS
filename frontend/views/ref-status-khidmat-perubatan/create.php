<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefStatusKhidmatPerubatan */

$this->title = 'Create Ref Status Khidmat Perubatan';
$this->params['breadcrumbs'][] = ['label' => 'Ref Status Khidmat Perubatans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-status-khidmat-perubatan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
