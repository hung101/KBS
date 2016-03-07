<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\KegiatanPengalamanAtletAkk */

$this->title = 'Tambah Kegiatan/Pengalaman Atlet AKK';
$this->params['breadcrumbs'][] = ['label' => 'Kegiatan/Pengalaman Atlet AKK', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kegiatan-pengalaman-atlet-akk-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
