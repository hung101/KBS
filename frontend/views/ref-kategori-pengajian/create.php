<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefKategoriPengajian */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::kategori_pengajian;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::kategori_pengajian, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-kategori-pengajian-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
