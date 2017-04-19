<?php

use yii\helpers\Html;
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\RefKategoriKerosakan */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::kategori_kerosakan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::kategori_kerosakan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-kategori-kerosakan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
