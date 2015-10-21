<?php

/**
 * advertisement database class
 */
Class Advertisement extends CI_Model
{

    /**
     * insert in database
     * @param $data
     * @return mixed
     */
    public function add($data)
    {
        return $this->db->insert('advertisement', $data);
    }

    /**
     * get new id to be inserted in database
     * @return int
     */
    public function get_new_id()
    {
        $query = "select MAX(id) as id from advertisement";
        $res = $this->db->query($query);
        $res->result_array();
        $last_id = ($res->result()[0]->id) + 1;
        return $last_id;
    }

    /**
     * get advertisement by given id
     * @param $id
     * @return mixed
     */
    public function get_advertisement($id)
    {

        $this->db->where('id', $id);
        $query = $this->db->get('advertisement');
        return $query->result_array();

    }

    /**
     * left side advertisement
     * @return mixed
     */
    public function get_left()
    {
        $this->db->where('direction', 'left');
        $this->db->order_by("rank", "asc");
        $query = $this->db->get('advertisement');
        return $query->result_array();
    }
    /**
     * right side advertisement
     * @return mixed
     */
    public function get_right()
    {
        $this->db->where('direction', 'right');
        $this->db->order_by("rank", "asc");
        $query = $this->db->get('advertisement');
        return $query->result_array();
    }

    /**
     * update advertisement Info in database
     * @param $data
     * @return 0 OR 1
     */
    public function update($data)
    {
        $this->db->where('id', $data['id']);
        return $this->db->update('advertisement', $data);
    }

    /**
     * delete advertisement from database
     * @param $id
     * @return 0 OR 1
     */
    public function delete($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('advertisement');
    }

    /**
     * Pagination in Admin site
     * @param $limit
     * @param $start
     * @return mixed
     */
    public function get_advertisement_list($limit, $start)
    {
        $sql = 'select *
                from advertisement limit ' . $start . ', ' . $limit;
        $query = $this->db->query($sql);
        return $query->result();
    }


}

?>