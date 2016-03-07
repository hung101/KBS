<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\AdminEBiasiswa */

$this->title = GeneralLabel::updateTitle . ' Admin : E-Biasiswa';
$this->params['breadcrumbs'][] = ['label' => 'Admin : E-Biasiswa', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' Admin : E-Biasiswa', 'url' => ['view', 'id' => $model->admin_e_biasiswa_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admin-ebiasiswa-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
