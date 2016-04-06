<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\KelayakanAkademiAkk */

$this->title = GeneralLabel::tambah_kelayakan_akademi_akk;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::kelayakan_akademi_akk, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kelayakan-akademi-akk-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
