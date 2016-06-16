<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\BantuanPenganjuranKursusOlehMsn */

$this->title = 'Create Bantuan Penganjuran Kursus Oleh Msn';
$this->params['breadcrumbs'][] = ['label' => 'Bantuan Penganjuran Kursus Oleh Msns', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bantuan-penganjuran-kursus-oleh-msn-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
