<?php
class Account extends CI_Model
{
    function insert_new_user($file_name)
    {
        $roles = $this->input->post('roles');
        $data = array(
            'nama'      => $this->input->post('nama'),
            'username'  => $this->input->post('username'),
            'pwd'       => MD5($this->input->post('password')),
            'email'     => $this->input->post('email'),
            'photo'     => $file_name
        );

        $this->db->insert('users', $data);
        $id_user = $this->db->insert_id();
        foreach ($roles as $item)
        {
            $peran = $item;
            if ($peran == '1')
            {
                $data_editor = array(
                    'id_user'       =>  $id_user,
                    'nama_editor'   =>  $this->input->post('nama'),
                    'email_editor'  =>  $this->input->post('email'),
                    'date_updated'  =>  date('Y-m-d H:i:s')
                );
                $this->db->insert('editor', $data_editor);

                $data_member = array(
                    'id_user'       => $id_user,
                    'id_grup'       => $peran,
                    'date_updated'  => date('Y-m-d H:i:s') 
                );
                $this->db->insert('member', $data_member);
            }
            else if ($peran = '2')
            {
                $data_reviewer = array(
                    'id_user'           => $id_user,
                    'nama_reviewer'     => $this->input->post('nama'),
                    'email_reviewer'    => $this->input->post('email'),
                    'date_updated'      => date('Y-m-d H:i:s')
                );
                $this->db->insert('reviewer', $data_reviewer);

                $data_member2 = array(
                    'id_user'       => $id_user,
                    'id_grup'       => $peran,
                    'date_updated'  => date('Y-m-d H:i:s') 
                );
                $this->db->insert('member', $data_member2);
            }
        }
    }
    function get_users($username, $password, $roles)
    {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->join('member', 'users.id_user = member.id_user');
        $this->db->where('users.username', $username);
        $this->db->where('users.pwd', MD5($password));
        $this->db->where('member.id_grup', $roles);
        $this->db->where('users.sts_user', 1);
        $users = $this->db->get()->result_array();
        if(count($users)>0)
        {
            return $users;
        } 
        else
        {
            return[];
        }  
    }
}
?>