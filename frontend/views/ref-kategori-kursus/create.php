<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefKategoriKursus */

$this->title = 'Create Ref Kategori Kursus';
$this->params['breadcrumbs'][] = ['label' => 'Ref Kategori Kursuses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-kategori-kursus-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
