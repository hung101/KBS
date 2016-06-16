<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\BantuanPenganjuranKursusPenceramah */

$this->title = 'Create Bantuan Penganjuran Kursus Penceramah';
$this->params['breadcrumbs'][] = ['label' => 'Bantuan Penganjuran Kursus Penceramahs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bantuan-penganjuran-kursus-penceramah-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
