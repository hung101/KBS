<?php

use yii\helpers\Html;


/* @var $this yii\web\View */

$this->title = 'Ref Kategori Laporan Penilaian Jurulatih';
$this->params['breadcrumbs'][] = ['label' => 'Ref Kategori Laporan Penilaian Jurulatih', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-penilaian-jurulatih-ketua-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
