<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\AdminEBiasiswa */

$this->title = GeneralLabel::createTitle . ' ' . GeneralLabel::admin_ebiasiswa;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::admin_ebiasiswa, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admin-ebiasiswa-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
