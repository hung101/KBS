<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefKategoriKeahlian */

$this->title = GeneralLabel::createTitle.' '.'Ref Kategori Keahlian';
$this->params['breadcrumbs'][] = ['label' => 'Ref Kategori Keahlians', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-kategori-keahlian-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
