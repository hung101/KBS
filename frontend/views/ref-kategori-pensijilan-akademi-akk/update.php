<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefKategoriPensijilanAkademiAkk */

$this->title = 'Update Ref Kategori Pensijilan Akademi Akk: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Kategori Pensijilan Akademi Akks', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-kategori-pensijilan-akademi-akk-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
