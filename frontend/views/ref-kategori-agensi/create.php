<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;
/* @var $this yii\web\View */
/* @var $model app\models\RefKategoriAgensi */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::kategori_agensi;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::kategori_agensi, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-kategori-agensi-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
