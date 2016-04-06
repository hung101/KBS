<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefKategoriMuatnaik */

$this->title = GeneralLabel::createTitle.' '.'Ref Kategori Muatnaik';
$this->params['breadcrumbs'][] = ['label' => 'Ref Kategori Muatnaiks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-kategori-muatnaik-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
