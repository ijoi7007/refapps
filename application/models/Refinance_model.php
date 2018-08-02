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

    // get refinance form detail to display at view form eg Add Banker
    function get_refinance_detail($refinance_id)
    {

        $this->db->select('tbl_refinance.id, tbl_refinance.name, tbl_refinance.phone, tbl_refinance.email, tbl_refinance.propinfo, 
        tbl_refinance.luas, tbl_refinance.bank, tbl_refinance.outstanding, tbl_refinance.typeincome, tbl_refinance.income, 
        tbl_refinance.houseln, tbl_refinance.othersln, tbl_refinance.current_value, tbl_refinance.notes, tbl_refinance.create_time, 
        tbl_lookup.name as objective');
        $this->db->from('tbl_refinance');
        $this->db->join('tbl_lookup', 'tbl_refinance.objective = tbl_lookup.code');
        $this->db->where('tbl_refinance.id', $refinance_id);
        $this->db->where('tbl_lookup.type', 'refinancetype');

        $query = $this->db->get();

        if ($query->num_rows() == 1)
        {
            return $query->row();
        }
        return NULL;

       // SELECT * FROM tbl_refinance JOIN tbl_lookup ON tbl_refinance.objective = tbl_lookup.code where tbl_lookup.type='refinancetype' and tbl_refinance.id=1383

    }

    function add_banker($data_to_db)
    {
        $this->db->insert('refinance_application', $data_to_db);
        return $this->db->insert_id();

        //return TRUE;
    }

    function get_pendapatan($pendapatan_code)
    {
        //where statement for select list of banker from table Users
        $this->db->select('name as pendapatan');
        $this->db->where('type', 'pendapatantype');
        $this->db->where('code', $pendapatan_code);

        $query = $this->db->get('tbl_lookup');

        if ($query->num_rows() == 1)
        {
            return $query->row();
        }
        return NULL;
    }

    function get_bankers_application()
    {
        //where statement for select list of banker from table Users
        $this->db->where('user_type', 'banker');

        $query = $this->db->get('users');

        return $query->result_array();
    }

    // dapatkan detail banker yg baru dipilih utk hantar email kpd klien
    function get_banker($application_id)
    {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->join('refinance_application', 'refinance_application.banker_id = users.id');
        $this->db->where('refinance_application.id', $application_id);

        $query = $this->db->get();

        if ($query->num_rows() == 1)
        {
            return $query->row();
        }
        return NULL;
    }

    /*
    // get all detail for refinance form
    function get_refinance_detail($refinance_id)
    {
        $this->db->select('*');
        $this->db->from('tbl_refinance');
        $this->db->where('id.id', $refinance_id);

        $query = $this->db->get();

        if ($query->num_rows() == 1)
        {
            return $query->row();
        }
        return NULL;
    }
    */

    // dapatkan senarai banker utk page assign banker to refinance form
    function get_bankers()
    {
        //where statement for select list of banker from table Users
        $this->db->where('user_type', 'banker');

        $query = $this->db->get('users');

        return $query->result_array();
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
