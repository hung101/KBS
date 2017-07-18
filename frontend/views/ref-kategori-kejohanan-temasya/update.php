<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefKategoriKejohananTemasya */

$this->title = 'Update Ref Kategori Kejohanan Temasya: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Kategori Kejohanan Temasyas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-kategori-kejohanan-temasya-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
