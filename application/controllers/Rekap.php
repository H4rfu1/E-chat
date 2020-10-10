<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rekap extends CI_Controller {

  public function __construct(){
    parent::__construct();
    if(!$this->session->userdata('email')){
      redirect('auth');
    }
  }

  public function index(){
    $breadcrumb         = array(
            "Rekap Laporan KSTM" => ""
        );
    $data['breadcrumb'] = $breadcrumb;
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    $this->load->model('Laporan_model', 'laporan');
    $data['title'] = 'Rekap';
    $data['laporan'] = $this->laporan->getLaporanKSTM();
    $data['tipe'] = 'kstm';

    $this->load->view('templates/dash_header', $data);
    $this->load->view('templates/dash_sidebar', $data);
    $this->load->view('templates/dash_topbar', $data);
    $this->load->view('rekap/index', $data);
    $this->load->view('templates/dash_footer');

  }

  public function kstm($id = ''){
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    $this->load->model('Laporan_model', 'laporan');
    if ($id == '') {
      $breadcrumb         = array(
              "Rekap Laporan KSTM" => ""
          );
      $data['breadcrumb'] = $breadcrumb;
      $data['title'] = 'Rekap Laporan KSTM';
      $data['laporan'] = $this->laporan->getLaporanKSTM();
      $data['tipe'] = 'kstm';

      $this->load->view('templates/dash_header', $data);
      $this->load->view('templates/dash_sidebar', $data);
      $this->load->view('templates/dash_topbar', $data);
      $this->load->view('rekap/index', $data);
      $this->load->view('templates/dash_footer');
    } else {
      $breadcrumb         = array(
              "Rekap Laporan KSTM" => "kstm",
              "Detail Laporan KSTM" => ""
          );
      $data['breadcrumb'] = $breadcrumb;
      $data['title'] = 'Detail Laporan KSTM';
      $data['laporan'] = $this->laporan->getLaporanKSTM();
      $data['tipe'] = 'kstm';

      $this->load->view('templates/dash_header', $data);
      $this->load->view('templates/dash_sidebar', $data);
      $this->load->view('templates/dash_topbar', $data);
      $this->load->view('rekap/index', $data);
      $this->load->view('templates/dash_footer');
    }



  }
  public function pengontrol(){
    $breadcrumb         = array(
            "Rekap Laporan Pengontrol Lapangan" => ""
        );
    $data['breadcrumb'] = $breadcrumb;
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    $this->load->model('Laporan_model', 'laporan');
    $data['title'] = 'Rekap Laporan Pengontrol Lapangan';
    $data['laporan'] = $this->laporan->getLaporanPengontrol();
    $data['tipe'] = 'pengontrol';

    $this->load->view('templates/dash_header', $data);
    $this->load->view('templates/dash_sidebar', $data);
    $this->load->view('templates/dash_topbar', $data);
    $this->load->view('rekap/index', $data);
    $this->load->view('templates/dash_footer');

  }


  public function detail($tipe='', $id = 0){
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    $this->load->model('Laporan_model', 'laporan');
    if ($tipe == '' or $id == 0) {
      redirect('rekap');
    }
    if ($tipe == 'kstm') {
      $data['tipe'] = 'kstm';
      $data['title'] = 'Detail Laporan KSTM';
      $breadcrumb         = array(
              "Rekap Laporan Pengontrol kstm" => "rekap/kstm",
              "Detail" => ""
          );
      $data['breadcrumb'] = $breadcrumb;
      $data['laporan'] = $this->laporan->getLaporanKSTMById($id);
      $data['komen'] = $this->laporan->getKomenKSTM($id);
    } elseif ($tipe == 'pengontrol') {
      $data['tipe'] = 'pengontrol';
      $data['title'] = 'Detail Laporan Pengontrol Lapangan';
      $breadcrumb         = array(
              "Rekap Laporan Pengontrol Lapangan" => "rekap/pengontrol",
              "Detail" => ""
          );
      $data['breadcrumb'] = $breadcrumb;
      $data['laporan'] = $this->laporan->getLaporanPengontrolById($id);
      $data['komen'] = $this->laporan->getKomenPengontrol($id);
    }else {
      redirect('rekap');
    }

    $this->form_validation->set_rules('isi_tanggapan','Isi tanggapan', 'required', [
      'required' => "Komentar harus diisi"]);

    if($this->form_validation->run() == false){
      $this->load->view('templates/dash_header', $data);
      $this->load->view('templates/dash_sidebar', $data);
      $this->load->view('templates/dash_topbar', $data);
      $this->load->view('rekap/detail', $data);
      $this->load->view('templates/dash_footer');
    }else {
      $data = [
        'id_penanggap' => $this->session->userdata('id'),
        'id_laporan' => $id,
        'tanggal_tanggapan' => time(),
        'isi_tanggapan' => htmlspecialchars( $this->input->post('isi_tanggapan'))
      ];
      if ($tipe == 'kstm') {
        $this->db->insert('tanggapan_kstm', $data);
      } else {
        $this->db->insert('tanggapan_pengontrol', $data);
      }
      if ($this->db->affected_rows() > 0) {
        $pesan = '<div class="alert alert-success" role="alert"> Komen berhasil ditambah </div>';
        $this->session-> set_flashdata('message', $pesan);
      }
      redirect('rekap/detail/'.$tipe.'/'.$id);
    }

  }

  // Export data in CSV format
  public function exportCSV($tipe = 'kstm'){
    $this->load->model('Laporan_model', 'laporan');
    if ($tipe == 'pengontrol') {
      // file name
      $filename = 'laporan_pengontrol_'.date('Ymd').'.csv';
      header("Content-Description: File Transfer");
      header("Content-Disposition: attachment; filename=$filename");
      header("Content-Type: application/csv; ");

      // get data
      $usersData = $this->laporan->getLaporanPengontrol();;

      // file creation
      $file = fopen('php://output', 'w');

      $header = array("Name","tanggal","deskripsi");
      fputcsv($file, $header);
      foreach ($usersData as $key){
        $row = array($key['name'],date('d F Y', $key['tanggal_laporan']),$key['deskripsi_laporan']);
        fputcsv($file,$row);
      }
      fclose($file);
      exit;
    } else {
      // file name
      $filename = 'laporan_kstm_'.date('Ymd').'.csv';
      header("Content-Description: File Transfer");
      header("Content-Disposition: attachment; filename=$filename");
      header("Content-Type: application/csv; ");

      // get data
      $usersData = $this->laporan->getLaporanKSTM();;
      ini_set('memory_limit', '1024M');
      // file creation
      $file = fopen('php://output', 'w');

      $header = array("ID Pelapor", "Nama Pelapor", "Tanggal Laporan", "Deskripsi Laporan", "Jenis Ternak", "Jumlah Ternak Sebelumnya", "Jumlah Ternak Sekarang", "Jumlah Ternak Meninggal", "Keterangan Ternak Meninggal", "Jumlah Ternak Sehat", "Jumlah Ternak Sakit", "Keterangan Kesehatan Ternak", "Jumlah Ternak Dikonsumsi", "Keterangan Konsumsi", "Jumlah Ternak Dijual", "Harga Ternak Perekor");
      fputcsv($file, $header);
      foreach ($usersData as $key){
        $row1 = array($key['id_pelapor'], $key['name'], date('d F Y', $key['tanggal_laporan']), $key['deskripsi_laporan'], $key['jenis_ternak'], $key['jumlah_ternak_sebelumnya'], $key['jumlah_ternak_sekarang'], $key['jumlah_ternak_meninggal']);
        $row2 = array($key['keterangan_ternak_meninggal'], $key['jumlah_ternak_sehat'] , $key['jumlah_ternak_sakit'] , $key['keterangan_kesehatan_ternak'], $key['jumlah_ternak_dikonsumsi'], $key['keterangan_konsumsi'], $key['jumlah_ternak_dijual'], $key['harga_ternak_perekor']);
        $row =  array_merge($row1, $row2);
        fputcsv($file,$row);
      }
      fclose($file);
      exit;
    }
  }

  //export Excel
  public function exportExcel($tipe = 'kstm'){
    /*******EDIT LINES 3-8*******/
    $DB_Server = "localhost"; //MySQL Server
    $DB_Username = "username"; //MySQL Username
    $DB_Password = "password";             //MySQL Password
    $DB_DBName = "databasename";         //MySQL Database Name
    $DB_TBLName = "tablename"; //MySQL Table Name
    $filename = "excelfilename";         //File Name
    /*******YOU DO NOT NEED TO EDIT ANYTHING BELOW THIS LINE*******/
    //create MySQL connection
    $sql = "Select * from $DB_TBLName";
    $Connect = @mysql_connect($DB_Server, $DB_Username, $DB_Password) or die("Couldn't connect to MySQL:<br>" . mysql_error() . "<br>" . mysql_errno());
    //select database
    $Db = @mysql_select_db($DB_DBName, $Connect) or die("Couldn't select database:<br>" . mysql_error(). "<br>" . mysql_errno());
    //execute query
    $result = @mysql_query($sql,$Connect) or die("Couldn't execute query:<br>" . mysql_error(). "<br>" . mysql_errno());
    $file_ending = "xls";
    //header info for browser
    header("Content-Type: application/xls");
    header("Content-Disposition: attachment; filename=$filename.xls");
    header("Pragma: no-cache");
    header("Expires: 0");
    /*******Start of Formatting for Excel*******/
    //define separator (defines columns in excel & tabs in word)
    $sep = "\t"; //tabbed character
    //start of printing column names as names of MySQL fields
    for ($i = 0; $i < mysql_num_fields($result); $i++) {
    echo mysql_field_name($result,$i) . "\t";
    }
    print("\n");
    //end of printing column names
    //start while loop to get data
    while($row = mysql_fetch_row($result))
    {
        $schema_insert = "";
        for($j=0; $j<mysql_num_fields($result);$j++)
        {
            if(!isset($row[$j]))
                $schema_insert .= "NULL".$sep;
            elseif ($row[$j] != "")
                $schema_insert .= "$row[$j]".$sep;
            else
                $schema_insert .= "".$sep;
        }
        $schema_insert = str_replace($sep."$", "", $schema_insert);
        $schema_insert = preg_replace("/\r\n|\n\r|\n|\r/", " ", $schema_insert);
        $schema_insert .= "\t";
        print(trim($schema_insert));
        print "\n";
    }
  }
}
