<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\JurulatihPengalaman */

$this->title = GeneralLabel::createTitle . ' '.GeneralLabel::pengalaman;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::pengalaman, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jurulatih-pengalaman-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
