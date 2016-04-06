<?php

use app\models\general\GeneralLabel;

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefKategoriPenganjuranSub */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::kategori_penganjuran_sub;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::kategori_penganjuran_sub, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-kategori-penganjuran-sub-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
