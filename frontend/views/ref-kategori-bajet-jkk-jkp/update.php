<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefKategoriBajetJkkJkp */

$this->title = 'Update Ref Kategori Bajet Jkk Jkp: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Kategori Bajet Jkk Jkps', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-kategori-bajet-jkk-jkp-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
