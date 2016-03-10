<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefKategoriOkuEBiasiswa */

$this->title = 'Create Ref Kategori Oku Ebiasiswa';
$this->params['breadcrumbs'][] = ['label' => 'Ref Kategori Oku Ebiasiswas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-kategori-oku-ebiasiswa-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
