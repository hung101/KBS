<?php

use yii\helpers\Html;
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\RefKategoriKecacatan */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::kategori_kecacatan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::kategori_kecacatan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-kategori-kecacatan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
