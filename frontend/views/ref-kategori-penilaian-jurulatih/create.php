<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefKategoriPenilaianJurulatih */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::kategori_penilaian_jurulatih;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::kategori_penilaian_jurulatih, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-kategori-penilaian-jurulatih-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
