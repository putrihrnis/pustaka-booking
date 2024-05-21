<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
        cek_user();
    }

    public function laporan_buku()
    {
        $data['judul'] = 'Laporan Data Buku';
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        $data['buku'] = $this->ModelBuku->getBuku()->result_array();
        $data['kategori'] = $this->ModelBuku->getKategori()->result_array();
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('buku/laporan_buku', $data);
        $this->load->view('templates/footer');
    }
    public function cetak_laporan_buku()
    {
        $data['buku'] = $this ->ModelBuku->getBuku()->result_array();
        $data['kategori'] = $this ->ModelBuku->getKategori()->result_array();

        $this -> load->view('buku/laporan_print_buku',$data);
    }
    public function laporan_buku_pdf()
    {
        $data['buku'] = $this->ModelBuku->getBuku()->result_array();
        // $this->load->library('dompdf_gen');
        $sroot = $_SERVER['DOCUMENT_ROOT'];
        include $sroot . "/pustaka-booking/application/third_party/dompdf/autoload.inc.php";
        
        $dompdf = new Dompdf\Dompdf();
        $this->load->view('buku/laporan_pdf_buku', $data);
        
        $paper_size = 'A4'; // ukuran kertas
        $orientation = 'landscape'; // tipe format kertas potrait atau landscape
        
        $html = $this->output->get_output();
        $dompdf->set_paper($paper_size, $orientation);
        
        // Convert to PDF
        $dompdf->load_html($html);
        $dompdf->render();
        
        $dompdf->stream("laporan_data_buku.pdf", array('Attachment' => 0));
        // nama file pdf yang dihasilkan
    }
    public function export_excel()
    {
        $data = array ('title' => 'Laporan Buku', 'buku'=>$this ->ModelBuku->getBuku()->result_array());
        $this ->load->view('buku/export_excel_buku',$data);
    }

    public function laporan_anggota()
    {
        $data['judul'] = 'Laporan Data Anggota';
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        $this->db->where('role_id', 2);
        $data['anggota'] = $this->db->get('user')->result_array();
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/laporan_anggota', $data);
        $this->load->view('templates/footer');
    }
    public function cetak_laporan_anggota()
    {
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        $this->db->where('role_id', 2);
        $data['anggota'] = $this->db->get('user')->result_array();

        $this -> load->view('user/laporan_print_anggota',$data);
    }
    public function laporan_anggota_pdf()
    {
        $data['anggota'] = $this->db->get('user')->result_array();
        // $this->load->library('dompdf_gen');
        $sroot = $_SERVER['DOCUMENT_ROOT'];
        include $sroot . "/pustaka-booking/application/third_party/dompdf/autoload.inc.php";
        
        $dompdf = new Dompdf\Dompdf();
        $this->load->view('user/laporan_pdf_anggota', $data);
        
        $paper_size = 'A4'; // ukuran kertas
        $orientation = 'landscape'; // tipe format kertas potrait atau landscape
        
        $html = $this->output->get_output();
        $dompdf->set_paper($paper_size, $orientation);
        
        // Convert to PDF
        $dompdf->load_html($html);
        $dompdf->render();
        
        $dompdf->stream("laporan_data_anggota.pdf", array('Attachment' => 0));
        // nama file pdf yang dihasilkan
    }
    public function export_excel_pinjam() 
    { 
        $data = array( 'title' => 'Laporan Data Peminjaman Buku', 
        'laporan' => $this->db->query("select * from pinjam p,detail_pinjam d, 
        buku b,user u where d.id_buku=b.id and p.id_user=u.id 
        and p.no_pinjam=d.no_pinjam")->result_array()); 
        $this->load->view('pinjam/export_excel_pinjam',$data);
    }
}