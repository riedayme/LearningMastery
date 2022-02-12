<?php if (!defined('BASEPATH')) {exit('No direct script access allowed');}

class _Process_MYSQL extends CI_Model
{

    public function read_data($table, $orderidentity, $orderby)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->order_by($orderidentity, $orderby);

        return $this->db->get();
    }

    public function insert_data($table, $data, $return_id = false)
    {
        $this->db->insert($table, $data);

        if ($return_id) {
            return  ($this->db->affected_rows() > 0) ? $this->db->insert_id() : false;
        }else{

            return ($this->db->affected_rows() > 0) ? true : false;
        }
    }
    public function insert_data_multiple($table, $data)
    {
        $this->db->insert_batch($table, $data);
        return ($this->db->affected_rows() > 0) ? true : false;
    }

    public function get_num_rows($table)
    {
        return $this->db->get($table)->num_rows();
    }

    public function get_data($table, $identity)
    {
        return $this->db->get_where($table, $identity);
    }

    public function get_data_multiple($table, $id, $identity, $identity2 = null,$orderby = false)
    {

        $this->db->select('*');

        $this->db->from($table);

        if (is_array($id)) {
            $this->db->where_in($identity, $id);
            if ($identity2) {
                $this->db->or_where_in($identity2, $id);
            }
        } else {
            $this->db->where($identity, $id);
            if ($identity2) {
                $this->db->where($identity2);
            }
        }
        if ($orderby) {
            $this->db->order_by($orderby[0], $orderby[1]);
        }
        return $this->db->get();
    }

    public function update_data($table, $data, $identity)
    {
        $this->db->trans_start();
        $this->db->update($table, $data, $identity);
        $this->db->trans_complete();
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            if ($this->db->trans_status() === false) {
                return false;
            }
            return true;
        }
    }

    public function update_data_multiple($table,$data,$identity)
    {
        $this->db->update_batch($table, $data, $identity ); 
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            if ($this->db->trans_status() === false) {
                return false;
            }
            return true;
        }
    }    

    public function delete_data($table, $identity)
    {
        $this->db->delete($table, $identity);
        return ($this->db->affected_rows() > 0) ? true : false;
    }

    public function delete_data_multiple($table, $id, $identity)
    {
        if (is_array($id)) {
            $this->db->where_in($identity, $id);
        } else {
            $this->db->where($identity, $id);
        }
        $this->db->delete($table);
        return ($this->db->affected_rows() > 0) ? true : false;
    }

}
