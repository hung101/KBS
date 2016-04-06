<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\BspPerlanjutanSebab */

$this->title = GeneralLabel::createTitle . ' Sebab Pelanjutan';
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::sebab_pelanjutan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bsp-perlanjutan-sebab-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
