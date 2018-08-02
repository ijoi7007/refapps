<?php
$nama = array(
    'name' => 'nama',
    'id' => 'nama',
    'value' => set_value('nama'),
    'class' => 'form-control',
);

$telefon = array(
    'name' => 'telefon',
    'id' => 'telefon',
    'value' => set_value('telefon'),
    'class' => 'form-control',
);

$email = array(
    'name' => 'email',
    'id' => 'email',
    'value' => set_value('email'),
    'class' => 'form-control',
);

$selected_objektif = array(
    set_value('objektif'),
);

$prop_info = array(
    'name' => 'prop_info',
    'id' => 'prop_info',
    'value' => set_value('prop_info'),
    'class' => 'form-control',
    'rows' => '6',
);

$nota = array(
    'name' => 'nota',
    'id' => 'nota',
    'value' => set_value('nota'),
    'class' => 'form-control',
    'rows' => '6',
);

$bank = array(
    'name' => 'bank',
    'id' => 'bank',
    'value' => set_value('bank'),
    'class' => 'form-control',
);

$baki_loan = array(
    'name' => 'baki_loan',
    'id' => 'baki_loan',
    'value' => set_value('baki_loan'),
    'class' => 'form-control',
);

$selected_jenis_pendapatan = array(
    set_value('jenis_pendapatan'),
);

$pendapatan = array(
    'name' => 'pendapatan',
    'id' => 'pendapatan',
    'value' => set_value('pendapatan'),
    'class' => 'form-control',
);

$bulanan_rumah = array(
    'name' => 'bulanan_rumah',
    'id' => 'bulanan_rumah',
    'value' => set_value('bulanan_rumah'),
    'class' => 'form-control',
);

$bulanan_loan_lain = array(
    'name' => 'bulanan_loan_lain',
    'id' => 'bulanan_loan_lain',
    'value' => set_value('bulanan_loan_lain'),
    'class' => 'form-control',
);

$luas = array(
    'name' => 'luas',
    'id' => 'luas',
    'value' => set_value('luas'),
    'class' => 'form-control',
);

$market_value = array(
    'name' => 'market_value',
    'id' => 'market_value',
    'value' => set_value('market_value'),
    'class' => 'form-control',
);
?>

    <!-- content @ kalkulator -->
    <div class="container">
        <div class="page-header">
            <h2>Borang Refinance Rumah</h2>
        </div>

        <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
            <div class="lead col-lg-10 col-md-10 col-sm-12 col-xs-12">

                <p>
                    Berikut adalah syarat-syarat utama Refinance Rumah :
                </p>
                <ul>
                    <li>Tiada masalah CCRIS, CTOS atau bankrup</li>
                    <li>Tunggakan tidak lebih daripada 2 bulan</li>
                    <li>Hartanah bagi Selangor, Kuala Lumpur, Putrajaya dan Seremban sahaja</li>
                    <li>Gaji minima adalah RM 3,000</li>
                </ul>

            </div>

            <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">

                <p class="lead">
                    Sila isi borang di bawah dengan lengkap. Borang yang tidak lengkap tidak akan diproses.
                </p>
            </div>

            <div>
                <div class="col-xs-12">


                    <?php /* div to display validation error messages */ ?>


                    <?php if (validation_errors()) { ?>
                    <div class="alert alert-danger">
                        <?php echo validation_errors(); ?>
                    </div>
                    <?php
                }
                ?>


                        <?php echo form_open('cms/refinance', 'class="form-horizontal"'); ?>
                        <?php /* <form class="form-horizontal" action="refinance"> */ ?>

                        <div class="page-header">
                            <h3>
                                Butiran Diri & Detail Rumah
                            </h3>
                        </div>

                        <div class="col-lg-12 col-md-10 col-sm-12 col-xs-12">
                            <p>
                                Masukkan no telefon dan email untuk konsultan kami hubungi selepas borang dihantar.
                            </p>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12 control-label">
                                <?php echo form_label('Nama', $nama['id']); ?>
                            </div>

                            <div class="col-lg-5 col-md-6 col-sm-6 col-xs-12">
                                <?php echo form_input($nama); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12 control-label">
                                <?php echo form_label('Telefon', $telefon['id']); ?>
                            </div>

                            <div class="col-lg-5 col-md-6 col-sm-6 col-xs-12">
                                <?php echo form_input($telefon); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12 control-label">
                                <?php echo form_label('Email', $email['id']); ?>
                            </div>

                            <div class="col-lg-5 col-md-6 col-sm-6 col-xs-12">
                                <?php echo form_input($email); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12 control-label">
                                <?php echo form_label('Objektif'); ?>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
                                <?php echo form_dropdown('objektif', $list_objektif, $selected_objektif, 'class=form-control'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12 control-label">
                                <?php echo form_label('Detail Rumah', $prop_info['id']); ?>
                            </div>

                            <div class="col-lg-5 col-md-6 col-sm-6 col-xs-12">
                                <?php echo form_textarea($prop_info); ?>
                            </div>
                            <span class="col-lg-6 col-lg-push-3 col-md-8 col-md-push-3 col-sm-8 col-sm-push-4">
                                Jenis Rumah, Alamat Penuh, Detail Renovation. <br><br> Contoh : 2 Stry teres, No 13 jln 1/M Bandar Baru Bangi Selangor, extend dapur, kitchen cabinet, plaster ceiling. kos reno 65k
                            </span>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12 control-label">
                                <?php echo form_label('Luas', $luas['id']); ?>
                            </div>

                            <div class="col-lg-5 col-md-6 col-sm-6 col-xs-12">
                                <?php echo form_input($luas); ?>
                            </div>
                            <span class="col-lg-6 col-lg-push-3 col-md-8 col-md-push-3 col-sm-8 col-sm-push-4">
                                    Luas tanah 20x70 @ 1400 sf. Bagi apartment atau kondo masukkan luas bangunan seperti 1,000 sf
                                </span>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12 control-label">
                                <?php echo form_label('Market Value', $market_value['id']); ?>
                            </div>

                            <div class="col-lg-5 col-md-6 col-sm-6 col-xs-12">
                                <?php echo form_input($market_value); ?>
                            </div>
                            <span class="col-lg-6 col-lg-push-3 col-md-8 col-md-push-3 col-sm-8 col-sm-push-4">
                                    Anggaran Market Value Rumah
                                </span>
                        </div>

                        <div class="page-header">
                            <h3>
                                Detail Pembiayaan, Pendapatan dan Komitmen
                            </h3>
                        </div>

                        <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
                            <p class="lead">
                                Maklumat pembiayaan semasa, pendapatan bulanan, bayaran bulanan bagi pembiayaan rumah dan pembiayaan selain rumah.
                            </p>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12 control-label">
                                <?php echo form_label('Bank', $bank['id']); ?>
                            </div>

                            <div class="col-lg-5 col-md-6 col-sm-6 col-xs-12">
                                <?php echo form_input($bank); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12 control-label">
                                <?php echo form_label('Baki Pembiayaan', $baki_loan['id']); ?>
                            </div>

                            <div class="input-group col-lg-5 col-md-6 col-sm-6 col-xs-12">
                                <span class="input-group-addon">RM</span>
                                <?php echo form_input($baki_loan); ?>
                            </div>
                            <span class="col-lg-6 col-lg-push-3 col-md-8 col-md-push-3 col-sm-8 col-sm-push-4">
                                    Anggaran baki pembiayaan (loan) rumah. Boleh juga dapatkan dari Bank
                            </span>
                        </div>


                        <div class="form-group">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12 control-label">
                                <?php echo form_label('Jenis Pendapatan'); ?>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
                                <?php echo form_dropdown('jenis_pendapatan', $list_jenis_pendapatan, $selected_jenis_pendapatan, 'class=form-control'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12 control-label">
                                <?php echo form_label('Jumlah Pendapatan', $pendapatan['id']); ?>
                            </div>

                            <div class="input-group col-lg-5 col-md-6 col-sm-6 col-xs-12">
                                <span class="input-group-addon">RM</span>
                                <?php echo form_input($pendapatan); ?>
                                <span class="input-group-addon">sebulan</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12 control-label">
                                <?php echo form_label('Bayaran Bulanan Rumah', $bulanan_rumah['id']); ?>
                            </div>

                            <div class="input-group col-lg-5 col-md-6 col-sm-6 col-xs-12">
                                <span class="input-group-addon">RM</span>
                                <?php echo form_input($bulanan_rumah); ?>
                                <span class="input-group-addon">sebulan</span>
                            </div>
                            <span class="col-lg-6 col-lg-push-3 col-md-8 col-md-push-3 col-sm-8 col-sm-push-4">
                        Jumlah bayaran bulanan (installment) rumah yang hendak buat refinance
                    </span>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12 control-label">
                                <?php echo form_label('Bayaran Bulanan Lain', $bulanan_loan_lain['id']); ?>
                            </div>

                            <div class="input-group col-lg-5 col-md-6 col-sm-6 col-xs-12">
                                <span class="input-group-addon">RM</span>
                                <?php echo form_input($bulanan_loan_lain); ?>
                                <span class="input-group-addon">sebulan</span>
                            </div>
                            <span class="col-lg-6 col-lg-push-3 col-md-8 col-md-push-3 col-sm-8 col-sm-push-4">
                                    Jumlah bayaran bulanan (installment) selain daripada rumah seperti kereta, kad kredit, pembiayaan peribadi, rumah kedua dan sebagainya.
                                </span>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12 control-label">
                                <?php echo form_label('Nota', $nota['id']); ?>
                            </div>

                            <div class="col-lg-5 col-md-6 col-sm-6 col-xs-12">
                                <?php echo form_textarea($nota); ?>
                            </div>
                        </div>

                        <div class="form-group well well-sm ">

                            <div class=" col-sm-1 col-lg-push-2 col-md-push-3 col-sm-push-4 ">
                                <button type="submit " class="btn btn-default ">Hantar Borang Refinance</button>
                            </div>

                        </div>
                </div>
            </div>
        </div>
    </div>
