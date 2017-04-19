<?php

use yii\helpers\Html;
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\RefKawasanKemudahan */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::kawasan_kemudahan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::kawasan_kemudahan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-kawasan-kemudahan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
