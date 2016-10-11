<?php

use yii\helpers\Html;
use app\models\general\GeneralLabel;


/* @var $this yii\web\View */
/* @var $model app\models\TempahanKemudahan */

$this->title = GeneralLabel::tempahan;
//$this->params['breadcrumbs'][] = ['label' => GeneralLabel::tempahan, 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tempahan-kemudahan-msn-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'searchModelTempahanKemudahanSubMsn' => $searchModelTempahanKemudahanSubMsn,
        'dataProviderTempahanKemudahanSubMsn' => $dataProviderTempahanKemudahanSubMsn,
        'readonly' => $readonly,
    ]) ?>

</div>
