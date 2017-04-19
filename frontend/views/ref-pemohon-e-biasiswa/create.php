<?php

use yii\helpers\Html;
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\RefPemohonEBiasiswa */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::pemohon_e_biasiswa;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::pemohon_e_biasiswa, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-pemohon-ebiasiswa-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
