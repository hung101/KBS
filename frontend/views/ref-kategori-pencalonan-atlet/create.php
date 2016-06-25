<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefKategoriPencalonanAtlet */

$this->title = 'Create Ref Kategori Pencalonan Atlet';
$this->params['breadcrumbs'][] = ['label' => 'Ref Kategori Pencalonan Atlets', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-kategori-pencalonan-atlet-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
