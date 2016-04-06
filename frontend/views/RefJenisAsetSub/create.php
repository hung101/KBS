<?php

use app\models\general\GeneralLabel;

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefJenisAsetSub */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::jenis_aset_sub;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::jenis_aset_sub, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-jenis-aset-sub-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
