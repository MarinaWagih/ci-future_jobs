<?php

/**
 * country database class
 */
Class Country extends CI_Model
{

    /**
     * insert in database
     * @param $data
     * @return mixed
     */
    public function add($data)
    {
        return $this->db->insert('country', $data);
    }

    /**
     * get new id to be inserted in database
     * @return int
     */
    public function get_new_id()
    {
        $query = "select MAX(id) as id from country";
        $res = $this->db->query($query);
        $res->result_array();
        $last_id = ($res->result()[0]->id) + 1;
        return $last_id;
    }

    /**
     * get country by given id
     * @param $id
     * @return mixed
     */
    public function get_country($id)
    {

        $this->db->where('id', $id);
        $query = $this->db->get('country');
        return $query->result_array();

    }

    /**
     * update country Info in database
     * @param $data
     * @return 0 OR 1
     */
    public function update($data)
    {
        $this->db->where('id', $data['id']);
        return $this->db->update('country', $data);
    }

    /**
     * delete country from database
     * @param $id
     * @return 0 OR 1
     */
    public function delete($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('country');
    }

    /**
     * Pagination in Admin site
     * @param $limit
     * @param $start
     * @return mixed
     */
    public function get_country_list($limit, $start)
    {
        $sql = 'select id, name, name_ar
                from country limit ' . $start . ', ' . $limit;
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function get_country_by_country_name($name)
    {
        $this->db->where('name', $name);
        $this->db->or_where('name_ar', $name);
        $this->db->select(array('id', 'name', 'name_ar'));
        $query = $this->db->get('country');
        return $query->result_array();
    }

    public function get_country_by_id($id)
    {
        $this->db->where('id', $id);
        $this->db->select(array('name', 'name_ar', 'id'));
        $query = $this->db->get('country');
        return $query->result_array();
    }

    public function  get_all_countries()
    {

        $query = $this->db->get('country');
        return $query->result_array();

    }

}

?>