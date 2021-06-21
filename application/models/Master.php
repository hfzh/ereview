<?php
class Master extends CI_Model
{
    function get_list_reviewer($id_user)
    {
        $this->db->select('*');
        $this->db->where('sts_reviewer', 1);
        $this->db->where('id_user !=', $id_user);
        return $this->db->get('reviewer')->result_array();
    }


    function get_list_reviewers($limit = "0", $offset="0", $sort="", $id_user)
    {
        $this->db->select('*');
        $this->db->where('sts_reviewer', 1);
        $this->db->where('id_user !=', $id_user);
        $this->db->order_by($sort, 'ASC'); 
        return $this->db->get('reviewer', $limit, $offset)->result_array();
    }

    function count_list_reviewers($id_user)
    {
        $this->db->select('count(id_reviewer) as total_rows');
        $this->db->where('sts_reviewer', 1);
        $this->db->where('id_user !=', $id_user);
        return $this->db->get('reviewer')->row()->total_rows;
    }

    function add_task($id_user, $artikel)
    {
        $this->db->select('id_editor');
        $this->db->from('editor');
        $this->db->where('editor.id_user', $id_user);
        $this->db->where('editor.sts_editor', 1);
        $result = $this->db->get()->result_array();
        $id_editor = $result[0]['id_editor'];

        $data = array(
            'judul'         => $this->input->post('judul'),
            'penulis'       => $this->input->post('penulis'),
            'kata_kunci'    => $this->input->post('katakunci'),
            'bidang_ilmu'   => $this->input->post('bidangilmu'),
            'jumlah_kata'   => $this->input->post('jumlahkata'),
            'artikel'       => $artikel,
            'deadline'      => $this->input->post('deadline'),
            'id_reviewer'   => $this->input->post('reviewer'),
            'id_editor'     => $id_editor,
            'date_updated'  => date('Y-m-d H:i:s')
        );
        $this->db->insert('artikel', $data);
        $insert_id = $this->db->insert_id();

        $data2 = array(
            'id_artikel'        => $insert_id,
            'harga'             => strval($this->input->post('jumlahkata')) * 250,
            'date_updated'      => date('Y-m-d H:i:s')
        );
        $this->db->insert('pembayaran', $data2);

        $data3 = array(
            'id_artikel'        => $insert_id,
            'date_updated'      => date('Y-m-d H:i:s')
        );
        $this->db->insert('progress', $data3);
    }

    function payment($id_user)
    {
        $this->db->select('id_editor');
        $this->db->from('editor');
        $this->db->where('editor.id_user', $id_user);
        $this->db->where('editor.sts_editor', 1);
        $result = $this->db->get()->result_array();

        $this->db->select('*');
        $this->db->from('artikel');
        $this->db->join('pembayaran', 'artikel.id_artikel = pembayaran.id_artikel');
        $this->db->join('progress', 'artikel.id_artikel = progress.id_artikel');
        $this->db->where('id_editor', $result[0]['id_editor']);
        $this->db->where('pembayaran.sts_pembayaran', 0);
        $this->db->where('progress.sts_progress', 2);
        return $this->db->get()->result_array();
    }
    
    function get_artikel($id_artikel)
    {
        $this->db->select('*');
        $this->db->from('artikel');
        $this->db->where('id_artikel', $id_artikel);
        $this->db->where('sts_artikel', 1);
        $result = $this->db->get();
        return $result->result_array();
    }

    function payed($sts_pembayaran, $id_artikel, $bukti_pembayaran)
    {
        $this->db->set('bukti_pembayaran', $bukti_pembayaran);
        $this->db->set('sts_pembayaran', $sts_pembayaran);
        $this->db->set('date_updated', date('Y-m-d H:i:s'));
        $this->db->where('id_artikel', $id_artikel);
        $this->db->update('pembayaran');
    }

    function get_task($limit=0, $offset=0, $sts_artikel=-1, $sort="", $id_user)
    {           
        $this->db->select('id_editor');
        $this->db->from('editor');
        $this->db->join('member', 'member.id_user = editor.id_user');
        $this->db->where('editor.id_user', $id_user);
        $this->db->where('member.id_grup', 1);
        $this->db->where('editor.sts_editor', 1);
        $result = $this->db->get()->result_array();

        if($sts_artikel == -1)
        {
            $this->db->select('*');
            $this->db->join('pembayaran', 'artikel.id_artikel = pembayaran.id_artikel');
            $this->db->join('progress', 'artikel.id_artikel = progress.id_artikel');
            $this->db->join('reviewer', 'artikel.id_reviewer=reviewer.id_reviewer');
            $this->db->where('artikel.id_editor', $result[0]['id_editor']);
            $this->db->order_by($sort, 'ASC');
            return $this->db->get('artikel', $limit, $offset)->result_array();
        }
        else 
        {
            $this->db->select('*');
            $this->db->join('pembayaran', 'artikel.id_artikel = pembayaran.id_artikel');
            $this->db->join('progress', 'artikel.id_artikel = progress.id_artikel');
            $this->db->join('reviewer', 'artikel.id_reviewer=reviewer.id_reviewer');
            $this->db->where('artikel.id_editor', $result[0]['id_editor']);
            $this->db->where('artikel.sts_artikel', $sts_artikel);
            $this->db->order_by($sort, 'ASC');
            return $this->db->get('artikel', $limit, $offset)->result_array();
        }
    }

    function count_task($id_user, $sts_artikel=-1)
    {
        $this->db->select('id_editor');
        $this->db->from('editor');
        $this->db->join('member', 'member.id_user = editor.id_user');
        $this->db->where('editor.id_user', $id_user);
        $this->db->where('member.id_grup', 1);
        $this->db->where('editor.sts_editor', 1);
        $result = $this->db->get()->result_array();

        if($sts_artikel == -1)
        {
            $this->db->select('count(artikel.id_artikel) as total_rows');
            $this->db->join('pembayaran', 'artikel.id_artikel = pembayaran.id_artikel');
            $this->db->join('progress', 'artikel.id_artikel = progress.id_artikel');
            $this->db->join('reviewer', 'artikel.id_reviewer=reviewer.id_reviewer');
            $this->db->where('artikel.id_editor', $result[0]['id_editor']);
            return $this->db->get('artikel')->row()->total_rows;
        }
        else
        {
            $this->db->select('count(artikel.id_artikel) as total_rows');
            $this->db->join('pembayaran', 'artikel.id_artikel = pembayaran.id_artikel');
            $this->db->join('progress', 'artikel.id_artikel = progress.id_artikel');
            $this->db->join('reviewer', 'artikel.id_reviewer=reviewer.id_reviewer');
            $this->db->where('artikel.id_editor', $result[0]['id_editor']);
            $this->db->where('artikel.sts_artikel', $sts_artikel);
            return $this->db->get('artikel')->row()->total_rows;
        }

    }

    function get_reviewer_task($id_user)
    {
        $this->db->select('id_reviewer');
        $this->db->from('reviewer');
        $this->db->join('member', 'reviewer.id_user = member.id_user');
        $this->db->where('reviewer.id_user', $id_user);
        $this->db->where('member.id_grup', 2);
        $this->db->where('reviewer.sts_reviewer', 1);
        $result = $this->db->get()->result_array();

        $this->db->select('*');
        $this->db->from('artikel');
        $this->db->join('progress', 'artikel.id_artikel = progress.id_artikel');
        $this->db->join('pembayaran', 'artikel.id_artikel = pembayaran.id_artikel');
        $this->db->join('editor', 'artikel.id_editor = editor.id_editor');
        $this->db->where('artikel.id_reviewer', $result[0]['id_reviewer']);
        $this->db->where('artikel.sts_artikel', 1);
        $this->db->where('pembayaran.sts_pembayaran !=', 3);
        return $this->db->get()->result_array();
    }

    function add_progress_status($id_artikel, $sts_progress)
    {
        $this->db->set('sts_progress', $sts_progress);
        $this->db->set('date_updated', date('Y-m-d H:i:s'));
        $this->db->where('id_artikel', $id_artikel);
        $this->db->update('progress');
    }

    function get_reviewer_balance($id_user)
    {
        $this->db->select('*');
        $this->db->from('reviewer');
        $this->db->where('id_user', $id_user);
        $this->db->where('sts_reviewer', 1);
        return $this->db->get()->result_array();
    }

    function get_funds($id_user, $balance, $withdraw)
    {
        $balance_new = $balance - $withdraw;
        $this->db->set('balance', $balance_new);
        $this->db->set('date_updated', date('Y-m-d H:i:s'));
        $this->db->where('id_user', $id_user);
        $this->db->update('reviewer');
    }

    function get_artikel_reviewer($id_user)
    {
        $this->db->select('*');
        $this->db->from('artikel');
        $this->db->join('reviewer', 'artikel.id_reviewer = reviewer.id_reviewer');
        $this->db->join('pembayaran', 'artikel.id_artikel = pembayaran.id_artikel');
        $this->db->join('progress', 'artikel.id_artikel = progress.id_artikel');
        $this->db->where('reviewer.id_user', $id_user);
        $this->db->where('pembayaran.sts_pembayaran', 3);
        $this->db->where('progress.sts_progress', 2);
        $this->db->where('artikel.sts_artikel', 1);
        return $this->db->get()->result_array();
    }

    function add_review($artikel)
    {
        $id_artikel = $this->input->post('id');
        $sts_progress = $this->input->post('progress');
        
        $this->db->set('artikel', $artikel);
        $this->db->set('date_updated', date('Y-m-d H:i:s'));
        $this->db->where('id_artikel', $id_artikel);
        $this->db->update('artikel');
        
        $this->db->set('sts_progress', $sts_progress);
        $this->db->set('date_updated', date('Y-m-d H:i:s'));
        $this->db->where('id_artikel', $id_artikel); 
        $this->db->update('progress');
    }

    function get_all_tasks($limit="0", $offset="0", $sts_artikel="-1", $sort="")
    {
        if($sts_artikel == -1)
        {
            $this->db->select('*');
            $this->db->join('pembayaran', 'artikel.id_artikel = pembayaran.id_artikel');
            $this->db->join('progress', 'artikel.id_artikel = progress.id_artikel');
            $this->db->join('reviewer', 'artikel.id_reviewer = reviewer.id_reviewer');
            $this->db->join('editor', 'artikel.id_editor=editor.id_editor');
            $this->db->order_by($sort, 'ASC');
            return $this->db->get('artikel', $limit, $offset)->result_array();
        }
        else
        {
            $this->db->select('*');
            $this->db->join('pembayaran', 'artikel.id_artikel = pembayaran.id_artikel');
            $this->db->join('progress', 'artikel.id_artikel = progress.id_artikel');
            $this->db->join('reviewer', 'artikel.id_reviewer = reviewer.id_reviewer');
            $this->db->join('editor', 'artikel.id_editor=editor.id_editor');
            $this->db->where('artikel.sts_artikel', $sts_artikel);
            $this->db->order_by($sort, 'ASC');
            return $this->db->get('artikel', $limit, $offset)->result_array();
        }
    }
    
    function count_all_tasks($sts_artikel="-1")
    {
        if($sts_artikel == -1)
        {
            $this->db->select('count(artikel.id_artikel) as total_rows');
            $this->db->join('pembayaran', 'artikel.id_artikel = pembayaran.id_artikel');
            $this->db->join('progress', 'artikel.id_artikel = progress.id_artikel');
            $this->db->join('reviewer', 'artikel.id_reviewer = reviewer.id_reviewer');
            $this->db->join('editor', 'artikel.id_editor=editor.id_editor');
            return $this->db->get('artikel')->row()->total_rows;
        }
        else
        {
            $this->db->select('count(artikel.id_artikel) as total_rows');
            $this->db->join('pembayaran', 'artikel.id_artikel = pembayaran.id_artikel');
            $this->db->join('progress', 'artikel.id_artikel = progress.id_artikel');
            $this->db->join('reviewer', 'artikel.id_reviewer = reviewer.id_reviewer');
            $this->db->join('editor', 'artikel.id_editor=editor.id_editor');
            $this->db->where('artikel.sts_artikel', $sts_artikel);
            return $this->db->get('artikel')->row()->total_rows;
        }
    }

    function get_all_payments($limit="0", $offset="0", $sort="")
    {
        $this->db->select('*');
        $this->db->join('pembayaran', 'artikel.id_artikel = pembayaran.id_artikel');
        $this->db->join('progress', 'artikel.id_artikel = progress.id_artikel');
        $this->db->join('reviewer', 'artikel.id_reviewer = reviewer.id_reviewer');
        $this->db->join('editor', 'artikel.id_editor=editor.id_editor');
        $this->db->where('pembayaran.sts_pembayaran =', 1);
        $this->db->where('artikel.sts_artikel', 1);
        $this->db->order_by($sort, 'ASC');
        return $this->db->get('artikel', $limit, $offset)->result_array();
    }

    function count_all_payments()
    {
        $this->db->select('count(artikel.id_artikel) as total_rows');
        $this->db->join('pembayaran', 'artikel.id_artikel = pembayaran.id_artikel');
        $this->db->join('progress', 'artikel.id_artikel = progress.id_artikel');
        $this->db->join('reviewer', 'artikel.id_reviewer = reviewer.id_reviewer');
        $this->db->join('editor', 'artikel.id_editor=editor.id_editor');
        $this->db->where('pembayaran.sts_pembayaran =', 1);
        $this->db->where('artikel.sts_artikel', 1);
        return $this->db->get('artikel')->row()->total_rows;
    }
    
    function get_bukti_transfer($id_artikel)
    {
        $this->db->select('bukti_pembayaran');
        $this->db->from('pembayaran');
        $this->db->where('id_artikel', $id_artikel);
        $this->db->where('sts_pembayaran', 1);
        return $this->db->get()->result_array();
    }

    function add_sts_payment($id_artikel, $sts_pembayaran)
    {
        $data = array(
            'sts_pembayaran' => $sts_pembayaran
        );
        $this->db->where('id_artikel', $id_artikel);
        $this->db->update('pembayaran', $data);
    }

    function get_file_artikel($id_artikel)
    {
        $this->db->select('artikel');
        $this->db->from('artikel');
        $this->db->where('id_artikel', $id_artikel);
        return $this->db->get()->result_array();
    }

    function get_task_confirm($limit=0, $offset=0, $sort="", $id_user)
    {
        $this->db->select('id_editor');
        $this->db->from('editor');
        $this->db->where('editor.id_user', $id_user);
        $result = $this->db->get()->result_array();

        $this->db->select('*');
        $this->db->join('pembayaran', 'artikel.id_artikel = pembayaran.id_artikel');
        $this->db->join('progress', 'artikel.id_artikel = progress.id_artikel');
        $this->db->join('reviewer', 'artikel.id_reviewer = reviewer.id_reviewer');
        $this->db->where('pembayaran.sts_pembayaran', 3);
        $this->db->where('progress.sts_progress', 3);
        $this->db->where('artikel.id_editor', $result[0]['id_editor']);
        $this->db->where('artikel.sts_artikel', 1);
        $this->db->order_by($sort,'ASC');
        return $this->db->get('artikel', $limit, $offset)->result_array();
    }

    function count_task_confirm($id_user)
    {
        $this->db->select('id_editor');
        $this->db->from('editor');
        $this->db->where('editor.id_user', $id_user);
        $result = $this->db->get()->result_array();

        $this->db->select('count(artikel.id_artikel) as total_rows');
        $this->db->join('pembayaran', 'artikel.id_artikel = pembayaran.id_artikel');
        $this->db->join('progress', 'artikel.id_artikel = progress.id_artikel');
        $this->db->join('reviewer', 'artikel.id_reviewer = reviewer.id_reviewer');
        $this->db->where('pembayaran.sts_pembayaran', 3);
        $this->db->where('progress.sts_progress', 3);
        $this->db->where('artikel.id_editor', $result[0]['id_editor']);
        $this->db->where('artikel.sts_artikel', 1);
        return $this->db->get('artikel')->row()->total_rows;
    }

    function add_progress_confirmation($id_artikel, $sts_progress, $harga, $balance, $id_reviewer)
    {
        $this->db->set('sts_progress', $sts_progress);
        $this->db->set('date_updated', date('Y-m-d H:i:s'));
        $this->db->where('id_artikel', $id_artikel);
        $this->db->update('progress');

        $new_balance = $harga + $balance;
        $this->db->set('balance', $new_balance);
        $this->db->set('date_updated', date('Y-m-d H:i:s'));
        $this->db->where('id_reviewer', $id_reviewer);
        $this->db->update('reviewer');
    }

    function mark_task_done($id_artikel)
    {
        $this->db->set('sts_artikel', 0);
        $this->db->set('date_updated', date('Y-m-d H:i:s'));
        $this->db->where('id_artikel', $id_artikel);
        $this->db->update('artikel');
    }

    function get_tasks_done($limit="0", $offset="0", $sort="")
    {
        $this->db->select('*');
        $this->db->join('pembayaran', 'artikel.id_artikel = pembayaran.id_artikel');
        $this->db->join('progress', 'artikel.id_artikel = progress.id_artikel');
        $this->db->join('reviewer', 'artikel.id_reviewer = reviewer.id_reviewer');
        $this->db->join('editor', 'artikel.id_editor=editor.id_editor');
        $this->db->where('artikel.sts_artikel', 1);
        $this->db->order_by($sort, 'ASC');
        return $this->db->get('artikel', $limit, $offset)->result_array();
    }

    function count_tasks_done()
    {
        $this->db->select('count(artikel.id_artikel) as total_rows');
        $this->db->join('pembayaran', 'artikel.id_artikel = pembayaran.id_artikel');
        $this->db->join('progress', 'artikel.id_artikel = progress.id_artikel');
        $this->db->join('reviewer', 'artikel.id_reviewer = reviewer.id_reviewer');
        $this->db->join('editor', 'artikel.id_editor=editor.id_editor');
        $this->db->where('artikel.sts_artikel', 1);
        return $this->db->get('artikel')->row()->total_rows;
    }

    function dump_task($id_artikel)
    {
        $this->db->set('sts_artikel', 0);
        $this->db->set('date_updated', date('Y-m-d H:i:s'));
        $this->db->where('id_artikel', $id_artikel);
        $this->db->update('artikel');
    }

    function get_editors($limit='0', $offset="0", $sort="")
    {
        $this->db->select('*');
        $this->db->where('sts_editor', 1);
        $this->db->order_by($sort, 'ASC');
        return $this->db->get('editor', $limit, $offset)->result_array();
    }

    function count_editors()
    {
        $this->db->select('count(id_editor) as total_rows');
        $this->db->where('sts_editor', 1);
        return $this->db->get('editor')->row()->total_rows;
    }

    function dump_editor($id_user)
    {
        $this->db->set('sts_editor', 0);
        $this->db->set('date_updated', date('Y-m-d H:i:s'));
        $this->db->where('id_user', $id_user);
        $this->db->update('editor');

        $this->db->set('sts_user', 0);
        $this->db->set('date_updated', date('Y-m-d H:i:s'));
        $this->db->where('id_user', $id_user);
        $this->db->update('users');
    }

    function get_reviewers($limit="0", $offset="0", $sort="")
    {
        $this->db->select('*');
        $this->db->where('sts_reviewer', 1);
        $this->db->order_by($sort, 'ASC');
        return $this->db->get('reviewer', $limit, $offset)->result_array();
    }

    function count_reviewers()
    {
        $this->db->select('count(id_reviewer) as total_rows');
        $this->db->where('sts_reviewer', 1);
        return $this->db->get('reviewer')->row()->total_rows;
    }

    function dump_reviewer($id_user)
    {
        $this->db->set('sts_reviewer', 0);
        $this->db->set('date_updated', date('Y-m-d H:i:s'));
        $this->db->where('id_user', $id_user);
        $this->db->update('reviewer');

        $this->db->set('sts_user', 0);
        $this->db->set('date_updated', date('Y-m-d H:i:s'));
        $this->db->where('id_user', $id_user);
        $this->db->update('users');
    }

    function get_profile_reviewer($id_user)
    {
        $this->db->select('*');
        $this->db->where('users.id_user', $id_user);
        $this->db->join('reviewer', 'reviewer.id_user=users.id_user');
        return $this->db->get('users')->result_array();
    }

    function get_profile_editor($id_user)
    {
        $this->db->select('*');
        $this->db->where('users.id_user', $id_user);
        $this->db->join('editor', 'editor.id_user=users.id_user');
        return $this->db->get('users')->result_array();
    }

    function get_profile_makelar($id_user)
    {
        $this->db->select('*');
        $this->db->where('users.id_user', $id_user);
        return $this->db->get('users')->result_array();
    }

    function edit_additional($id_user)
    {
        $this->db->set('bidang_ahli', $this->input->post('bidang_ahli'));
        $this->db->set('no_rek', $this->input->post('no_rek'));
        $this->db->set('nama_bank', $this->input->post('nama_bank'));
        $this->db->set('date_updated', date('Y-m-d H:i:s'));
        $this->db->where('id_user', $id_user['id_user']);
        $this->db->update('reviewer');
    }
}
?>