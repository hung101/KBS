<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefKategoriProgramBinaan */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::kategori;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::kategori, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-atlet-tahap-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
