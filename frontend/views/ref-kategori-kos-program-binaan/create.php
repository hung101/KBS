<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefKategoriKosProgramBinaan */

$this->title = GeneralLabel::createTitle.' '.'Ref Kategori Kos Program Binaan';
$this->params['breadcrumbs'][] = ['label' => 'Ref Kategori Kos Program Binaans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-kategori-kos-program-binaan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
