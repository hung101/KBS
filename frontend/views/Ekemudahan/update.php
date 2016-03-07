<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Ekemudahan */

$this->title = 'Update Ekemudahan: ' . ' ' . $model->ekemudahan_id;
$this->params['breadcrumbs'][] = ['label' => 'Ekemudahans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ekemudahan_id, 'url' => ['view', 'id' => $model->ekemudahan_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ekemudahan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
