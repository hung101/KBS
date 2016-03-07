<?php

use yii\helpers\Html;
use yii\helpers\Url;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\BspElaunPerjalananUdara */

$this->title = GeneralLabel::createTitle . ' Elaun Perjalanan Udara';
$this->params['breadcrumbs'][] = ['label' => 'Elaun Perjalanan Udara', 'url' => Url::to(['index', 'bsp_pemohon_id' => $bsp_pemohon_id])];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bsp-elaun-perjalanan-udara-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
