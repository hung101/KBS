<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefDoktorKejohananTemasya */

$this->title = 'Update Ref Doktor Kejohanan Temasya: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Doktor Kejohanan Temasyas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-doktor-kejohanan-temasya-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
