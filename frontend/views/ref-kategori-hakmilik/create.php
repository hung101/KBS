<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefKategoriHakmilik */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::kategori_hakmilik;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::kategori_hakmilik_search, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-kategori-hakmilik-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
