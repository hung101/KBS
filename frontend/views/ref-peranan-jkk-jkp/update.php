<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefPerananJkkJkp */

$this->title = 'Update Ref Peranan Jkk Jkp: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Peranan Jkk Jkps', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-peranan-jkk-jkp-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
