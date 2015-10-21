<?php

/**
 * category database class
 */
Class Category extends CI_Model
{

    /**
     * insert in database
     * @param $data
     * @return mixed
     */
    public function add($data)
    {
        return $this->db->insert('category', $data);
    }

    /**
     * get new id to be inserted in database
     * @return int
     */
    public function get_new_id()
    {
        $query = "select MAX(id) as id from category";
        $res = $this->db->query($query);
        $res->result_array();
        $last_id = ($res->result()[0]->id) + 1;
        return $last_id;
    }

    /**
     * get category by given id
     * @param $id
     * @return mixed
     */
    public function get_category($id)
    {

        $this->db->where('id', $id);
        $query = $this->db->get('category');
        return $query->result_array();

    }

    /**
     * update category Info in database
     * @param $data
     * @return 0 OR 1
     */
    public function update($data)
    {
        $this->db->where('id', $data['id']);
        return $this->db->update('category', $data);
    }

    /**
     * delete category from database
     * @param $id
     * @return 0 OR 1
     */
    public function delete($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('category');
    }

    /**
     * Pagination in Admin site
     * @param $limit
     * @param $start
     * @return mixed
     */
    public function get_category_list($limit, $start)
    {
        $sql = 'select id, name, name_ar
                from category limit ' . $start . ', ' . $limit;
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function get_category_by_category_name($name)
    {
        $this->db->where('name', $name);
        $this->db->or_where('name_ar', $name);
        $this->db->select(array('id', 'name', 'name_ar'));
        $query = $this->db->get('category');
        return $query->result_array();
    }


    public function  get_all_categories()
    {

        $query = $this->db->get('category');
        return $query->result_array();

    }

}

?>