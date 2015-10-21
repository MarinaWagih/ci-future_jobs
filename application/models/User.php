<?php

/**
 * User database class
 */
Class User extends CI_Model
{

    /**
     * insert in database
     * @param $data
     * @return mixed
     */
    public function add($data)
    {
        return $this->db->insert('user',$data);
    }

    /**
     * get new id to be inserted in database
     * @return int
     */
    public function get_new_id()
    {
        $query = "select MAX(id) as id from user";
        $res = $this->db->query($query);
        $res->result_array();
        $last_id = ($res->result()[0]->id)+1;
        return $last_id;
    }

    /**
     * get user by given id
     * @param $id
     * @return mixed
     */
    public function get_user($id)
    {

        $this->db->where('id',$id);
        $query=$this->db->get('user');
        return $query->result_array();

    }

    /**
     * update user Info in database
     * @param $data
     * @return 0 OR 1
     */
    public function update($data)
    {
        $this->db->where('id',$data['id']);
        return $this->db->update('user',$data);
    }

    /**
     * delete user from database
     * @param $id
     * @return 0 OR 1
     */
    public function delete($id)
    {
        $this->db->where('id',$id);
        return $this->db->delete('user');
    }

    /**
     * Pagination in Admin site
     * @param $limit
     * @param $start
     * @return mixed
     */
    public function get_user_list($limit, $start)
    {
        $sql = 'select id, name, email, type , specialty
                from user limit ' . $start . ', ' . $limit;
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function get_user_by_name($name)
    {
        $this->db->where('name',$name);
        $this->db->select(array('id', 'name', 'email','type'));
        $query=$this->db->get('user');
        return $query->result_array();
    }

    public function get_user_by_id($id)
    {
        $this->db->where('id',$id);
        $this->db->select(array('id','name', 'email','type'));
        $query=$this->db->get('user');
        return $query->result_array();
    }

    public function get_user_by_user_email($name)
    {
        $this->db->where('email',$name);
        $this->db->select(array('id', 'name', 'email', 'type'));
        $query=$this->db->get('user');
        return $query->result_array();
    }

    public function login($name,$password)
    {
        $this->db->where('email',$name);
        $this->db->where('password',MD5($password));
        $this -> db -> limit(1);
        $query = $this -> db -> get('user');

        if($query -> num_rows() == 1)
        {
            return $query->result();
        }
        else
        {
            return false;
        }
    }

}
?>