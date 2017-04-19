<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;
/* @var $this yii\web\View */
/* @var $model app\models\RefTawaranAtlet */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::tawaran;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::tawaran, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-tawaran-atlet-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
