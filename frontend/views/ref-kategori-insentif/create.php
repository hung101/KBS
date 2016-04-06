<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefKategoriInsentif */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::kategori_insentif;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::kategori_insentif, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-kategori-insentif-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
