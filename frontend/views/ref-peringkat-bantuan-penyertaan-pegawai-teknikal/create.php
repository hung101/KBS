<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefPeringkatBantuanPenyertaanPegawaiTeknikal */

$this->title = 'Create Ref Peringkat Bantuan Penyertaan Pegawai Teknikal';
$this->params['breadcrumbs'][] = ['label' => 'Ref Peringkat Bantuan Penyertaan Pegawai Teknikals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-peringkat-bantuan-penyertaan-pegawai-teknikal-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
