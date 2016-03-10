<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefPerkhidmatanBiomekanik */

$this->title = 'Update Ref Perkhidmatan Biomekanik: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Perkhidmatan Biomekaniks', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-perkhidmatan-biomekanik-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
