<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\BorangPenyertaanAtlet */

$this->title = GeneralLabel::createTitle . ' ' . GeneralLabel::borang_penyertaan_atlet;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::borang_penyertaan_atlet, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="borang-penyertaan-atlet-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
