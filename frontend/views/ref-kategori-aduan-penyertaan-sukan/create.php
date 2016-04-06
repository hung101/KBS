<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefKategoriAduanPenyertaanSukan */

$this->title = GeneralLabel::createTitle.' '.'Ref Kategori Aduan Penyertaan Sukan';
$this->params['breadcrumbs'][] = ['label' => 'Ref Kategori Aduan Penyertaan Sukans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-kategori-aduan-penyertaan-sukan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
