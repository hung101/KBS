<?php

use yii\helpers\Html;
use app\models\general\GeneralLabel;


/* @var $this yii\web\View */
/* @var $model app\models\TempahanKemudahan */

$this->title = GeneralLabel::tempahan;
//$this->params['breadcrumbs'][] = ['label' => 'Tempahan', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tempahan-kemudahan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
