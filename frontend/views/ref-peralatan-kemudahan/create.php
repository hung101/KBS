<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefPeralatanKemudahan */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::peralatan_kemudahan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::peralatan_kemudahan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-peralatan-kemudahan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
