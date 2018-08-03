<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cms extends CI_Controller
{



    function __construct()
    {
        parent::__construct();

        $this->load->helper('url');
        $this->load->library('tank_auth');
        $this->load->library('grocery_CRUD');
        $this->load->database();
        $this->load->model('refinance_model');
        $this->load->library('form_validation');
        $this->load->helper(array('form', 'url'));
        $this->load->helper('date');
        $this->load->library('email');
    }

    function index()
    {
        if (!$this->tank_auth->is_logged_in()) {
            redirect('/auth/login/');
        } else {
            $data['user_id'] = $this->tank_auth->get_user_id();
            $data['username'] = $this->tank_auth->get_username();
            $data['main_template'] = "welcome";
            $this->load->view('main_template', $data);
        }

        //$this->load->view('welcome');
    }

    function date_display($value)
    {
        // tukar date unix dari mysql ke 01-01-2017
        return date('d-m-Y', $value);
    }

    function add_banker($refinance_id)
    {
        if (!$this->tank_auth->is_logged_in()) {
            redirect('/auth/login/');
        } else {

            $data['page_title'] = 'Add Banker - Pilih Banker Untuk Kes Refinance';
            $data['fb_pixel_event'] = '';
            $data['$google_adsense'] = ''; // null value untuk disable paparan google adsense or Display utk paparkan
            $data['main_template'] = 'add-banker';
            $data['refinance_id'] = $refinance_id;

            // select list banker for dropdown list
            // get list refinance objective from database using model class
            $banker_result = $this->refinance_model->get_bankers();

            $list_bankers_array = array();
            foreach ($banker_result as $row) {
                $list_bankers_array[$row['id']] = $row['name'];
            }

            $data['list_bankers'] = $list_bankers_array;

            // select list of banker assign to refinance application
            $banker_application_result = $this->refinance_model->get_bankers_application();

            $list_bankers_application_array = array();
            foreach ($banker_application_result as $row) {
                $list_bankers_application_array[$row['id']] = $row['name'];
            }

            $data['list_bankers_application'] = $list_bankers_application_array;

            // select record from table refinance as an array to pass to view. for table bootstrap
            $data['refinance'] = $this->refinance_model->get_refinance_detail($refinance_id);

           // select manual for income type
            $data['jenis_pendapatan'] = $this->refinance_model->get_pendapatan($data['refinance']->typeincome);

            // set rules banker input



            /// check table refinance_application. if tak de banker utk refinance id ni

            $this->form_validation->set_rules('list_bankers', 'Pilih Banker', 'numeric');

            // run validation. if true call function at model to insert refinance form.
            if ($this->form_validation->run() == FALSE) {
                $this->load->view('main_template', $data);
            } else {

                // set array for data (field name, value) to insert to db
                $data_to_db = array(
                    // application_id auto
                    'refinance_id' => $this->input->post('refinance_id'),
                    'banker_id' => $this->input->post('banker'),
                    // lawyer id to assign lawyer
                    'created' => now(),
                );

                // add banker for refinance id

                $application_id = $this->refinance_model->add_banker($data_to_db);

                $this->load->view('main_template', $data);


                // send email to client to. bg refinance id, banker -nama, phone. boleh call banker terus. kalau d
                // dlm 3 tak call boleh call terus.
                // sediakan dokumen
                //_send_mail_notification

                // variable for email notification
                $refinance_id = $this->input->post('refinance_id');

                // get banker info by application id

                $banker_row = $this->refinance_model->get_banker($application_id);

                $banker_nama = $banker_row->name;
                $banker_telefon = $banker_row->phone;

                // get email klien using refinance form id

                $refinance_row = $this->refinance_model->get_refinance_detail($refinance_id);

                $email_klien = $data['refinance']->email;


                    // send email to client
                $email_from = 'refinancerumah@gmail.com';
                $email_from_name = 'RefinanceRumah';
                //$email_to = 'gohartanah@gmail.com'; // amik email klien
                //$email_to = $email_klien;
                $email_to = 'gohartanah@gmail.com';
                $email_subject = 'Refinance ID # ' . $refinance_id .' - Perunding Kami Akan Hubungi Anda';

                $message = 'Salam Tuan/ Puan, <br><br>';
                $message .= 'Terima kasih kerana berurusan dengan RefinanceRumah.com. <br><br>';
                $message .= 'Pihak kami telah meneliti borang yang dihantar dan majukan kepada perunding kami bagi tindakan lanjut. ';
                $message .= 'Dalam masa terdekat perunding kami akan menghubungi anda bagi mengira kelayakan untuk refinance rumah. ';
                $message .= 'Selain itu menyediakan senarai dokumen sokongna yang diperlukan. <br><br>Berikut adalah detail Perunding Refinance yang akan hubungi anda : <br><br>';
                $message .= 'Perunding : ' . $banker_nama;
                $message .= '<br>Telefon : ' . $banker_telefon;
                $message .= '<br><br>Anda juga boleh terus hubungi perunding di atas bagi mempercepatkan proses refinance rumah atau bagi mendapatkan detail lanjut. ';
                $message .= 'Sekian,<br><br>RefinanceRumah.com<br><br>';

                $this->_send_mail_notification($email_from, $email_from_name, $email_to, $email_subject, $message);
                /*
                                // tamat hantar email kpd klien

                                // mula coding hantar email kpd admin refinancerumah

                                $email_to = 'gohartanah@gmail.com, refinancerumah@gmail.com';
                                $email_subject = 'Kes Refinance Terkini : ' . ucwords(strtolower($title = $this->input->post('nama'))) . ' - Pendapatan RM ' . number_format($title = $this->input->post('pendapatan'), 2, '.', ',');

                                $message = 'Salam Tuan Admin RefinanceRumah.com, <br><br>';
                                $message .= 'Didoakan Tuan Admin sihat dan ceria selalu. Semoga senantiasa di dalam pelindungan Allah SWT<br><br>';
                                $message .= 'Berikut adalah detail refinance : <br><br>';
                                $message .= 'Nama : ' . ucwords(strtolower($title = $this->input->post('nama')));
                                $message .= '<br>Telefon : ' . $title = $this->input->post('telefon');
                                $message .= '<br>Email : ' . $title = $this->input->post('email');
                                $message .= '<br>Objektif Refinance : ' . $this->refinance_model->get_refinance_objective($title = $this->input->post('objektif'));
                                //$title = $this->input->post('objektif'); // select from db
                                $message .= '<br><br>Detail Rumah : ' . $title = $this->input->post('prop_info');
                                $message .= '<br>Luas : ' . $title = $this->input->post('luas');
                                $message .= '<br>Market Value : ' . number_format($title = $this->input->post('market_value'), 2, '.', ',');

                                $message .= '<br><br>Pendapatan : RM ' . number_format($title = $this->input->post('pendapatan'), 2, '.', ',');
                                $message .= '<br>Jenis Pendapatan : ' . $this->refinance_model->get_jenis_pendapatan($title = $this->input->post('jenis_pendapatan')); // select from db


                                $message .= '<br><br>Baki Loan : RM ' . number_format($title = $this->input->post('baki_loan'), 2, '.', ',');
                                $message .= '<br>Bank : ' . $title = $this->input->post('bank');

                                $message .= '<br>Installment Rumah (bulan) : RM ' . number_format($title = $this->input->post('bulanan_rumah'), 2, '.', ',');
                                $message .= '<br>Jumlah Installment Lain2 (bulan) : RM ' . number_format($title = $this->input->post('bulanan_loan_lain'), 2, '.', ',');
                                $message .= '<br>Nota : ' . $title = $this->input->post('nota');

                                $message .= '<br><br><br>tamat...<br><br>';
                                $message .= 'Sekian,<br><br>RefinanceRumah.com<br><br>';

                                $this->_send_mail_notification($email_from, $email_from_name, $email_to, $email_subject, $message);

                                // tamat koding hantar email ke admin.

                         */




            /// email to banker - refinance id, detail form
            /// email to client - detail banker - nama, phone, email
            }
        }
    }

    function manageRefinance()
    {
        if (!$this->tank_auth->is_logged_in()) {
            redirect('/auth/login/');
        } else {

            $this->grocery_crud->set_table('tbl_refinance');
            $this->grocery_crud->columns('id', 'name', 'propinfo', 'income', 'outstanding', 'create_time');
            $this->grocery_crud->order_by('create_time', 'desc');
            $this->grocery_crud->unset_edit();

            // set for view field
            //$this->grocery_crud->fields('name', 'propinfo', 'status', 'banker', 'outstanding','create_time');

            $this->grocery_crud->callback_column('create_time', array($this, 'date_display'));

            //$output['page_title'] = 'Table Refinance';
            //$output['page_name'] = 'Refinance';
            //$output->page_name = 'Refinance';

            // $output->menu_active = 'category';

            // to check this update is for assigning banker
            //$checking_banker
            $checking_banker = $this->grocery_crud->callback_before_update(array($this, 'check_update_for_assign_banker'));

            // call _send_mail_notification untuk klien yang baru diberikan banker
            // check if variable forChecking is true
            if ($checking_banker) {

                //
                $this->grocery_crud->callback_after_update(array($this, '_send_mail_notification'));
            }

            // tambah button Add Banker dlm Button More
            $this->grocery_crud->add_action('Add Banker', '', 'cms/add_banker');

            $output = $this->grocery_crud->render();

            $this->_e_output((array)$output);
        }
    }

    // semak samada dropdown Objektif Refinance  bukan default value iaitu 0. Kalau 0 papar error msg
    public function check_dropdown_objektif($dropdown_value)
    {
        if ($dropdown_value == 0) {
            $this->form_validation->set_message('check_dropdown_objektif', 'Sila Pilih {field}');
            return FALSE;
        } else {
            return TRUE;
        }
    }


    // semak samada dropdown Jenis Pendapatan  bukan default value iaitu 0. Kalau 0 papar error msg
    public function check_dropdown_pendapatan($dropdown_value)
    {
        if ($dropdown_value == 0) {
            $this->form_validation->set_message('check_dropdown_pendapatan', 'Sila Pilih {field}');
            return FALSE;
        } else {
            return TRUE;
        }
    }

        //function to make cURL request
    public function call($method, $parameters, $url)
    {
        ob_start();
        $curl_request = curl_init();

        curl_setopt($curl_request, CURLOPT_URL, $url);
        curl_setopt($curl_request, CURLOPT_POST, 1);
        curl_setopt($curl_request, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);
        curl_setopt($curl_request, CURLOPT_HEADER, 1);
        curl_setopt($curl_request, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl_request, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_request, CURLOPT_FOLLOWLOCATION, 0);

        $jsonEncodedData = json_encode($parameters);

        $post = array(
             "method" => $method,
             "input_type" => "JSON",
             "response_type" => "JSON",
             "rest_data" => $jsonEncodedData
        );

        curl_setopt($curl_request, CURLOPT_POSTFIELDS, $post);
        $result = curl_exec($curl_request);
        curl_close($curl_request);

        $result = explode("\r\n\r\n", $result, 2);
        $response = json_decode($result[1]);
        ob_end_flush();

        return $response;
    }


    /*
     * borang yang perlu klien isi untuk buat refinance rumah
     */
    function refinance()
    {

        $data['page_title'] = 'Borang Refinance Rumah - Sila lengkap borang Pembiayaan Semula Hartanah';
        $data['main_template'] = 'borang-refinance';
        $data['$google_adsense'] = ''; // null value untuk disable paparan google adsense or Display utk paparkan

        // get list refinance objective from database using model class
        $objektif_result = $this->refinance_model->get_refinance_objectives();

        $list_objektif_array = array();
        foreach ($objektif_result as $row) {
            $list_objektif_array[$row['code']] = $row['name'];
        }

        $data['list_objektif'] = $list_objektif_array;

        // dapatkan senarai jenis pendapatan dari database guna model class
        $jenis_pendapatan_result = $this->refinance_model->get_jenis_pendapatans();

        $list_pendapatan_array = array();
        foreach ($jenis_pendapatan_result as $row) {
            $list_pendapatan_array[$row['code']] = $row['name'];
        }

        // masukkan default value Pilih Jenis Pendapatan ke dalam array
        //$final_jenis_pendapatan = array_merge(array('0' => 'Pilih Jenis Pendapatan'), $list_pendapatan_array);

        $data['list_jenis_pendapatan'] = $list_pendapatan_array;

        // set validation rules from form

        $this->form_validation->set_rules('nama', 'Nama', 'trim|required');
        $this->form_validation->set_rules('telefon', 'Telefon', 'trim|required|integer');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('objektif', 'Objektif Refinance', 'callback_check_dropdown_objektif');
        $this->form_validation->set_rules('prop_info', 'Detail Rumah', 'trim|required');
        $this->form_validation->set_rules('luas', 'Luas', 'trim|required');
        $this->form_validation->set_rules('bandar', 'Bandar', 'trim|required');
        $this->form_validation->set_rules('market_value', 'Market Value', 'trim|numeric');
        $this->form_validation->set_rules('bank', 'Bank', 'trim|required');
        $this->form_validation->set_rules('baki_loan', 'Baki Pembiayaan', 'trim|required|numeric');
        $this->form_validation->set_rules('jenis_pendapatan', 'Jenis Pendapatan', 'callback_check_dropdown_pendapatan');
        $this->form_validation->set_rules('pendapatan', 'Pendapatan', 'trim|numeric|required|greater_than_equal_to[3000]');
        $this->form_validation->set_rules('bulanan_rumah', 'Pembiayaan Rumah', 'trim|numeric|required');
        $this->form_validation->set_rules('bulanan_loan_lain', 'Pembiayaan Rumah', 'trim|numeric');

        // run validation. if true call function at model to insert refinance form.
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('main_template', $data);
        } else {

            // set array for data (field name, value) to insert to db
            $data_to_db = array(
                'name' => $this->input->post('nama'),
                'phone' => $this->input->post('telefon'),
                'email' => $this->input->post('email'),
                'objective' => $this->input->post('objektif'),
                'propinfo' => $this->input->post('prop_info'),
                'bank' => $this->input->post('bandar'),
                'bank' => $this->input->post('bank'),
                'luas' => $this->input->post('luas'),
                'current_value' => $this->input->post('market_value'),
                'outstanding' => $this->input->post('baki_loan'),
                'income' => $this->input->post('pendapatan'),
                'typeincome' => $this->input->post('jenis_pendapatan'),
                'houseln' => $this->input->post('bulanan_rumah'),
                'othersln' => $this->input->post('bulanan_loan_lain'),
                'notes' => $this->input->post('nota'),
                'create_time' => now(),
                'update_time' => now()
            );

            // if insert return !not_null send email to client n admin
            $this->refinance_model->create_refinance($data_to_db);


            // insert to suitecrm

            $url = "http://localhost:8888/SuiteCRM/service/v4_1/rest.php";

            $username = "admin";
            $password = "admin";

            // customer id for account
            $account_name = "69600a87-b715-28a1-3206-5b55222a36fc";

            //login -------------------------------------------- 
            $login_parameters = array(
                 "user_auth" => array(
                      "user_name" => $username,
                      "password" => md5($password),
                      "version" => "1"
                 ),
                 "application_name" => "RestTest",
                 "name_value_list" => array(),
            );

            $login_result = $this->call("login", $login_parameters, $url);

            //get session id
            $session_id = $login_result->id;

            //create contacts ------------------------------------ 
            $set_entry_parameters = array(
                 //session id
                 "session" => $session_id,

                 //The name of the module from which to retrieve records.
                 "module_name" => "Contacts",

                 //user, account, assignto
                 //assigned_user_id
                 //

                 //Record attributes
                 "name_value_list" => array(
            
                    array("name" => "last_name", "value" => $this->input->post('nama')),
                    array("name" => "phone_mobile", "value" => $this->input->post('telefon')),
                    array("name" => "email1", "value" => $this->input->post('email')),
                    array("name" => "primary_address_city", "value" => $this->input->post('bandar')),

                 ),
            );

            $contact_result = $this->call("set_entry", $set_entry_parameters, $url);
            $contact_id = $contact_result->id;

            //create opportunities ------------------------------------ 

            $oppor_name = "Refinance " . $this->input->post('nama') . " - " . $this->input->post('bandar');
            $expected_close_date = date("Y-m-d H:i:s");
            $stages = "Prospecting";
            $probabilitiy = "10";
            $oppor_amount = $this->input->post('market_value');

            $set_entry_oppor_parameters = array(
                 //session id
                 "session" => $session_id,

                 //The name of the module from which to retrieve records.
                 "module_name" => "Opportunities",

                 //user, account, assignto
                 //assigned_user_id
                 //

                 //Record attributes
                 "name_value_list" => array(
            
                    array("name" => "name", "value" => $oppor_name),
                    array("name" => "amount", "value" => $oppor_amount),
                    array("name" => "sales_stage", "value" => $stages),
                    array("name" => "probabilitiy", "value" => $probabilitiy),
                    array("name" => "date_closed", "value" => $expected_close_date),

                 ),
            );

            $oppor_result = $this->call("set_entry", $set_entry_oppor_parameters, $url);
            $oppor_id = $oppor_result->id;


            // create relationship

            $set_relationship_parameters = array(
                //session id
                'session' => $session_id,

                //The name of the module.
                'module_name' => 'Opportunities',

                //The ID of the specified module bean.
                'module_id' => $oppor_id,

                //The relationship name of the linked field from which to relate records.
                'link_field_name' => 'contacts',

                //The list of record ids to relate
                'related_ids' => array(
                    $contact_id,
                ),

                //Sets the value for relationship based fields
                'name_value_list' => array(),

                //Whether or not to delete the relationship. 0:create, 1:delete
                'delete'=> 0,
            );

            $relationship_result = $this->call("set_relationship", $set_relationship_parameters, $url);

            var_dump($relationship_result);

            // send email to admin
            //_send_mail_notification

            // send email to client
            $email_from = 'refinancerumah@gmail.com';
            $email_from_name = 'RefinanceRumah';
            //$email_to = 'gohartanah@gmail.com'; // amik email klien
            $email_to = $this->input->post('email');
            $email_subject = 'Borang Refinance Anda Telah Dihantar';

            $message = 'Salam Tuan/ Puan, <br><br>';
            $message .= 'Terima kasih kerana berurusan dengan RefinanceRumah.com. <br><br>';
            $message .= 'Pihak kami akan meneliti borang yang dihantar dan seterusnya perunding kami akan menghubungi Tuan/Puan. ';
            $message .= 'Sekiranya perunding RefinanceRumah tidak menghubungi anda dalam 3 hari bekerja dari email ini dihantar, ';
            $message .= 'sila maklumkan kepada kami dengan REPLY email ini.<br><br>';
            $message .= 'Bagi makluman anda, pihak kami tidak akan menghubungi anda sekiranya syarat-syarat permohonan tidak dipenuhi. ';
            $message .= 'Antara syarat utama seperti tiada masalah CCRIS, CTOS atau Bankrup. Selain itu kawasan servis kami hanya di ';
            $message .= 'Selangor, Kuala Lumpur, Putrajaya dan Seremban sahaja. <br><br>';
            $message .= 'Detail syarat-syarat Refinance Rumah layari http://www.refinancerumah.com/objektif. <br><br>';
            $message .= 'Sekian,<br><br>RefinanceRumah.com<br><br>';

            //$this->_send_mail_notification($email_from, $email_from_name, $email_to, $email_subject, $message);

            // tamat hantar email kpd klien

            // mula coding hantar email kpd admin refinancerumah

            $email_to = 'gohartanah@gmail.com, refinancerumah@gmail.com';
            $email_subject = 'Kes Refinance Terkini : ' . ucwords(strtolower($title = $this->input->post('nama'))) . ' - Pendapatan RM ' . number_format($title = $this->input->post('pendapatan'), 2, '.', ',');

            $message = 'Salam Tuan Admin RefinanceRumah.com, <br><br>';
            $message .= 'Didoakan Tuan Admin sihat dan ceria selalu. Semoga senantiasa di dalam pelindungan Allah SWT<br><br>';
            $message .= 'Berikut adalah detail refinance : <br><br>';
            $message .= 'Nama : ' . ucwords(strtolower($title = $this->input->post('nama')));
            $message .= '<br>Telefon : ' . $title = $this->input->post('telefon');
            $message .= '<br>Email : ' . $title = $this->input->post('email');
            $message .= '<br>Objektif Refinance : ' . $this->refinance_model->get_refinance_objective($title = $this->input->post('objektif'));
            //$title = $this->input->post('objektif'); // select from db
            $message .= '<br><br>Detail Rumah : ' . $title = $this->input->post('prop_info');
            $message .= '<br>Luas : ' . $title = $this->input->post('luas');
            $message .= '<br>Market Value : ' . number_format($title = $this->input->post('market_value'), 2, '.', ',');

            $message .= '<br><br>Pendapatan : RM ' . number_format($title = $this->input->post('pendapatan'), 2, '.', ',');
            $message .= '<br>Jenis Pendapatan : ' . $this->refinance_model->get_jenis_pendapatan($title = $this->input->post('jenis_pendapatan')); // select from db


            $message .= '<br><br>Baki Loan : RM ' . number_format($title = $this->input->post('baki_loan'), 2, '.', ',');
            $message .= '<br>Bank : ' . $title = $this->input->post('bank');

            $message .= '<br>Installment Rumah (bulan) : RM ' . number_format($title = $this->input->post('bulanan_rumah'), 2, '.', ',');
            $message .= '<br>Jumlah Installment Lain2 (bulan) : RM ' . number_format($title = $this->input->post('bulanan_loan_lain'), 2, '.', ',');
            $message .= '<br>Nota : ' . $title = $this->input->post('nota');

            $message .= '<br><br><br>tamat...<br><br>';
            $message .= 'Sekian,<br><br>RefinanceRumah.com<br><br>';

            //$this->_send_mail_notification($email_from, $email_from_name, $email_to, $email_subject, $message);

            // tamat koding hantar email ke admin.

            // redirect to successful page. put in fb pixel, adwords tracking code

            $data['fb_pixel_event'] = 'display';
            $data['main_template'] = 'borang-dihantar';
            $this->load->view('main_template', $data);

        }


        // next ToDo. group mailchimp for fillup form.
    }

    function numeric_float_only($param)
    {
        //conditional statements here

        if (is_int($param) || is_float($param)) {
            $this->form_validation->set_message('numeric_float_only', 'Jumlah {field} dimasukkan tidak sah');
            return FALSE;
        } else {
            return TRUE;
        }

    }

    public function _e_output($output = null)
    {
        //$this->load->view('example', $output);
        $this->load->view('cms-crud', (array)$output);
    }

    function testSession1()
    {
        echo $_SESSION['username'];
        echo "<br>";
        echo "Test Session Controller";
        echo "<br><a href='" . site_url('cms') . "'>CMS</a>";
    }

    //    $post_array, $primary_key
    //public function check_update_for_assign_banker()
    function check_update_for_assign_banker($post_array, $primary_key)
    {
        // load database
        $this->load->database();

        // get banker(city) from database
        $sql = "SELECT city FROM customers WHERE customerNumber = ?";
        $result = $this->db->query($sql, $primary_key);
        $bankerdb = $result->row()->city;

        // get banker from form
        $bankerform = $post_array['city'];

        if ($bankerdb != $bankerform) {
            return ($bankerdb != $bankerform);
        }

        return false;
    }

    // refinance form - send email to klien, send email to admin.
    public function _send_mail_notification($email_from, $email_from_name, $email_to, $email_subject, $message)
    {

        $this->email->from($email_from, $email_from_name);
        $this->email->to($email_to);
        $this->email->subject($email_subject);
        $this->email->message($message);

        // send the email
        if (!$this->email->send()) {
            // var_dump('error send mail');
            // var_dump($this->email->send(false));
            //print_debugger(array('subject', 'body'));
            //var_dump('failed');
            return false;
        } else {
            // var_dump('mail sent');
            //  var_dump($this->email->send(false));
            //var_dump('success');
            return true;
        }
    }

    public function wasap($name)
    {
        // select phone no form table user
        //$this->refinance_model->get_phone($username);

        // dummy testing
        $phone = '60102261701';
        $text = 'Mister Zulgo, better you late then never ~ Aselan Al Egogo';

        // format no phone follow wasap format

        // redirect to WhatsApp using URL
        // https://api.whatsapp.com/send?phone=whatsappphonenumber&text=urlencodedtext
        // https://api.whatsapp.com/send?phone=60192406484


        $url = 'https://api.whatsapp.com/send?phone=';
        $url .= $phone . '&text=';
        $url .= rawurlencode($text);

        //var_dump($url);
        redirect($url);
    }


}
