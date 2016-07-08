<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefStatusPermohonanKaunselor */

$this->title = 'Create Ref Status Permohonan Kaunselor';
$this->params['breadcrumbs'][] = ['label' => 'Ref Status Permohonan Kaunselors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-status-permohonan-kaunselor-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
