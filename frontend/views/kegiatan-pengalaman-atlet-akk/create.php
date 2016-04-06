<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\KegiatanPengalamanAtletAkk */

$this->title = GeneralLabel::tambah_kegiatanpengalaman_atlet_akk;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::kegiatanpengalaman_atlet_akk, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kegiatan-pengalaman-atlet-akk-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
