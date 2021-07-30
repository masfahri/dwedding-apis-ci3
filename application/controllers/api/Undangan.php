<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, OPTIONS");

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Undangan extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }

	public function sampul_get()
	{
		$this->load->model('UndanganModel');
		$domain = $this->get('domain');
		$data = $this->UndanganModel->getDomain($domain);
		if ($data == false) {
			$response = array('Tidak Ada Apapun Disini');
			$code = 404;
		}else{
			$response['data'] = $this->UndanganModel->getDataSampul($data->id_user);
			$code = 200;
		} $this->response($response, $code);
	}

    // function index_get()
    // {
    //     $this->load->model('UndanganModel');
    //     $domain = $this->get('domain');
    //     if ($this->UndanganModel->getDomain($domain) == false) {
    //         $data = array('Tidak Ada Apapun Disini');
    //     }else{
    //         $data     = $this->UndanganModel->getDomain($domain);
    //         $result   = $this->UndanganModel->getMempelai($data->id_user);
    //         // $result['acara']      = $this->UndanganModel->getAcara($data->id_user);
    //         // $result['komen']      = $this->UndanganModel->getKomen($data->id_user);
    //     }
    //     // $data['rules'] = $this->UndanganModel->getRules($domain) == false ? array('data' => 'Tidak Ada Apapun Disini') : array('data' => $this->UndanganModel->getDomain($domain));
    //     $this->response($result, 200);
    // }

	public function data_get()
	{
		$this->load->model('UndanganModel');
        $domain = $this->get('domain');
        if ($this->UndanganModel->getDomain($domain) == false) {
            $data = array('Tidak Ada Apapun Disini');
        }else{
            $data     			  = $this->UndanganModel->getDomain($domain);
			$result	   			  = $this->UndanganModel->getFlagAcara($data->id_user);
            $result['mempelai']   = $this->UndanganModel->getMempelai($data->id_user);
            $result['acara']      = $this->UndanganModel->getAcara($data->id_user);
            $result['komen']      = $this->UndanganModel->getKomen($data->id_user);
            $result['amplop']     = $this->UndanganModel->getAmplop($data->id_user);
			$result['album']	  = $this->UndanganModel->getAlbum($data->id_user);
			$result['gift']	  	  = $this->UndanganModel->getGift($data->id_user);
			$result['data']		  = $this->UndanganModel->getData($data->id_user);
        }
        $this->response($result, 200);
        // $data['rules'] = $this->UndanganModel->getRules($domain) == false ? array('data' => 'Tidak Ada Apapun Disini') : array('data' => $this->UndanganModel->getDomain($domain));
	}

	function mempelai_get()
	{
		echo 'Ini metod Post';
	}

    //Menampilkan data kontak
    // function index_get() {
    //     $web = $this->uri->getSegment(2); //memabaca domain user
	// 	$invite = $this->uri->getSegment(3); //orang yang diundang disini

	// 	$data['web'] = urldecode($web);
	// 	$data['invite'] = urldecode($invite);
		
	// 	//melakukan pengeceakan ke database
	// 	$cekDomain = $this->UndanganModel->cek_domain(urldecode($web));

	// 	//jika ditemukan lanjut ke proses selanjutnya
	// 	if(!empty($cekDomain->getResult())){
			
	// 		//jika data ditemukan maka kita akan ambil id_user nya
	// 		foreach ($cekDomain->getResult() as $row)
	// 		{
	// 			$idnya = $row->id_user;
	// 			$this->session->set('id_user',$idnya); //save di session untuk di load jika komentar
	// 		}

	// 		$data['mempelai_'] = $this->UndanganModel->get_mempelai($idnya)->getRow();
	// 		$data['acara_'] = $this->UndanganModel->get_acara($idnya)->getRow();
	// 		$data['komen_'] = $this->UndanganModel->get_komen($idnya);
	// 		$data['data_'] = $this->UndanganModel->get_data($idnya)->getRow();
	// 		$data['cerita_'] = $this->UndanganModel->get_cerita($idnya);
	// 		$data['album_'] = $this->UndanganModel->get_album($idnya);
	// 		$data['rules_'] = $this->UndanganModel->get_rules($idnya);
	// 		$data['pembayaran_'] = $this->UndanganModel->get_pembayaran($idnya);
	// 		$data['setting_'] = $this->UndanganModel->get_setting($idnya);
    //         $data['tanggal_acara_'] = $this->UndanganModel->get_acara($idnya)->getRow()->flag != 'lamaran' ? $this->UndanganModel->get_acara($idnya)->getRow()->tanggal_akad : $this->UndanganModel->get_acara($idnya)->getRow()->tanggal_lamaran;
	// 		$data['quotes_'] = $this->UndanganModel->get_data($idnya)->getRow()->quotes == null ? '' : $this->UndanganModel->get_data($idnya)->getRow()->quotes;
	// 		$data['gift_'] = $this->GiftModel->Read($idnya)->getRow()->alamat == null ? '' : $this->GiftModel->Read($idnya)->getRow()->alamat;

			
	// 		//id_user kemudian digunakan untuk mengambil semua data yang dibutuhkan
	// 		$data['mempelai'] = $this->UndanganModel->get_mempelai($idnya);
	// 		$data['acara'] = $this->UndanganModel->get_acara($idnya);
	// 		$data['komen'] = $this->UndanganModel->get_komen($idnya);
	// 		$data['data'] = $this->UndanganModel->get_data($idnya);
	// 		$data['cerita'] = $this->UndanganModel->get_cerita($idnya);
	// 		$data['album'] = $this->UndanganModel->get_album($idnya);
	// 		$data['rules'] = $this->UndanganModel->get_rules($idnya);
	// 		$data['pembayaran'] = $this->UndanganModel->get_pembayaran($idnya);
	// 		$data['setting'] = $this->UndanganModel->get_setting();
    //         $data['tanggal_acara'] = $this->UndanganModel->get_acara($idnya)->getRow()->flag != 'lamaran' ? $this->UndanganModel->get_acara($idnya)->getRow()->tanggal_akad : $this->UndanganModel->get_acara($idnya)->getRow()->tanggal_lamaran;
    //         $data['quotes'] = $this->UndanganModel->get_data($idnya)->getRow()->quotes == null ? '' : $this->UndanganModel->get_data($idnya)->getRow()->quotes;

    //         $data['amplop'] = $this->amplop->Read($data['mempelai']->getResult()[0]->id);
	// 		$data['maps'] = $this->UndanganModel->getMaps($_SESSION['id_user']);

	// 		//cek pada tabel order untuk mengambil tema yang digunakan user
	// 		$ordernya = $this->UndanganModel->get_order($idnya);

	// 		//ini untuk mendefinisikan tema undangan secara default 
	// 		//apabila tema yang direquest user tidak ditemukan
	// 		$temanya = 'radiantdark';

    //         //Module
    //         $data['bottomNav'] 		= 'undangan/komponen/bottomNav';
    //         $data['comp_amplop'] 	= 'undangan/komponen/amplop';
    //         $data['comp_rsvp']     	= 'undangan/komponen/rsvp';
    //         $data['comp_acara']     = 'undangan/komponen/acara';
    //         $data['comp_sampul']    = 'undangan/komponen/sampul';

	// 		//jika tema ditemukan maka
	// 		//variabel tema akan di 'repleace' sesuai tema pilihan user
	// 		if(!empty($ordernya->getResult())){
    // 			foreach ($ordernya->getResult() as $row){ 
    // 				$temanya = $row->nama_theme;
    // 			}		    
	// 		}

	// 		//insert traffic to db
	// 		if($invite != NULL){
	// 			$dataTraffic['nama_pengunjung'] = urldecode($invite);
	// 		}else{
	// 			$dataTraffic['nama_pengunjung'] = "Unknown";
	// 		}
	// 		$dataTraffic['id_user'] = $idnya;
	// 		$dataTraffic['addr'] = $this->get_client_ip();

	// 		$this->UndanganModel->insert_traffic($dataTraffic);
    //         // echo view('undangan/components/bottom_nav', $data);
	// 		//kirim semua data pada view
    //         return view('undangan/themes/'.$temanya, $data);
	// 	}else{
	// 		return $this->index();
	// 	}
    // }


    //Masukan function selanjutnya disini
}
?>