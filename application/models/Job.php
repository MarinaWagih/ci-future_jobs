<?php

/**
 * job database class
 */
Class Job extends CI_Model
{

    /**
     * insert in database
     * @param $data
     * @return mixed
     */
    public function add($data)
    {
        return $this->db->insert('job', $data);
    }

    /**
     * get new id to be inserted in database
     * @return int
     */
    public function get_new_id()
    {
        $query = "select MAX(id) as id from job";
        $res = $this->db->query($query);
        $res->result_array();
        $last_id = ($res->result()[0]->id) + 1;
        return $last_id;
    }

    /**
     * get job by given id
     * @param $id
     * @return mixed
     */
    public function get_job($id)
    {

        $this->db->where('id', $id);
        $query = $this->db->get('job');
        return $query->result_array();

    }

    /**
     * update job Info in database
     * @param $data
     * @return 0 OR 1
     */
    public function update($data)
    {
        $this->db->where('id', $data['id']);
        return $this->db->update('job', $data);
    }

    /**
     * delete job from database
     * @param $id
     * @return 0 OR 1
     */
    public function delete($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('job');
    }

    /**
     * Pagination in Admin site
     * @param $limit
     * @param $start
     * @return mixed
     */
    public function get_job_list($limit, $start)
    {
        $sql = "select job . * , category.name AS 'category_name',
                      category.name_ar AS 'category_name_ar',
                      country.name ,country.name_ar
                from job
                INNER JOIN category on (job.category_id=category.id)
                INNER JOIN country on (job.country_id=country.id)
                ORDER BY job.id ASC
                limit " . $start . ', ' . $limit;
        $query = $this->db->query($sql);
        return $query->result();
    }
    public function get_job_recent_list($limit, $start)
    {
        $sql = "select job . * , category.name AS 'category_name',
                      category.name_ar AS 'category_name_ar',
                      country.name ,country.name_ar
                from job
                INNER JOIN category on (job.category_id=category.id)
                INNER JOIN country on (job.country_id=country.id)
                ORDER BY job.id DESC
                limit " . $start . ', ' . $limit;
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function get_job_recent_list_by_country_category($limit, $start,$country_id,$category_id)
    {
        $sql = "select job . * , category.name AS 'category_name',
                      category.name_ar AS 'category_name_ar',
                      country.name ,country.name_ar
                from job
                INNER JOIN category on (job.category_id=category.id)
                INNER JOIN country on (job.country_id=country.id)
                WHERE job.country_id = $country_id
                AND job.category_id = $category_id
                ORDER BY job.id DESC
                limit $start ,  $limit";
        $query = $this->db->query($sql);
        return $query->result();
    }
public function get_job_recent_list_by_country($limit, $start,$id)
    {
        $sql = "select job . * , category.name AS 'category_name',
                      category.name_ar AS 'category_name_ar',
                      country.name ,country.name_ar
                from job
                INNER JOIN category on (job.category_id=category.id)
                INNER JOIN country on (job.country_id=country.id)
                WHERE job.country_id = $id
                ORDER BY job.id DESC
                limit $start ,  $limit";
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function get_count_job_recent_list_by_country($id)
    {
        $sql = "select count(*) AS count
                from job
                WHERE job.country_id = $id";
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function apply($id,$user_id)
    {
        //`user_id`, `jobs_id`, `date`
        $data['user_id']=$user_id;
        $data['jobs_id']=$id;
        $data['date']=date('Y-m-d H:i:s');
        return $this->db->insert('user_jobs', $data);
    }

    public function get_applied_jobs($user_id)
    {
        //`user_id`, `jobs_id`, `date`
        $sql = "select job . * , category.name AS 'category_name',
                      category.name_ar AS 'category_name_ar',
                      country.name ,country.name_ar
                from user_jobs
                INNER JOIN job on (user_jobs.jobs_id=job.id)
                INNER JOIN category on (job.category_id=category.id)
                INNER JOIN country on (job.country_id=country.id)
                WHERE user_jobs.user_id=$user_id
                ORDER BY job.id DESC";
        $query = $this->db->query($sql);
        return $query->result();

    }

    public function get_applied_users($job_id)
    {
        //`user_id`, `jobs_id`, `date`
        $sql = "select *
                from user_jobs
                INNER JOIN user on (user_jobs.user_id=user.id)
                WHERE user_jobs.jobs_id=$job_id";
        $query = $this->db->query($sql);
        return $query->result();

    }

}

?>