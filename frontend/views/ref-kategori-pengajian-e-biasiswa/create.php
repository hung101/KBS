<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefKategoriPengajianEBiasiswa */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::kategori_pengajian_ebiasiswa;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::kategori_pengajian_ebiasiswa, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-kategori-pengajian-ebiasiswa-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
