<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;
/* @var $this yii\web\View */
/* @var $model app\models\RefKategoriNamaSukan */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::kategori_nama_sukan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::kategori_nama_sukan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-kategori-nama-sukan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
