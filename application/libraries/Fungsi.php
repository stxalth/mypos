<?php

class Fungsi
{
    protected $ci;

    function __construct()
    {
        $this->ci = &get_instance();
    }

    //untuk menampilkan data user sesuai id
    function user_login()
    {
        $this->ci->load->model('user_m');
        $user_id = $this->ci->session->userdata('userid');
        $user_data = $this->ci->user_m->get($user_id)->row();
        return $user_data;
    }

    function PdfGenerator($html, $filename, $paper, $orientation)
    {
        $options = new Dompdf\Options();
        $options->setDefaultFont('courier');
        $options->setIsRemoteEnabled(true);

        $dompdf = new Dompdf\Dompdf();
        $dompdf->setOptions($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper($paper, $orientation);
        $dompdf->render();
        $dompdf->stream($filename, array('Attachment' => 0));
    }
}
