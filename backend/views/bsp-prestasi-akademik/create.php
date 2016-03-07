<?php

use yii\helpers\Html;
use yii\helpers\Url;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\BspPrestasiAkademik */

$this->title = GeneralLabel::createTitle . ' Prestasi Akademik';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bsp-prestasi-akademik-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
