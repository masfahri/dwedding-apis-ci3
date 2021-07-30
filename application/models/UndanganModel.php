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
    
    public function getAmplop($id_user)
    {
        $mempelai = $this->db->select('id')->where('id_user', $id_user)->get('mempelai')->row();
        $amplop = $this->db->where('id_mempelai', $mempelai->id)->get('amplop')->result();
        $data = array();
        for ($i=0; $i < count($amplop); $i++) { 
            $data[] = json_decode($amplop[$i]->_meta);
        }
        return $data;
    }

    public function getFlagAcara($id_user)
    {
        $this->db->select('flag')->where('id_user', $id_user);
        $query = $this->db->get('acara');
        return $query->row_array();
    }

    public function getAlbum($id_user)
    {
        $this->db->where('id_user', $id_user);
        $query = $this->db->get('album');
        return $query->result();
    }

    public function getGift($id_user)
    {
        $this->db->where('id_user', $id_user);
        $query = $this->db->get('gift');
        return $query->row();
    }

    public function getData($id_user)
    {
        $this->db->where('id_user', $id_user);
        $query = $this->db->get('data');
        return $query->row();
    }

    /**
     * Get Data per-Page
     *
     * @param int $id_user
     * @return Row
     */
    public function getDataSampul($id_user)
    {
        $this->db->select('nama_pria, nama_panggilan_pria, nama_wanita, nama_panggilan_wanita, nama_ibu_pria, nama_ayah_pria, nama_ibu_wanita, nama_ayah_wanita,  salam_pembuka, quotes, kunci, foto_pria, foto_wanita, flag');
        $this->db->where('mempelai.id_user', $id_user);
        $this->db->join('data', 'mempelai.id_user = data.id_user');
        $this->db->join('acara', 'acara.id_user = data.id_user');
        $query = $this->db->get('mempelai');
        return $query->row();    
    }

    public function getDataMempelai($id_user)
    {
        $this->db->select('*');
        $query = $this->db->get('mempelai'); //Diambil dari table Mempelai
        return $query->row();
    }

}