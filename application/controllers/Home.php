<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_home');
	}
	
	public function index()
	{
		$data['data'] = $this->M_home->getData(); // $data['data'] is the variable that will be used in the view [application\views\home.php
		$this->load->view('home', $data);
	}

	public function getProjectById($id) {
		$data = $this->M_home->getProjectById($id);
		echo json_encode($data);
	}

	public function addProject() {
		$data = [
			'nama_project' => $this->input->post('nama_project'),
			'deskripsi' => $this->input->post('deskripsi'),
			'pic' => $this->input->post('pic'),
			'start_date' => $this->input->post('start_date'),
			'due_date' => $this->input->post('due_date'),
			'priority' => $this->input->post('priority'),
			'status' => $this->input->post('status'),
			'task_complexity' => $this->input->post('task_complexity')
		];

		$inserData = $this->M_home->addProject($data);

		if ($inserData > 0) {
			$this->session->set_flashdata('success', 'Data berhasil ditambahkan');
			$this->index();
		} else {
			$this->session->set_flashdata('error', 'Data gagal ditambahkan');
			$this->index();
		}
	}

	public function editProject() {
		$data = [
			'nama_project' => $this->input->post('nama_project_edit'),
			'deskripsi' => $this->input->post('deskripsi_edit'),
			'pic' => $this->input->post('pic_edit'),
			'start_date' => $this->input->post('start_date_edit'),
			'due_date' => $this->input->post('due_date_edit'),
			'priority' => $this->input->post('priority_edit'),
			'status' => $this->input->post('status_edit'),
			'task_complexity' => $this->input->post('task_complexity_edit')
		];

		$id = $this->input->post('id_project_edit');
		
		$updateData = $this->M_home->updateProject($data, $id);

		if ($updateData > 0) {
			$this->session->set_flashdata('success', 'Data berhasil diubah');
			redirect('home');
		} else {
			$this->session->set_flashdata('error', 'Data gagal diubah');
			redirect('home');
		}
	}

	public function deleteProject($id) {
		$deleteData = $this->M_home->deleteProject($id);

		if ($deleteData > 0) {
			$this->session->set_flashdata('success', 'Data berhasil dihapus');
			redirect('home');
		} else {
			$this->session->set_flashdata('error', 'Data gagal dihapus');
			redirect('home');
		}
	}
}
