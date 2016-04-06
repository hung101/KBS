<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefKategoriKecergasan */

$this->title = GeneralLabel::createTitle.' '.'Ref Kategori Kecergasan';
$this->params['breadcrumbs'][] = ['label' => 'Ref Kategori Kecergasans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-kategori-kecergasan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
