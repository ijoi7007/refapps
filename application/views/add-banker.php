<?php
/**
 * Created by PhpStorm.
 * User: zulhisham
 * Date: 7/12/17
 * Time: 6:52 AM
 */

$selected_banker = array(
    set_value('list_bankers'),
);

?>

    <div class="container">

        <div class="container">
            <h2>Refinance ID :
                <?php echo $refinance->id ?>
            </h2>
        </div>
        <div class="container">
            <table class="table table-striped table-condensed">

                <tbody>
                    <tr>
                        <th scope=row>Nama</th>
                        <td>
                            <?php echo $refinance->name; ?>
                        </td>

                    </tr>
                    <tr>
                        <th scope=row>Telefon</th>
                        <td>
                            <?php echo $refinance->phone; ?>
                        </td>
                    </tr>
                    <tr>
                        <th scope=row>Email</th>
                        <td>
                            <?php echo $refinance->email; ?>
                        </td>
                    </tr>
                    <tr>
                        <th scope=row>Objektif Refinance</th>
                        <td>
                            <?php echo $refinance->objective; ?>
                        </td>
                    </tr>
                    <tr>
                        <th scope=row>Detail Hartanah</th>
                        <td>
                            <?php echo $refinance->propinfo; ?>
                        </td>
                    </tr>
                    <tr>
                        <th scope=row>Luas</th>
                        <td>
                            <?php echo $refinance->luas; ?>
                        </td>
                    </tr>
                    <tr>
                        <th scope=row>Market Value</th>
                        <td>
                            <?php echo number_format($refinance->current_value, 2, '.', ','); ?>
                        </td>
                    </tr>
                    <tr>
                        <th scope=row>Bank</th>
                        <td>
                            <?php echo $refinance->bank; ?>
                        </td>
                    </tr>
                    <tr>
                        <th scope=row>Baki Loan</th>
                        <td>
                            <?php echo number_format($refinance->outstanding, 2, '.', ','); ?>
                        </td>
                    </tr>
                    <tr>
                        <th scope=row>Jenis Pendapatan</th>
                        <td>
                            <?php echo $jenis_pendapatan->pendapatan; ?>
                        </td>
                    </tr>
                    <tr>
                        <th scope=row>Pendapatan Bulanan</th>
                        <td>
                            <?php echo number_format($refinance->income, 2, '.', ','); ?>
                        </td>
                    </tr>
                    <tr>
                        <th scope=row>Bayaran Rumah</th>
                        <td>
                            <?php echo number_format($refinance->houseln, 2, '.', ','); ?>
                        </td>
                    </tr>
                    <tr>
                        <th scope=row>Komitmen Bulanan</th>
                        <td>
                            <?php echo number_format($refinance->othersln, 2, '.', ','); ?>
                        </td>
                    </tr>
                    <tr>
                        <th scope=row>Nota</th>
                        <td>
                            <?php echo $refinance->notes; ?>
                        </td>
                    </tr>
                    <tr>
                        <th scope=row>Info For Text</th>
                        <td>
                            <?php

                        echo "Refinance ID : " . $refinance->id;
                        echo "<br>Nama : " . $refinance->name;
                        echo "<br>Telefon : " . $refinance->phone;
                        echo "<br>Email : " . $refinance->email;
                        echo "<br>Objektif : " . $refinance->objective;
                        echo "<br>Info Hartanah : " . $refinance->propinfo;
                        echo "<br>Luas : " . $refinance->luas;
                        echo "<br>Market Value : RM" . number_format($refinance->current_value, 2, '.', ',');
                        echo "<br>Bank : " . $refinance->bank;
                        echo "<br>Baki Loan Rumah : RM " . number_format($refinance->outstanding, 2, '.', ',');
                        echo "<br>Jenis Pendapatan : " . $jenis_pendapatan->pendapatan;
                        echo "<br>Pendapatan Bulanan : RM " . number_format($refinance->income, 2, '.', ',');
                        echo "<br>Bayaran Bulanan Rumah : RM " . number_format($refinance->houseln, 2, '.', ',');
                        echo "<br>Komitmen Bulanan : RM " . number_format($refinance->othersln, 2, '.', ',');
                        echo "<br>Nota : " . $refinance->notes;
                        echo "<br>Tarikh Borang : " . date('d-m-Y', $refinance->create_time);
                        ?>
                        </td>
                    </tr>
                    <tr>
                        <th scope=row>Tarikh Borang</th>
                        <td>
                            <?php echo date('d-m-Y', $refinance->create_time); ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="container">
        <div class="container">
            <h3>List Banker</h3>
            <?php // display banker for this application. all data inside array list_bankers_application?> 1. Zaidani MBSB<br> 1. Zaidani MBSB<br>
        </div>
        <br><br>
        <div class="container">

            <?php echo form_open('cms/add_banker/'.$refinance_id, 'class="form-horizontal"'); ?>

            <div class="form-group">
                <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12 control-label clearfix">
                    <?php echo form_label('Banker'); ?>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
                    <?php echo form_dropdown('banker', $list_bankers, $selected_banker, 'class="form-control"'); ?>
                </div>
            </div>

            <?php echo form_hidden('refinance_id', $refinance_id); ?>

            <div class="form-group well well-sm">

                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12 col-sm-push-1">
                    <button type="submit " class="btn btn-default">Pilih Banker</button>
                </div>

            </div>

        </div>
    </div>
