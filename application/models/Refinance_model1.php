<?php

/**
 * Created by PhpStorm.
 * User: zulhisham
 * Date: 6/30/17
 * Time: 10:28 PM
 */
class Refinance_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    // dapatkan senarai objektif bagi refinance rumah. akan return semua objektif yg ada dah klien boleh pilih.
    function get_refinance_objectives()
    {
        //where statement for select refinance objective
        $this->db->where('type', 'refinancetype');
        $this->db->order_by('position', 'ASC');

        $query = $this->db->get('tbl_lookup');

        return $query->result_array();
    }

    // dapatkan jenis objektif bagi code yg diberikan. akan return 1 objektif yg telah dipilih sahaja.
    function get_refinance_objective($code)
    {
        $this->db->where('code',$code);
        $this->db->where('type', 'refinancetype');
        $query = $this->db->get('tbl_lookup');

        if($query->num_rows()!==0)
        {
            $row = $query->row();
            return $row->name;
        }
        else
            return FALSE;
    }

    function get_jenis_pendapatans()
    {
        // select id, name where type = refinancetype

        //where statement
        $this->db->where('type', 'pendapatantype');
        $this->db->order_by('position', 'ASC');

        $query = $this->db->get('tbl_lookup');

        // return $query->result();
        return $query->result_array();
    }

    // dapatkan jenis objektif bagi code yg diberikan. akan return 1 objektif yg telah dipilih sahaja.
    function get_jenis_pendapatan($code)
    {
        $this->db->where('code',$code);
        $this->db->where('type', 'pendapatantype');
        $query = $this->db->get('tbl_lookup');
        //var_dump($query);
        if($query->num_rows()!==0)
        {
            $row = $query->row();
            return $row->name;
        }
        else
            return FALSE;
    }

    function create_refinance($data_to_db)
    {
        $this->db->insert('tbl_refinance', $data_to_db);
        return TRUE;

    }
}
