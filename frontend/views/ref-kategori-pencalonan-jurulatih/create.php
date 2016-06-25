<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefKategoriPencalonanJurulatih */

$this->title = 'Create Ref Kategori Pencalonan Jurulatih';
$this->params['breadcrumbs'][] = ['label' => 'Ref Kategori Pencalonan Jurulatihs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-kategori-pencalonan-jurulatih-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
