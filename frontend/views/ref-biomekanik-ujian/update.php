<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefBiomekanikUjian */

$this->title = 'Update Ref Biomekanik Ujian: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Biomekanik Ujians', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-biomekanik-ujian-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
