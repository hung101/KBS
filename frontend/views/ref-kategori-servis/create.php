<?php

use yii\helpers\Html;
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\RefKategoriServis */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::kategori_servis;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::kategori_servis, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-kategori-servis-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
