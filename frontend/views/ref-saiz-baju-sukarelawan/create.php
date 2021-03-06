<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefSaizBajuSukarelawan */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::saiz_baju_sukarelawan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::saiz_baju_sukarelawan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-saiz-baju-sukarelawan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
