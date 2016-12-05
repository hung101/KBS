<?php

use yii\helpers\Html;
use app\models\general\GeneralLabel;


/* @var $this yii\web\View */
/* @var $model app\models\RefKategoriPelan */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::kategori_pelan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::kategori_pelan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-kategori-pelan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
