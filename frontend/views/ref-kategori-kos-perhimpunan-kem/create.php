<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefKategoriKosPerhimpunanKem */

$this->title = 'Create Ref Kategori Kos Perhimpunan Kem';
$this->params['breadcrumbs'][] = ['label' => 'Ref Kategori Kos Perhimpunan Kems', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-kategori-kos-perhimpunan-kem-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
