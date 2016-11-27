<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\JurulatihPendidikan */

$this->title = GeneralLabel::createTitle . ' '. GeneralLabel::pendidikan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::pendidikan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jurulatih-pendidikan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
