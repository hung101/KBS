<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefKategoriPencalonanPasukan */

$this->title = 'Create Ref Kategori Pencalonan Pasukan';
$this->params['breadcrumbs'][] = ['label' => 'Ref Kategori Pencalonan Pasukans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-kategori-pencalonan-pasukan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
