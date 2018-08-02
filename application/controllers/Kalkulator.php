<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kalkulator extends CI_Controller {

    /**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
    public function index()
    {
        $data['main_template'] = 'index';
        $data['page_title'] = 'Refinance Apps (RAPPS)';
        $data['google_adsense'] = 'display'; // null value untuk disable paparan google adsense or Display utk paparkan
        $this->load->view('main_template', $data);
    }

    public function kira2no()
    {
        $data['main_template'] = 'kalkulator2no';
        $data['page_title'] = 'Kalkulator Kira 2 Nombor';
        $this->load->view('main_template', $data);
        //$this->load->view('kira2no');
    }

    public function Dsr()
    {
        $data['main_template'] = 'dsr';
        $data['page_title'] = 'Kalkulator Debt Service Ratio (DSR)';
        $data['google_adsense'] = 'display'; // null value untuk disable paparan google adsense or Display utk paparkan

        $this->load->view('main_template', $data);
        //$this->load->view('kira2no');
    }

    public function servis()
    {
        $data['main_template'] = 'servis';
        $data['page_title'] = 'Servis Refinance Rumah';
        $data['google_adsense'] = 'display'; // null value untuk disable paparan google adsense or Display utk paparkan

        $this->load->view('main_template', $data);
        //$this->load->view('kira2no');
    }

    public function modaltunai()
    {
        $data['main_template'] = 'modaltunai';
        $data['page_title'] = 'Kalkulator Modal Tunai';
        $data['google_adsense'] = 'display'; // null value untuk disable paparan google adsense or Display utk paparkan

        $this->load->view('main_template', $data);
        //$this->load->view('kira2no');
    }

    public function satuhutang()
    {
        $data['main_template'] = 'satuhutang';
        $data['page_title'] = 'Kalkulator Satukan Hutang';
        $data['google_adsense'] = 'display'; // null value untuk disable paparan google adsense or Display utk paparkan

        $this->load->view('main_template', $data);
        //$this->load->view('kira2no');
    }

    // kira installment bulanan @ PMT
    public function bulananbank()
    {
        $data['main_template'] = 'bulananbank';
        $data['page_title'] = 'Kalkulator Bayaran Bulanan Bank (Installment)';
        $data['google_adsense'] = 'display'; // null value untuk disable paparan google adsense or Display utk paparkan

        $this->load->view('main_template', $data);
        //$this->load->view('kira2no');
    }

    public function bulananLebihanTunai()
    {
        $data['main_template'] = 'bulananLebihanTunai';
        $data['page_title'] = 'Kalkulator Bayaran Bulanan Bagi Lebihan Tunai';
        $data['google_adsense'] = 'display'; // null value untuk disable paparan google adsense or Display utk paparkan
        $this->load->view('main_template', $data);
        //$this->load->view('kira2no');
    }

    public function peguamdutisetem()
    {
        $data['main_template'] = 'peguamdutisetem';
        $data['page_title'] = 'Kalkulator Kos Peguam dan Duti Setem Perjanjian Pembiayaan Bank';
        $data['google_adsense'] = 'display'; // null value untuk disable paparan google adsense or Display utk paparkan

        $this->load->view('main_template', $data);
        //$this->load->view('kira2no');
    }

    public function borang()
    {
        $data['main_template'] = 'borang';
        $data['page_title'] = 'Borang Refinance Rumah';
        $this->load->view('main_template', $data);
        //$this->load->view('kira2no');
    }


}
