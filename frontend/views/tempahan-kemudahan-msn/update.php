<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\TempahanKemudahan */

//$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::tempahan_kemudahan.': ' . ' ' . $model->tempahan_kemudahan_id;
$this->title = GeneralLabel::updateTitle . ' ' . GeneralLabel::tempahan_kemudahan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::tempahan_kemudahan, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' ' . GeneralLabel::tempahan_kemudahan, 'url' => ['view', 'id' => $model->tempahan_kemudahan_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tempahan-kemudahan-msn-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'searchModelTempahanKemudahanSubMsn' => $searchModelTempahanKemudahanSubMsn,
        'dataProviderTempahanKemudahanSubMsn' => $dataProviderTempahanKemudahanSubMsn,
        'readonly' => $readonly,
    ]) ?>

</div>
