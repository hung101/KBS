<?php

use app\models\general\GeneralLabel;

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefStatusTempahanKemudahan */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::status_tempahan_kemudahan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::status_tempahan_kemudahan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-status-tempahan-kemudahan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
