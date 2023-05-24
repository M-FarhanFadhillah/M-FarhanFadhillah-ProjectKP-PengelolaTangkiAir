<?php if (!defined('BASEPATH'))
	exit('No direct script access allowed');

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Pengiriman extends Admin_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model("pengiriman_model");
		$this->load->model("barang_model");
	}
	public function index()
	{
		$this->cekLoginStatus("admin",true);

		$data['title'] = "DATA PENGIRIMAN";
		$data['layout'] = "pengiriman/index";

		$filter = new StdClass();
		$filter->keyword = trim($this->input->get('keyword'));

		$orderBy = $this->input->get('orderBy');
		$orderType = $this->input->get('orderType');
		$page = $this->input->get('page');

		$limit = 15;
		if (!$page)
			$page = 1;

		$offset = ($page - 1) * $limit;

		list($data['data'], $total) = $this->pengiriman_model->getAll($filter, $limit, $offset, $orderBy, $orderType);

		$this->load->library('pagination');
		$config['base_url'] = site_url("pengiriman?");
		$config['total_rows'] = $total;
		$config['per_page'] = $limit;
		$config['query_string_segment'] = 'page';
		$config['use_page_numbers'] = TRUE;
		$config['page_query_string'] = TRUE;

		$this->pagination->initialize($config);
		$this->load->view('template', $data);
	}

	public function manage($id = "")
	{
		$this->cekLoginStatus("admin",true);

		$filter = new StdClass();
		$filter->keyword = trim($this->input->get('keyword'));

		$orderBy = $this->input->get('orderBy');
		$orderType = $this->input->get('orderType');
		$page = $this->input->get('page');

		$limit = 15;
		if (!$page)
			$page = 1;

		$offset = ($page - 1) * $limit;

		$data['title'] = "FORM PENGIRIMAN";
		$data['layout'] = "pengiriman/manage";

		$data['data'] = new StdClass();
		$data['data']->id_pengiriman = "";
		$data['data']->tanggal = "";
		$data['data']->id_kategori = "";
		$data['data']->kategori = "";
		$data['data']->barang = $this->barang_model->getAll($filter, $limit, $offset, $orderBy, $orderType);
		$data['data']->id_pelanggan = "";
		$data['data']->pelanggan = "";
		$data['data']->alamat = "";
		$data['data']->id_kurir = "";
		$data['data']->kurir = "";
		$data['data']->status = "";
		$data['data']->keterangan = "";
		$data['data']->penerimaan = "";
		$data['data']->no_kendaraan = "";
		$data['data']->autocode = $this->generate_code();
		$data['jumlah_barang'] = 0;
		$data['list_barang'] = $this->barang_model->getAll($filter, $limit, $offset, $orderBy, $orderType);

		if ($id) {
			$dt = $this->pengiriman_model->get_by("pg.id_pengiriman", $id, true);
			$barang = $this->pengiriman_model->get_pengiriman_item($id);
			if (!empty($dt)) {
				$data['jumlah_barang'] = count($barang);
				$data['data'] = $dt;
				$data['barang'] = $barang;
			}
		}

		$this->load->view('template', $data);
	}

	public function save()
	{
		$this->cekLoginStatus("admin",true);

		$data = array();
		$post = $this->input->post();


		if ($post) {
			$error = array();


			if (!empty($post['id_pengiriman'])) {
				$data['id_pengiriman'] = $post['id_pengiriman'];
				$id = $post['id_pengiriman'];
			} else
				$error[] = "id tidak boleh kosong";

			if (!empty($post['tanggal']))
				$data['tanggal'] = DateTime::createFromFormat('d/m/Y', $post['tanggal'])->format('Y-m-d');
			else
				$error[] = "tanggal tidak boleh kosong";

			if (!empty($post['id_pelanggan']))
				$data['id_pelanggan'] = $post['id_pelanggan'];
			else
				$error[] = "pelanggan tidak boleh kosong";

			if (!empty($post['id_kurir']))
				$data['id_kurir'] = $post['id_kurir'];
			else
				$error[] = "kurir tidak boleh kosong";

			if (!empty($post['no_kendaraan']))
				$data['no_kendaraan'] = $post['no_kendaraan'];
			else
				$error[] = "no kendaraan tidak boleh kosong";


			$data['status'] = 1;

			if (!empty($id)) {
				if (!empty($post['status']))
					$data['status'] = $post['status'];
			}

			if ($data['status'] != 1) {
				if ($data['status'] != "3") {
					$data['penerima'] = "";
					$data['keterangan'] = "";
				} else {

					if (!empty($post['penerima']))
						$data['penerima'] = $post['penerima'];
					else
						$error[] = "Penerima tidak boleh kosong";

					if (!empty($post['keterangan']))
						$data['keterangan'] = $post['keterangan'];
					else
						$error[] = "keterangan tidak boleh kosong";
				}
			}

			// if (empty($error)) {
			// 	if (empty($id)) {
			// 		$cekpengiriman = $this->pengiriman_model->get_by("pg.id_pengiriman", $post['id_pengiriman']);
			// 		if (!empty($cekpengiriman))
			// 			$error[] = "id sudah terdaftar";
			// 	}
			// }

			// 	echo '<pre>';
			// var_export($detail);
			// echo '</pre>';
			// die();

			if (empty($error)) {
				$save = $this->pengiriman_model->save($id, $data, false);
				$detail = $post['detail'];
				$detailkode = $detail['id_barang'];
				$detailjumlah = $detail['qty'];

				if (!empty($id)) {
					$this->pengiriman_model->remove_detail($id);
				}

				foreach ($detailkode as $key) {

					if (empty($id))
						$detail['id_pengiriman'] = $data['id_pengiriman'];
					else
						$detail['id_pengiriman'] = $id;

					$detail['id_barang'] = $key;
					$detail['qty'] = $detailjumlah[$key];
					$this->pengiriman_model->save_detail($detail);
				}


				$this->session->set_flashdata('admin_save_success', "data berhasil disimpan");

				if ($post['action'] == "save")
					redirect("pengiriman/manage/" . $id);
				else
					redirect("pengiriman");
			} else {
				$err_string = "<ul>";
				foreach ($error as $err)
					$err_string .= "<li>" . $err . "</li>";
				$err_string .= "</ul>";

				$this->session->set_flashdata('admin_save_error', $err_string);
				redirect("pengiriman/manage/" . $id);
			}
		} else
			redirect("pengiriman");
	}

	public function delete($id = "")
	{
		$this->cekLoginStatus("admin",true);

		if (!empty($id)) {
			$cek = $this->pengiriman_model->get_by("pg.id_pengiriman", $id, true);
			if (empty($cek)) {
				$this->session->set_flashdata('admin_save_error', "ID tidak terdaftar");
				redirect("pengiriman");
			} else {
				$this->pengiriman_model->remove($id);
				$this->session->set_flashdata('admin_save_success', "data berhasil dihapus");
				redirect("pengiriman");
			}
		} else
			redirect("pengiriman");
	}

	public function generate_code()
	{
		$tanggal = date("Y-m");
		$temp = explode("-", $tanggal);
		$bulan = [
			"01" => "I",
			"02" => "II",
			"03" => "III",
			"04" => "IV",
			"05" => "V",
			"06" => "VI",
			"07" => "VII",
			"08" => "VIII",
			"09" => "IX",
			"10" => "X",
			"11" => "XI",
			"12" => "XII",
		];
		$prefix = "_SPL_00_I_" . $temp[0];
		$code = "01";

		$last = $this->pengiriman_model->get_last();
		if (!empty($last)) {
			$number = (double) substr($last->id_pengiriman, 1, 2) + 1;
			$code = str_pad($number, 2, "0", STR_PAD_LEFT);
		}
		return $code . $prefix;
	}

	public function cetak($id)
	{
		$this->cekLoginStatus("admin",true);

		$data['title'] = "CETAK PENGIRIMAN";
		$data['layout'] = "pengiriman/cetak";

		$this->load->library("qrcodeci");
		if ($id) {
			$dt = $this->pengiriman_model->get_by("pg.id_pengiriman", $id, true);
			$total = $this->pengiriman_model->get_total($id);
			$barang = $this->pengiriman_model->get_pengiriman_item($id);
			if ($dt) {
				$this->qrcodeci->generate($dt->id_pengiriman);
				$data['data'] = $dt;
				$data['total'] = $total;
				$data['barang'] = $barang;

				$update['status'] = 2;
				$this->pengiriman_model->save($id, $update, false);
				$this->load->view('blank', $data);
			} else {
				redirect("pengiriman");
			}
		} else {
			redirect("pengiriman");
		}
	}

	public function spk($id)
	{
		$this->cekLoginStatus("admin",true);

		$data['title'] = "CETAK SPK";
		$data['layout'] = "pengiriman/spk";

		if ($id) {
			$data['data'] = $this->pengiriman_model->get_by("pg.id_pengiriman", $id, true);
			$data['date'] = $this->getDate(date("Y-m-d"));
			$this->load->view('blank', $data);
		} else {
			redirect("pengiriman/manage/" . $id);
		}
	}

	public function rekap()
	{
		$this->cekLoginStatus("admin",true);

		$data['title'] = "Laporan Pengiriman Tanki";
		$data['layout'] = "pengiriman/rekap";

		$action = $this->input->post('action');

		$from = $this->input->post('from');
		$to = $this->input->post('to');

		$status = $this->input->post('status');

		if (!$from)
			$from = date('Y-m-d', strtotime("-30 days"));
		;

		if (!$to)
			$to = date("Y-m-d");

		if (!$status)
			$status = "all";

		$filter = new StdClass();
		$filter->from = date('Y-m-d', strtotime($from));
		$filter->to = date('Y-m-d', strtotime($to));
		$filter->status = $status;

		list($data['data'], $total) = $this->pengiriman_model->getAll($filter, 0, 0, "pg.id_pengiriman", "desc");


		if ($action) {
			$this->export($action, $data['data'], $filter);
		} else
			$this->load->view('template', $data);
	}

	public function export($action, $data, $filter)
	{
		$this->cekLoginStatus("admin",true);

		$title = "Laporan Data Pengiriman Barang";
		$file_name = $title . "_" . date("Y-m-d");
		$headerTitle = $title;
		if (empty($data)) {
			$this->session->set_flashdata('admin_save_error', "data tidak tersedia");
			redirect("pengiriman/rekap?from=" . $filter->from . "&to=" . $filter->to . "&status=" . $filter->status . "");
		} else {
			if ($action == "excel") {
				// $this->load->library("excel");
				// $this->excel->setActiveSheetIndex(0);
				// $this->excel->stream($file_name . '.xls', $this->generate_format($data), $headerTitle);

				$spreadsheet = new Spreadsheet();
				$sheet = $spreadsheet->getActiveSheet();
				$sheet->setTitle(strtoupper($headerTitle));

				$sheet->setCellValue('A1', $headerTitle);
				$sheet->mergeCells('A1:G1');
				$sheet->getStyle('A1')->getAlignment()->setHorizontal('center');
				$sheet->getStyle('A1')->getFont()->setBold(true);

				// Download Excel
				$sheet->setCellValue('A3', 'Nomor');
				$sheet->setCellValue('B3', 'ID Pengiriman');
				$sheet->setCellValue('C3', 'Tanggal');
				$sheet->setCellValue('D3', 'Nama Pelanggan');
				$sheet->setCellValue('E3', 'Nama Kurir');
				$sheet->setCellValue('F3', 'Barang');
				$sheet->setCellValue('G3', 'Nominal');
				$sheet->setCellValue('H3', 'Status');

				$sheet->getStyle('A3:H3')->getFont()->setBold(true);


				$i = 4;

				foreach ($data as $d) {
					$items = $this->pengiriman_model->get_pengiriman_item($d['id_pengiriman']);
					$barang = "";
					$nominal = $this->pengiriman_model->get_total($d['id_pengiriman']);

					foreach ($items as $item) {
						$barang .= $item['nama_barang'] . " (" . $item['qty'] . " buah), \n";
					}
					$status = "Diproses";
					if ($d['status'] == 2)
						$status = "Dikirim";
					else if ($d['status'] == 3)
						$status = "Diterima";
					else if ($d['status'] == 5)
						$status = "Ditolak";

					$sheet->setCellValue('A' . $i, $i - 3);
					$sheet->setCellValue('B' . $i, $d['id_pengiriman']);
					$sheet->setCellValue('C' . $i, $d['tanggal']);
					$sheet->setCellValue('D' . $i, $d['pelanggan']);
					$sheet->setCellValue('E' . $i, $d['kurir']);
					$sheet->setCellValue('F' . $i, $barang);
					$sheet->setCellValue('G' . $i, 'Rp' . number_format($nominal->total_harga));
					$sheet->setCellValue('H' . $i, $status);
					$i++;

				}
				// Set Column E to wrap text
				$sheet->getStyle('E3:E' . --$i)->getAlignment()->setWrapText(true);

				// Set Auto Width
				foreach (range('A', 'G') as $columnID) {
					$sheet->getColumnDimension($columnID)
						->setAutoSize(true);
				}

				// Create Border on Data
				$styleArray = [
					'borders' => [
						'allBorders' => [
							'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
						],
					],
					// Set Vertical Alignment to center
					'alignment' => [
						'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
					],
				];
				$sheet->getStyle('A3:H' . $i)->applyFromArray($styleArray);

				$i += 2;
				$top = $i;


				// Place Signature on the bottom of file
				$sheet->setCellValue('B' . $i, 'Diketahui Oleh,');
				$sheet->setCellValue('F' . $i++, 'Diperiksa Oleh,');

				$sheet->setCellValue('B' . $i, 'Kabag Humas & Langganan');
				$sheet->setCellValue('F' . $i++, 'Kasubag Hubungan Langganan');

				$sheet->setCellValue('B' . $i, '');
				$sheet->setCellValue('F' . $i++, '');

				$sheet->setCellValue('B' . $i, '');
				$sheet->setCellValue('F' . $i++, '');

				$sheet->setCellValue('B' . $i, '');
				$sheet->setCellValue('F' . $i++, '');

				$sheet->getStyle('A' . $i . ':H' . $i)->getFont()->setBold(true);
				$sheet->setCellValue('B' . $i, 'Nama Lengkap');
				$sheet->setCellValue('F' . $i++, 'Nama Lengkap');

				$sheet->setCellValue('B' . $i, 'NIK.');
				$sheet->setCellValue('F' . $i++, 'NIK.');

				$bottom = $i - 1;

				$sheet->getStyle('B' . $top . ':F' . $bottom)->getAlignment()->setHorizontal('center');

				// $sheet->fromArray($this->generate_format($data), NULL, 'A4');
				$writer = new Xlsx($spreadsheet);
				header('Content-Type: application/vnd.ms-excel');
				header('Content-Disposition: attachment;filename="' . $file_name . '.xlsx"');
				header('Cache-Control: max-age=0');
				$writer->save('php://output');

				// return redirect('pengiriman/rekap');
			}

		}

	}

	public function generate_format($data)
	{
		$newdata = array();
		$grantotal = 0;
		foreach ($data as $key => $dt) {

			$dat = array();
			$dat['ID Pengiriman'] = $dt['id_pengiriman'];
			$dat['Tanggal'] = date("d-m-Y", strtotime($dt['tanggal']));
			$dat['Pelanggan'] = $dt['pelanggan'];
			$dat['Kurir'] = $dt['kurir'];
			$dat['No. Kendaraan'] = $dt['no_kendaraan'];
			$dat['Penerima'] = $dt['penerima'];

			$status = "Diproses";
			if ($dt['status'] == 2)
				$status = "Dikirim";
			else if ($dt['status'] == 3)
				$status = "Diterima";
			else if ($dt['status'] == 5)
				$status = "Ditolak";

			$dat['Status'] = $status;

			$newdata[] = $dat;
		}

		return $newdata;
	}

	public function getDate($date)
	{
		$bulan = array(
			1 => 'Januari',
			'Februari',
			'Maret',
			'April',
			'Mei',
			'Juni',
			'Juli',
			'Agustus',
			'September',
			'Oktober',
			'November',
			'Desember'
		);

		$temp = explode('-', $date);

		return $temp[2] . ' ' . $bulan[(int) $temp[1]] . ' ' . $temp[0];
	}
}