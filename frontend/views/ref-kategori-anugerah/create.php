<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefKategoriAnugerah */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::kategori_anugerah;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::kategori_anugerah, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-kategori-anugerah-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
