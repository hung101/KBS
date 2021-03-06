<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View delete()*/
/* @var $model app\models\JurulatihKeluarga Atlet::findOne($id)*/

$this->title = GeneralLabel::createTitle . ' '.GeneralLabel::maklumat_keluarga;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::maklumat_keluarga, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jurulatih-keluarga-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
