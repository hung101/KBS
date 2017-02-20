<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefKategoriPerbelanjaan */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::kategori_perbelanjaan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::kategori_perbelanjaan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-kategori-perbelanjaan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
