<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\BantuanPenganjuranKursusDisertaiPenceramah */

$this->title = 'Create Bantuan Penganjuran Kursus Disertai Penceramah';
$this->params['breadcrumbs'][] = ['label' => 'Bantuan Penganjuran Kursus Disertai Penceramahs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bantuan-penganjuran-kursus-disertai-penceramah-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
