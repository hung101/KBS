<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\TempahanKemudahan */

//$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::tempahan_kemudahan.': ' . ' ' . $model->tempahan_kemudahan_sub_msn_id;
$this->title = GeneralLabel::updateTitle . ' ' . GeneralLabel::tempahan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::tempahan, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' ' . GeneralLabel::tempahan, 'url' => ['view', 'id' => $model->tempahan_kemudahan_sub_msn_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tempahan-kemudahan-sub-msn-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>