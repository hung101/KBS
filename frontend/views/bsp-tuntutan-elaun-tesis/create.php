<?php

use yii\helpers\Html;
use yii\helpers\Url;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\BspTuntutanElaunTesis */

$this->title = GeneralLabel::createTitle . ' Tuntutan Elaun Tesis';
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::tuntutan_elaun_tesis, 'url' => Url::to(['index', 'bsp_pemohon_id' => $bsp_pemohon_id])];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bsp-tuntutan-elaun-tesis-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
