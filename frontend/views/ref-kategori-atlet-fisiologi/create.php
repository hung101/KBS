<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefKategoriAtletFisiologi */

$this->title = 'Create Kategori Atlet Fisiologi';
$this->params['breadcrumbs'][] = ['label' => 'Kategori Atlet Fisiologi', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-kategori-atlet-fisiologi-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
