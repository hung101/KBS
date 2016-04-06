<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefKategoriDokumen */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::kategori_dokumen;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::kategori_dokumen, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-kategori-dokumen-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
