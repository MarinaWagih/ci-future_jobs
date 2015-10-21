<?php

/**
 * foreign_labor database class
 */
Class Foreign_labor extends CI_Model
{

    /**
     * insert in database
     * @param $data
     * @return mixed
     */
    public function add($data)
    {
        return $this->db->insert('foreign_labor', $data);
    }

    /**
     * get new id to be inserted in database
     * @return int
     */
    public function get_new_id()
    {
        $query = "select MAX(id) as id from foreign_labor";
        $res = $this->db->query($query);
        $res->result_array();
        $last_id = ($res->result()[0]->id) + 1;
        return $last_id;
    }

    /**
     * get foreign_labor by given id
     * @param $id
     * @return mixed
     */
    public function get_foreign_labor($id)
    {

        $this->db->where('id', $id);
        $query = $this->db->get('foreign_labor');
        return $query->result_array();

    }

    /**
     * update foreign_labor Info in database
     * @param $data
     * @return 0 OR 1
     */
    public function update($data)
    {
        $this->db->where('id', $data['id']);
        return $this->db->update('foreign_labor', $data);
    }

    /**
     * delete foreign_labor from database
     * @param $id
     * @return 0 OR 1
     */
    public function delete($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('foreign_labor');
    }

    /**
     * Pagination in Admin site
     * @param $limit
     * @param $start
     * @return mixed
     */
    public function get_foreign_labor_list($limit, $start)
    {
        $sql = 'select *
                from foreign_labor limit ' . $start . ', ' . $limit;
        $query = $this->db->query($sql);
        return $query->result();
    }


}

?>