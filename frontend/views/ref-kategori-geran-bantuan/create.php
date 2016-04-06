<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefKategoriGeranBantuan */

$this->title = GeneralLabel::createTitle.' '.'Ref Kategori Geran Bantuan';
$this->params['breadcrumbs'][] = ['label' => 'Ref Kategori Geran Bantuans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-kategori-geran-bantuan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
