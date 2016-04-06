<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\KegiatanPengalamanJurulatihAkk */

$this->title = GeneralLabel::tambah_kegiatanpengalaman_sebagai_jurulatih;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::kegiatanpengalaman_sebagai_jurulatih, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kegiatan-pengalaman-jurulatih-akk-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
