<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefKategoriBerita */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::kategori_berita;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::kategori_berita, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-kategori-berita-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
