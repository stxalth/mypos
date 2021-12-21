<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_m extends CI_Model
{

    public function login($post)
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('username', $post['username']);
        $this->db->where('password', sha1($post['password']));
        // tambahin "sha1" sesuai di databasenya.
        // kalau tidak ditambahkan sha1, maka data yang akan dikirim pada bagian password berupa plain text
        // sedangkan, yang ada di database adalah berupa password hash.
        // nanti akan menyebabkan password yg dikirim tidak sesuai dengan password yg ada di database
        // sehingga, ketika dilakukan query atau pengecekan, login akan gagal.
        $query = $this->db->get();
        return $query;
    }

    // function untuk mengambil data dari tabel yang ditunjuk
    public function get($id = null)
    {
        $this->db->from('user');
        if ($id != null) {
            $this->db->where('user_id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function add($post)
    {
        // $params['sesuaiyangdifieldtabel'] = $post['sesuainameyangdiform'];
        $params['name'] = $post['fullname'];
        $params['username'] = $post['username'];
        $params['password'] = sha1($post['password']);
        $params['address'] = $post['address'] != "" ? $post['address'] : null;
        $params['level'] = $post['level'];
        $this->db->insert('user', $params); // input data ke tabel 'user'
    }

    public function edit($post)
    {
        $params['name'] = $post['fullname'];
        $params['username'] = $post['username'];

        // Jika bagian 'password' tidak kosong, maka post data ke database.
        if (!empty($post['password'])) {
            $params['password'] = sha1($post['password']);
        }
        $params['address'] = $post['address'] != "" ? $post['address'] : null;
        $params['level'] = $post['level'];
        $this->db->where('user_id', $post['user_id']); // tunjuk ke user_id
        $this->db->update('user', $params); // update data ke tabel 'user'
    }

    public function del($id)
    {
        $this->db->where('user_id', $id);
        $this->db->delete('user');
    }
}
