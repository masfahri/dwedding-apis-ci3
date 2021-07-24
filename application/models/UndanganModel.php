<?php
class UndanganModel extends CI_Model {

    public function getDomain($domain)
    {
        if (empty($domain)) {
            return false;
        }
        $this->db->where('domain', $domain);
        $query = $this->db->get('order');
        return $query->row();
    }

    public function getMempelai($id_user)
    {
        $this->db->where('mempelai.id_user', $id_user);
        $this->db->join('data', 'mempelai.id_user = data.id_user');
        $query = $this->db->get('mempelai');
        return $query->row();
    }

    public function getAcara($id_user)
    {
        return $this->db->where('id_user', $id_user)->get('acara')->row();
    }
    
    public function getKomen($id_user)
    {
        return $this->db->where('id_user', $id_user)->order_by('created_at', 'desc')->get('komen')->result();
    }
}