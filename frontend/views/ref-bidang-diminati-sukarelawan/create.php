<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefBidangDiminatiSukarelawan */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::bidang_diminati_sukarelawan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::bidang_diminati_sukarelawan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-bidang-diminati-sukarelawan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
