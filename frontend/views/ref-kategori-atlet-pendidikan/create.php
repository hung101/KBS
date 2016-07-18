<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefKategoriAtletPendidikan */

$this->title = 'Create Ref Kategori Atlet Pendidikan';
$this->params['breadcrumbs'][] = ['label' => 'Ref Kategori Atlet Pendidikans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-kategori-atlet-pendidikan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
