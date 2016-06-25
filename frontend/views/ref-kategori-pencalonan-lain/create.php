<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefKategoriPencalonanLain */

$this->title = 'Create Ref Kategori Pencalonan Lain';
$this->params['breadcrumbs'][] = ['label' => 'Ref Kategori Pencalonan Lains', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-kategori-pencalonan-lain-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
