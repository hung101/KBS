<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefSubKategoriPenilaianJurulatih */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::sub_kategori_penilaian_jurulatih;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::sub_kategori_penilaian_jurulatih, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-sub-kategori-penilaian-jurulatih-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
