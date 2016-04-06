<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefKategoriAduan */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::kategori_aduan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::aduan_kategori, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-kategori-aduan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
