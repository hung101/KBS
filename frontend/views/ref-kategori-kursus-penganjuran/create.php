<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefKategoriKursusPenganjuran */

$this->title = 'Create Ref Kategori Kursus Penganjuran';
$this->params['breadcrumbs'][] = ['label' => 'Ref Kategori Kursus Penganjurans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-kategori-kursus-penganjuran-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
