<!-- content @ kalkulator -->
<div class="container">
    <div class="page-header">
        <h2>Kalkulator Debt Service Ratio (DSR)</h2>
    </div>

    <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
        <p class="lead">
            Kalkulator DSR ini bagi mengira tahap kesihatan hutang seseorang. Peratus DSR kurang daripada 50% adalah baik dan lebih dari 70% adalah tidak baik.
        </p>
        <p class="lead">
            Panduan lengkap cara mengira DSR sila klik <a href="http://www.refinancerumah.com/2017/06/cara-kira-debt-service-ratio-dsr-bagi-tentukan-tahap-kesihatan-hutang/" target="_blank">Panduan Kalkulator DSR</a>
        </p>

    </div>
    <div>
        <div class="col-xs-12">
            <form id="kalkulatorDsr" class="form-horizontal">
                <div class="page-header">
                    <h3>
                        Pendapatan Bulanan
                    </h3>
                </div>
                <div class="form-group">
                    <label for="pendapatan" class="col-lg-2 col-md-3 col-sm-4 col-xs-12 control-label">Pendapatan Bersih</label>
                    <div class="input-group col-lg-3 col-md-3 col-sm-4 col-xs-12">
                        <span class="input-group-addon">RM</span>
                        <input type="text" class="form-control" id="pendapatan" value="0" placeholder="">
                    </div>
                    <p class="help-block col-lg-5 col-lg-push-2 col-md-push-3 col-sm-push-4">
                        Pendapatan yang ditolak KWSP, Perkeso, Potongan LHDN, Zakat
                    </p>


                </div>

                <div class="form-group">
                    <label for="pendaptanLain" class="col-lg-2 col-md-3 col-sm-4 col-xs-12 control-label">Pendapatan Lain-Lain</label>
                    <div class="input-group col-lg-3 col-md-3 col-sm-4 col-xs-12">
                        <span class="input-group-addon">RM</span>
                        <input type="text" class="form-control" id="pendaptanLain" value="0" placeholder="">
                    </div>
                    <p class="help-block col-lg-5 col-lg-push-2 col-md-push-3 col-sm-push-4">
                        Pendapatan lain seperti rumah sewa, dividen ASB, ...</p>

                </div>

                <div class="page-header">
                    <h3>
                        Komitmen Bulanan
                    </h3>
                </div>


                <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
                    <p class="lead">
                        Komitmen bulanan adalah bayaran bulanan yang perlu dibayar kepada bank. Setiap pembayaran ini dipaparkan di laporan CCRIS.
                    </p>
                </div>

                <div class="clearfix visible-lg-block visible-md-block"></div>

                <div class="form-group">
                    <label for="loanRumah" class="col-lg-2 col-md-3 col-sm-4 col-xs-12 control-label">Pembiayaan Rumah</label>
                    <div class="input-group col-lg-3 col-md-3 col-sm-4 col-xs-12">
                        <span class="input-group-addon">RM</span>
                        <input type="text" class="form-control" id="loanRumah" value="0" placeholder="">
                    </div>
                </div>

                <div class="form-group">
                    <label for="loanKereta" class="col-lg-2 col-md-3 col-sm-4 col-xs-12 control-label">Pembiayaan Kereta</label>
                    <div class="input-group col-lg-3 col-md-3 col-sm-4 col-xs-12">
                        <span class="input-group-addon">RM</span>
                        <input type="text" class="form-control" id="loanKereta" value="0" placeholder="">
                    </div>
                </div>

                <div class="form-group">
                    <label for="loanPeribadi" class="col-lg-2 col-md-3 col-sm-4 col-xs-12 control-label">Pembiayaan Peribadi</label>
                    <div class="input-group col-lg-3 col-md-3 col-sm-4 col-xs-12">
                        <span class="input-group-addon">RM</span>
                        <input type="text" class="form-control" id="loanPeribadi" value="0" placeholder="">
                    </div>
                </div>

                <div class="form-group">
                    <label for="kreditKad" class="col-lg-2 col-md-3 col-sm-4 col-xs-12 control-label">Kredit Kad</label>
                    <div class="input-group col-lg-3 col-md-3 col-sm-4 col-xs-12">
                        <span class="input-group-addon">RM</span>
                        <input type="text" class="form-control" id="kreditKad" value="0" placeholder="">
                    </div>
                    <p class="help-block col-lg-5 col-lg-push-2 col-md-push-3 col-sm-push-4">
                        Masukkan jumlah minimum 5% atau bayaran bulanan yang anda bayar setiap bulan.
                    </p>
                </div>

                <div class="form-group">
                    <label for="ptptnLoan" class="col-lg-2 col-md-3 col-sm-4 col-xs-12 control-label">PTPTN</label>
                    <div class="input-group col-lg-3 col-md-3 col-sm-4 col-xs-12">
                        <span class="input-group-addon">RM</span>
                        <input type="text" class="form-control" id="ptptnLoan" value="0" placeholder="">
                    </div>
                </div>

                <div class="form-group">
                    <label for="loanLain2" class="col-lg-2 col-md-3 col-sm-4 col-xs-12 control-label">Pembiayaan Lain-Lain</label>
                    <div class="input-group col-lg-3 col-md-3 col-sm-4 col-xs-12">
                        <span class="input-group-addon">RM</span>
                        <input type="text" class="form-control" id="loanLain2" value="0" placeholder="">
                    </div>
                </div>

                <div class="page-header">
                    <h3>
                        Debt Service Ratio (DSR)
                    </h3>
                </div>

                <div class="form-group">
                    <label for="result" class="col-lg-2 col-md-3 col-sm-4 col-xs-12 control-label ">DSR Anda</label>
                    <div class="input-group col-lg-3 col-md-3 col-sm-4 col-xs-12 ">
                        <input type="text" class="form-control" id="resultDsr" placeholder="" readonly>
                        <span class="input-group-addon ">%</span>
                    </div>
                </div>

                <div class="form-group well well-sm ">

                    <div class=" col-sm-1 col-lg-push-2 col-md-push-3 col-sm-push-4 ">
                        <button type="submit " class="btn btn-default ">Kira</button>
                    </div>

                </div>
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 ">
                    <h3 class="page-header ">
                        Nota
                    </h3>
                    <p class="lead ">
                        Peratus DSR kurang daripada 50% adalah normal. Sekiranya peratus DSR antara 60% - 80%, <strong>selesai dan satukan semua hutang</strong> adalah pilihan terbaik untuk anda. Info lanjut sila dapatkan <a href="http://www.refinancerumah.com/ebook-selesai-satukan-hutang-form/ " target="_blank ">Ebook Selesai dan Satukan Hutang</a>
                    </p>
                </div>

            </form>
        </div>
    </div>
</div>
