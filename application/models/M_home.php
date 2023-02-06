<?php
class M_home extends CI_Model 
{
	function getData() {
        return $this->db->get('data_project')->result_array();
    }

    function getProjectById($id) {
        $this->db->where('id_project', $id);
        return $this->db->get('data_project')->result_array();
    }

    function addProject($data) {
        $this->db->insert('data_project', $data);
        return $this->db->affected_rows();
    }

    function updateProject($data, $id) {
        $this->db->where('id_project', $id);
        $this->db->update('data_project', $data);
        return $this->db->affected_rows();
    }

    function deleteProject($id) {
        $this->db->where('id_project', $id);
        $this->db->delete('data_project');
        return $this->db->affected_rows();
    }
}
