<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\KegiatanPengalamanJurulatihAkk */

$this->title = 'Tambah Kegiatan/Pengalaman Sebagai Jurulatih';
$this->params['breadcrumbs'][] = ['label' => 'Kegiatan/Pengalaman Sebagai Jurulatih', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kegiatan-pengalaman-jurulatih-akk-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
