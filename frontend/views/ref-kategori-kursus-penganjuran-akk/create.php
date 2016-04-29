<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefKategoriKursusPenganjuranAkk */

$this->title = 'Create Ref Kategori Kursus Penganjuran Akk';
$this->params['breadcrumbs'][] = ['label' => 'Ref Kategori Kursus Penganjuran Akks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-kategori-kursus-penganjuran-akk-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
