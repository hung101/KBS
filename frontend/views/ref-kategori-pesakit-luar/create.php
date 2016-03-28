<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefKategoriPesakitLuar */

$this->title = 'Create Ref Kategori Pesakit Luar';
$this->params['breadcrumbs'][] = ['label' => 'Ref Kategori Pesakit Luars', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-kategori-pesakit-luar-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
