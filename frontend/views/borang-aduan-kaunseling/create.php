<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;


/* @var $this yii\web\View */
/* @var $model app\models\BorangAduanKaunseling */

$this->title = GeneralLabel::createTitle . ' ' . GeneralLabel::borang_aduan_atlet;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::borang_aduan_atlet, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="borang-aduan-kaunseling-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
