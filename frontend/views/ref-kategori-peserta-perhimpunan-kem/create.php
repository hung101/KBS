<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefKategoriPesertaPerhimpunanKem */

$this->title = 'Create Ref Kategori Peserta Perhimpunan Kem';
$this->params['breadcrumbs'][] = ['label' => 'Ref Kategori Peserta Perhimpunan Kems', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-kategori-peserta-perhimpunan-kem-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
