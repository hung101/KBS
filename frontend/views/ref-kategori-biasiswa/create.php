<?php

use yii\helpers\Html;
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\RefKategoriBiasiswa */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::kategori_biasiswa;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::kategori_biasiswa, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-kategori-biasiswa-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
