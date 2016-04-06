<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PaobsPenganjur */

$this->title =  'Penganjuran Acara Sukan Yang Disanksi';
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::penganjuran_acara_sukan_yang_disanksi, 'url' => ['index']];
$this->params['breadcrumbs'][] = GeneralLabel::createTitle;
?>
<div class="paobs-penganjur-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
