<?php defined('BASEPATH') or exit('No direct script access allowed');

// Menampilkan halaman

class Item extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        check_not_login();
        // di bawah ini kodingan untuk load model yg dipake untuk halaman ini
        $this->load->model(['item_m', 'category_m', 'unit_m']);
    }

    public function index()
    {
        $data['row'] = $this->item_m->get();
        $this->template->load('template', 'product/item/item_data', $data);
    }

    public function add()
    {
        $item = new stdClass();
        $item->item_id = null;
        $item->barcode = null;
        $item->name = null;
        $item->price = null;
        $item->category_id = null;

        // di bawah ini buat ngambil data dari model dengan variabelnya adalah query_category
        $query_category = $this->category_m->get();

        // yang dibawah ini untuk looping dan bikin dropdown untuk bagian unit
        // di form unit pakenya form_dropdown, jadi bikin loopingnya di sini
        // tujuannya sih cuma buat mendekin kodingan di bagian item_form
        $query_unit = $this->unit_m->get();
        $unit[null] = '-- Pilih --';
        foreach ($query_unit->result() as $unt) {
            $unit[$unt->unit_id] = $unt->name;
        }

        $data = array(
            'page' => 'add',
            'row' => $item,
            'category' => $query_category,
            'unit' => $unit, 'selectedunit' => null,
        );

        $this->template->load('template', 'product/item/item_form', $data);
    }

    public function edit($id)
    {
        $query = $this->item_m->get($id);
        if ($query->num_rows() > 0) {
            $item = $query->row();
            $query_category = $this->category_m->get();

            $query_unit = $this->unit_m->get();
            $unit[null] = '-- Pilih --';
            foreach ($query_unit->result() as $unt) {
                $unit[$unt->unit_id] = $unt->name;
            }

            $data = array(
                'page' => 'edit',
                'row' => $item,
                'category' => $query_category,
                'unit' => $unit,
                'selectedunit' => $item->unit_id,
            );

            $this->template->load('template', 'product/item/item_form', $data);
        } else {
            echo "<script>alert('Data tidak ditemukan');";
            echo "window.location='" . site_url('item') . "'</script>";
        }
    }

    public function process()
    {
        $post = $this->input->post(null, TRUE);
        if (isset($_POST['add'])) {
            $this->item_m->add($post);
        } else if (isset($_POST['edit'])) {
            $this->item_m->edit($post);
        }
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data berhasil disimpan');
        }
        redirect('item');
    }

    public function del($id)
    {
        $this->item_m->del($id);

        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data berhasil dihapus');
        }
        redirect('item');
    }
}
