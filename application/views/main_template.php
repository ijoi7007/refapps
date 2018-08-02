<?php $this->load->helper('url');  ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>
        <?php echo (isset($page_title)) ? $page_title : '' ; ?>
    </title>

    <!-- Bootstrap -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <style>
        body {
            padding-top: 70px;
        }

    </style>

    <script type="text/javascript">
        $(document).ready(function() {

            $("#kalkulatorDsr").on('submit', function(event) {

                var jumlahPendapatan = parseFloat($('#pendapatan').val()) + parseFloat($('#pendaptanLain').val());

                var jumlahKomitmen = parseFloat($('#loanRumah').val()) + parseFloat($('#loanKereta').val()) + parseFloat($('#loanPeribadi').val()) + parseFloat($('#kreditKad').val()) + parseFloat($('#ptptnLoan').val()) + parseFloat($('#loanLain2').val());

                var resultDsr = jumlahKomitmen / jumlahPendapatan * 100;

                if (!isNaN(resultDsr)) {
                    $('#resultDsr').val(resultDsr.toFixed(1));
                } else {
                    $('#resultDsr').val('');
                }
                return false;
            });

            $("#kalkulatorTunai").on('submit', function(event) {

                var jumlahLebihanTunai = parseFloat($('#mvrumah').val()) * 0.9 - parseFloat($('#bakiHutang').val());


                if (!isNaN(jumlahLebihanTunai)) {
                    $('#resulLebihanTunai').val(jumlahLebihanTunai.toFixed(0));
                } else {
                    $('#resulLebihanTunai').val('');
                }
                return false;
            });

            $("#kiraBulananBank").on('submit', function() {

                var jumlahLoan = parseFloat($('#jumlahLoan').val());
                var interestRate = parseFloat($('#interestRate').val());
                var tempohloan = parseFloat($('#tempohloan').val()) * 12;

                var resultBulananLoan = finance.calculatePayment(jumlahLoan, tempohloan, interestRate);

                if (!isNaN(resultBulananLoan)) {
                    $('#resultBulananLoan').val(resultBulananLoan.toFixed(2));
                } else {
                    $('#resultBulananLoan').val('');
                }
                return false;
            });

            $("#kiraBulananBankLebihanTunai").on('submit', function() {

                var jumlahLoan = parseFloat($('#jumlahLebihanTunai').val()) + parseFloat($('#bakiHutang').val());
                var interestRate = parseFloat($('#interestRate').val());
                var tempohloan = parseFloat($('#tempohloan').val()) * 12;

                var resultBulananLoanLebihanTunai = finance.calculatePayment(jumlahLoan, tempohloan, interestRate);

                if (!isNaN(resultBulananLoanLebihanTunai)) {
                    $('#resultBulananLoanLebihanTunai').val(resultBulananLoanLebihanTunai.toFixed(2));
                } else {
                    $('#resultBulananLoanLebihanTunai').val('');
                }
                return false;
            });

        });

    </script>

    <script>
        (function(i, s, o, g, r, a, m) {
            i['GoogleAnalyticsObject'] = r;
            i[r] = i[r] || function() {
                (i[r].q = i[r].q || []).push(arguments)
            }, i[r].l = 1 * new Date();
            a = s.createElement(o),
                m = s.getElementsByTagName(o)[0];
            a.async = 1;
            a.src = g;
            m.parentNode.insertBefore(a, m)
        })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');

        ga('create', 'UA-101185777-1', 'auto');
        ga('send', 'pageview');

    </script>

    <!-- Facebook Pixel Code -->
    <script>
        ! function(f, b, e, v, n, t, s) {
            if (f.fbq) return;
            n = f.fbq = function() {
                n.callMethod ?
                    n.callMethod.apply(n, arguments) : n.queue.push(arguments)
            };
            if (!f._fbq) f._fbq = n;
            n.push = n;
            n.loaded = !0;
            n.version = '2.0';
            n.queue = [];
            t = b.createElement(e);
            t.async = !0;
            t.src = v;
            s = b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t, s)
        }(window,
            document, 'script', 'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '378167625641812'); // Insert your pixel ID here.
        fbq('track', 'PageView');

    </script>
    <noscript><img height="1" width="1" style="display:none"
                   src="https://www.facebook.com/tr?id=378167625641812&ev=PageView&noscript=1"
        /></noscript>
    <!-- DO NOT MODIFY -->
    <!-- End Facebook Pixel Code -->
</head>

<?php isset($fb_pixel_event) ? $this->load->view('fb_pixel_page') : '' ; ?>


<body>
    <!-- top menu -->
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Refinance Apps (RAPPS)</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="index">Utama</a></li>

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Kalkulator <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo site_url('kalkulator/dsr');?>">Kalkulator Debt Service Ratio (DSR)</a></li>
                            <li><a href="<?php echo site_url('kalkulator/modaltunai');?>">Kalkulator Lebihan Tunai</a></li>
                            <li><a href="<?php echo site_url('kalkulator/satuhutang');?>">Kalkulator Satukan Hutang</a></li>
                            <li><a href="<?php echo site_url('kalkulator/bulananbank');?>">Kalkulator Bayaran Bulanan Bank </a></li>
                            <li><a href="<?php echo site_url('kalkulator/bulananLebihanTunai');?>">Kalkulator Bayaran Bulanan Bagi Lebihan Tunai </a></li>
                            <li><a href="<?php echo site_url('kalkulator/peguamdutisetem');?>">Kalkulator Peguam dan Duti Setem </a></li>
                        </ul>
                    </li>
                    <li><a href="<?php echo site_url('kalkulator/servis');?>">Servis</a></li>
                    <li><a href="<?php echo site_url('cms/refinance');?>">Borang</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">For Admin <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo site_url('cms/managerefinance');?>">Manage Refinance</a></li>
                            <li><a href="<?php echo site_url('kalkulator/modaltunai');?>">Kalkulator Lebihan Tunai</a></li>
                            <li><a href="<?php echo site_url('kalkulator/satuhutang');?>">Kalkulator Satukan Hutang</a></li>
                            <li><a href="<?php echo site_url('kalkulator/bulananbank');?>">Kalkulator Bayaran Bulanan Bank </a></li>
                            <li><a href="<?php echo site_url('kalkulator/bulananLebihanTunai');?>">Kalkulator Bayaran Bulanan Bagi Lebihan Tunai </a></li>
                            <li><a href="<?php echo site_url('kalkulator/peguamdutisetem');?>">Kalkulator Peguam dan Duti Setem </a></li>
                        </ul>
                    </li>
                </ul>
                <?php ///* ?>
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <?php if (isset($username)) { ?>
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Profile ( <?php echo (isset($username)) ? $username : '' ; ?>) <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo site_url('auth/logout');?>"><span class="glyphicon glyphicon-off"></span> Logout</a></li>
                        </ul>
                        <?php } else {?>
                        <li><a href="<?php echo site_url('auth/login');?>"><span class="glyphicon glyphicon-off"></span> Login</a></li>
                        <?php } ?>
                    </li>
                </ul>
                <?php //*/ ?>
            </div>
            <!--/.nav-collapse -->
        </div>
    </nav>



    <?php
    // google adsense at top area

    isset($google_adsense) ? $this->load->view('google_adsense_page') : '' ;
    ?>


        <?php $this->load->view($main_template); ?>

        <!-- footer -->

        <?php
    // google adsense at botton area

    isset($google_adsense) ? $this->load->view('google_adsense_page') : '' ;
    ?>




            <div class="container">
                <div class="row">
                    <div class="well">
                        Copyright &copy; 2011 - 2017 by Refinance Apps (GAPPS)<br/> All Rights Reserved.<br/> Powered by <a href='http://www.refinancerumah.com' target='_blank'>RefinanceRumah.com</a>
                    </div>
                </div>
            </div>


            <script type='text/javascript' src="<?php echo base_url(); ?>js/finance.js"></script>

            <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
            <!-- Include all compiled plugins (below), or include individual files as needed -->
            <!-- Latest compiled and minified JavaScript -->
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>

</html>
