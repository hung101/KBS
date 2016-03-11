<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefStatusPermohonanEBantuan */

$this->title = 'Create Ref Status Permohonan Ebantuan';
$this->params['breadcrumbs'][] = ['label' => 'Ref Status Permohonan Ebantuans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-status-permohonan-ebantuan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
