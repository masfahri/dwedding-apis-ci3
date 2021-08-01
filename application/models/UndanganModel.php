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
<<<<<<< HEAD
      
=======
        $this->db->where('mempelai.id_user', $id_user);
        $this->db->join('data', 'mempelai.id_user = data.id_user');
        $query = $this->db->get('mempelai');
        return $query->row();
>>>>>>> ab7a21b50a61840ebc678c749d6537871e386d80
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

<<<<<<< HEAD
    public function getDataMempelai($domain = null)
    {
        $this->db->select('mempelai.*');
        $this->db->join('mempelai', 'order.id_user = mempelai.id_user');
        $this->db->where('order.domain', $domain);
        $query = $this->db->get('order');
        return $query->row();    
    }

    public function getDataResepsi($domain = null)
    {
        $this->db->select('jam_akad, tempat_akad, alamat_akad, direction_akad, tanggal_resepsi,jam_resepsi,tempat_resepsi,
                            alamat_resepsi,direction_resepsi');
        $this->db->join('acara', 'order.id_user = acara.id_user');
        $this->db->where('order.domain', $domain);
        $query = $this->db->get('order');
        return $query->row();    
    }

    public function getDataLamaran($domain = null)
    {
        $this->db->select('tanggal_lamaran,jam_lamaran,tempat_lamaran,alamat_lamaran,direction_lamaran,longlat_lamaran');
        $this->db->join('acara', 'order.id_user = acara.id_user');
        $this->db->where('order.domain', $domain);
        $query = $this->db->get('order');
        return $query->row();    
    }

    public function getDataLokasi($domain = null)
    {
        $this->db->select('maps');
        $this->db->join('data', 'order.id_user = data.id_user');
        $this->db->where('order.domain', $domain);
        $query = $this->db->get('order');
        return $query->row();    
    }

    public function getDataKomen($domain = null)
    {
        $this->db->select('*');
        $this->db->join('komen', 'order.id_user = komen.id_user');
        $this->db->where('order.domain', $domain);
        $query = $this->db->get('order');
        return $query->result();    
    }

    public function getDataAmplop($domain = null)
    {
        $this->db->select('amplop.*');
        $this->db->join('mempelai', 'order.id_user = mempelai.id_user');
        $this->db->join('amplop', 'mempelai.id = amplop.id_mempelai');
        $this->db->where('order.domain', $domain);
        $query = $this->db->get('order');
        return $query->result();    
    }

    public function getDataGift($domain = null)
    {
        $this->db->select('gift.*');
        $this->db->join('gift', 'order.id_user = gift.id_user');
        $this->db->where('order.domain', $domain);
        $query = $this->db->get('order');
        return $query->result();    
    }
    
=======
    public function getDataMempelai($id_user)
    {
        $this->db->select('*');
        $query = $this->db->get('mempelai'); //Diambil dari table Mempelai
        return $query->row();
    }
>>>>>>> ab7a21b50a61840ebc678c749d6537871e386d80

}