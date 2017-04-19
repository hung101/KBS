<?php

use yii\helpers\Html;
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\RefDokumenGeranBantuanGaji */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::dokumen;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::dokumen, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-dokumen-geran-bantuan-gaji-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
