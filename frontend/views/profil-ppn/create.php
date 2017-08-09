<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;


/* @var $this yii\web\View */
/* @var $model app\models\BspBendahariIpt */

$this->title = GeneralLabel::createTitle . ' ' . GeneralLabel::profil_ppn;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::profil_ppn, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permohonan-e-bantuan-profil_ppn-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
