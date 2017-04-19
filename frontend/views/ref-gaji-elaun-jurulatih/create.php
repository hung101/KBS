<?php

use yii\helpers\Html;
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\RefGajiElaunJurulatih */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::gaji_elaun;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::gaji_elaun, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-gaji-elaun-jurulatih-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
