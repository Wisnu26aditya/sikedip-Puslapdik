<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }
    public function index()
    {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Login Sikedip';
            $this->load->view('templates/header', $data);
            $this->load->view('auth/login');
            $this->load->view('templates/footer');
        } else {
            // validasi success
            $data['title'] = 'Login Page';
            $this->_login();
        }
    }

    private function _login()
    {
        $data['title'] = 'Login Page';
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $user = $this->db->get_where('login', ['email' => $email])->row_array();
        if ($user) {
            // usernya ada
            if ($user['is_active'] == 1) {
                // cek password
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'email' => $user['email'],
                        'role_id' => $user['role_id'],
                        'id' => $user['id'],
                        'name' => $user['name'],
                        'image' => $user['image']
                    ];
                    $this->session->set_userdata($data);
                    if ($user['role_id'] == 1) {
                        redirect('admin');
                    }
                    redirect('duser');
                } else {
                    $this->session->set_flashdata('messege', '<div class="alert alert-danger" role="alert">Wrong password!</div>');
                    redirect('auth');
                }
            } else {
                // usernya belum aktif
                $this->session->set_flashdata('messege', '<div class="alert alert-danger" role="alert">Email is not Activated!</div>');
                redirect('auth');
            }
        } else {
            // usernya tidak ada
            $this->session->set_flashdata('messege', '<div class="alert alert-danger" role="alert">Email is not Registered!</div>');
            redirect('auth');
        }
    }

    function password_generate($chars)
    {
        $gen = '12346789ABCDEFGHJKLMNPQRTUVWXYZabcefghjkmnpqrtuvwxyz';
        return substr(str_shuffle($gen), 0, $chars);
    }

    public function register()
    {
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[login.email]', [
            'is_unique' => 'This Email has been Registered!'
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
            'matches' => 'Password dont Match!',
            'min_length' => 'Password too Short!'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|min_length[3]|matches[password1]');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'User Register';
            $this->load->view('templates/header', $data);
            $this->load->view('auth/register');
            $this->load->view('templates/footer');
        } else {
            $email = $this->input->post('email', true);
            $data = [
                'name' => htmlspecialchars($this->input->post('name', true)),
                'email' => htmlspecialchars($email),
                'image' => 'default.jpg',
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'role_id' => 2,
                'is_active' => 0,
                'date_created' => time()
            ];

            // siapkan token
            $token = password_generate(32);

            $user_token = [
                'email' => $email,
                'token' => $token,
                'date_created' => time()
            ];

            $updown = [
                'role_id' => 2,
                'is_upload' => 0,
                'is_download' => 0,
                'min_hari' => 7,
                'max_hari' => 7,
                'show_item' => 1,
                'is_active' => 1,
                'created_date' => date('d-m-Y H:i:s')
            ];

            // 30 april 2021

            $this->db->insert('login', $data);
            $this->db->insert('user_token', $user_token);
            $this->db->insert('master_updown', $updown);

            $this->_sendEmail($token, 'verify');

            $this->session->set_flashdata('messege', '<div class="alert alert-success" role="alert">Congratulation! Your Account has been Created. Please Check your email.</div>');
            redirect('auth');
        }
    }

    private function _sendEmail($token, $type)
    {
        $config = [
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_user' => 'puslapdik20.5@gmail.com',
            'smtp_pass' => 'Pusl4pd1k!',
            'smtp_port' => 465,
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'newline' => "\r\n",
        ];

        // $this->load->library('email', $config);
        // 24 Mei 2021 --> change diatas <--
        $this->load->library('email');
        $this->email->initialize($config);

        $this->email->from('puslapdik20.5@gmail.com', 'IT Puslapdik');
        $this->email->to($this->input->post('email'));

        if ($type == 'verify') {
            $this->email->subject('Account Verification');
            $this->email->message('click this link to activate your account : ' . base_url() . 'auth/verify?email=' . $this->input->post('email') . '&token=' . $token);
        } else if ($type == 'forgotpass') {
            $this->email->subject('Reset Password');
            $this->email->message('click this link to reset your password : ' . base_url() . 'auth/resetpass?email=' . $this->input->post('email') . '&token=' . $token);
        }

        if ($this->email->send()) {
            return true;
        } else {
            echo $this->email->print_debugger();
            die;
        }
    }

    public function verify()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $user = $this->db->get_where('login', ['email' => $email])->row_array();

        if ($user) {
            $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();
            if ($user_token) {
                if (time() - $user_token['date_created'] < (60 * 60 * 24)) {
                    $this->db->set('is_active', 1);
                    $this->db->where('email', $email);
                    $this->db->update('login');

                    $this->db->delete('user_token', ['email' => $email]);

                    $this->session->set_flashdata('messege', '<div class="alert alert-success" role="alert">' . $email . ' has been activated! Please Login.</div>');
                    redirect('auth');
                } else {
                    $this->db->delete('login', ['email' => $email]);
                    $this->db->delete('user_token', ['email' => $email]);

                    $this->session->set_flashdata('messege', '<div class="alert alert-danger" role="alert">Account Activation failed! Token expired.</div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('messege', '<div class="alert alert-danger" role="alert">Account Activation failed! Wrong token.</div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('messege', '<div class="alert alert-danger" role="alert">Account Activation failed! Wrong email.</div>');
            redirect('auth');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');
        $this->session->set_flashdata('messege', '<div class="alert alert-success" role="alert">You have been logout!</div>');
        redirect('auth');
    }


    public function blocked()
    {
        $this->load->view('auth/blocked');
        $this->load->view('templates/footer');
    }

    public function forgotpass()
    {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Forgot Password';
            $this->load->view('templates/header', $data);
            $this->load->view('auth/forgot');
            $this->load->view('templates/footer');
        } else {
            $email = $this->input->post('email');
            $user = $this->db->get_where('login', ['email' => $email, 'is_active', 1])->row_array();
            if ($user) {
                // siapkan token
                function password_generate($chars)
                {
                    $gen = '12346789ABCDEFGHJKLMNPQRTUVWXYZabcefghjkmnpqrtuvwxyz';
                    return substr(str_shuffle($gen), 0, $chars);
                }
                $token = password_generate(32);
                $user_token = [
                    'email' => $email,
                    'token' => $token,
                    'date_created' => time()
                ];

                $this->db->insert('user_token', $user_token);
                $this->_sendEmail($token, 'forgotpass');
                $this->session->set_flashdata('messege', '<div class="alert alert-success" role="alert">Please Check Your email to reset your password.</div>');
                redirect('auth/forgotpass');
            } else {
                $this->session->set_flashdata('messege', '<div class="alert alert-danger" role="alert">Email is not registered or activated!</div>');
                redirect('auth/forgotpass');
            }
        }
    }

    public function resetpass()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $user = $this->db->get_where('login', ['email' => $email])->row_array();

        if ($user) {
            $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();
            if ($user_token) {
                $this->session->set_userdata('reset_email', $email);
                $this->changePass();
            } else {
                $this->session->set_flashdata('messege', '<div class="alert alert-danger" role="alert">Reset Password Failed!. Wrong Token.</div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('messege', '<div class="alert alert-danger" role="alert">Reset Password Failed!. Wrong Email.</div>');
            redirect('auth');
        }
    }
    public function changePass()
    {
        if (!$this->session->userdata('reset_email')) {
            redirect('auth');
        }

        $this->form_validation->set_rules('pass1', 'Password', 'trim|required|min_length[5]|matches[pass2]');
        $this->form_validation->set_rules('pass2', 'Repeat Password', 'trim|required|min_length[5]|matches[pass1]');
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Change Password';
            $this->load->view('templates/header', $data);
            $this->load->view('auth/change-pass');
            $this->load->view('templates/footer');
        } else {
            $password = password_hash($this->input->post('pass1'), PASSWORD_DEFAULT);
            $email = $this->session->userdata('reset_email');

            $this->db->set('password', $password);
            $this->db->where('email', $email);
            $this->db->update('login');

            $this->session->unset_userdata('reset_email');
            $this->session->set_flashdata('messege', '<div class="alert alert-success" role="alert">Password has been changed! Please Login.</div>');
            redirect('auth');
        }
    }
}
