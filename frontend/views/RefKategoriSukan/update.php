<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefKategoriSukan */

$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::kategori_sukan.': ' . ' ' . $model->ref_kategori_sukan_id;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::kategori_sukan, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ref_kategori_sukan_id, 'url' => ['view', 'id' => $model->ref_kategori_sukan_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-kategori-sukan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
