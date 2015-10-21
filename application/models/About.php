<?php

/**
 * about database class
 */
Class About extends CI_Model
{



    /**
     * update about Info in database
     * @param $data
     * @return 0 OR 1
     */
    public function update($data)
    {
//        $this->db->where('id', $data['id']);
        return $this->db->update('about', $data);
    }


    public function get()
    {

        $this->db->select('*');
        $query = $this->db->get('about');
        return $query->result_array();
    }



}

?>