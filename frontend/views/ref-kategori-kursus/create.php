<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefKategoriKursus */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::kategori_kursus;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::kategori_kursuses, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-kategori-kursus-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
