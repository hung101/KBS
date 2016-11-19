<?php

use yii\helpers\Html;
use app\models\general\GeneralLabel;


/* @var $this yii\web\Viewdelete() */
/* @var $model app\models\PeningkatanKerjayaJurulatih */

$this->title = GeneralLabel::tambah_peningkatan_kerjaya_jurulatih;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::peningkatan_kerjaya_jurulatih, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="peningkatan-kerjaya-jurulatih-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
