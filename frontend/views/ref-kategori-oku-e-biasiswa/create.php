<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefKategoriOkuEBiasiswa */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::kategori_oku_ebiasiswa;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::kategori_oku_ebiasiswa, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-kategori-oku-ebiasiswa-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
