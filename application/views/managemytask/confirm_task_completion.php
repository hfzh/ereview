<html>
	<body>
        <section id="featured" class="bg">
            <div class="container">
                <div class="row">
                    <div class="text-center">
                        <h2> Confirm Task Completion</h2>
                    </div>
                        <?php if($this->session->flashdata('accept_completion')):?>
                            <div class="alert alert-success"><?php echo $this->session->flashdata('accept_completion');?></div>
                        <?php endif;?>
                        <hr class="colorgraph">
                        <div class="aligncenter">
                            <table <td align="center" border="">
                                <tr>
                                    <td><a href="<?php echo base_url() . 'index.php/managemytask/confirm_task_completion'. '/judul/'; ?>">Title</a></td>
                                    <td><a href="<?php echo base_url() . 'index.php/managemytask/confirm_task_completion'. '/penulis/'; ?>">Writer</a></td>
                                    <td><a href="<?php echo base_url() . 'index.php/managemytask/confirm_task_completion'. '/kata_kunci/'; ?>">Keyword</a></td>
                                    <td><a href="<?php echo base_url() . 'index.php/managemytask/confirm_task_completion'. '/bidang_ilmu/'; ?>">Field of Study</a></td>
                                    <td><a href="<?php echo base_url() . 'index.php/managemytask/confirm_task_completion'. '/jumlah_kata/'; ?>">Number of Words</a></td>
                                    <td><a href="<?php echo base_url() . 'index.php/managemytask/confirm_task_completion'. '/deadline/'; ?>">Deadline</a></td>
                                    <td><a href="<?php echo base_url() . 'index.php/managemytask/confirm_task_completion'. '/nama_reviewer/'; ?>">Reviewer Name</a></td>
                                    <td><a href="<?php echo base_url() . 'index.php/managemytask/confirm_task_completion'. '/sts_progress/'; ?>">Progress Status</a></td>
                                    <td><a href="<?php echo base_url() . 'index.php/managemytask/confirm_task_completion'. '/sts_pembayaran/'; ?>">Payment Status</a></td>
                                    <td>Confirmation</td>
                                </tr>
                                <?php foreach($task as $item): ?>
                                <tr>
                                    <td><?php echo $item['judul']?></td>
                                    <td><?php echo $item['penulis']?></td>
                                    <td><?php echo $item['kata_kunci']?></td>
                                    <td><?php echo $item['bidang_ilmu']?></td>
                                    <td><?php echo $item['jumlah_kata']?></td>
                                    <td><?php echo $item['deadline']?></td>
                                    <td><?php echo $item['nama_reviewer']?></td>
                                    <td>
                                        <?php 
                                            if($item['sts_progress']==0)
                                            {
                                                echo "Task have not been accepted/rejected";
                                            }
                                            else if ($item['sts_progress']==1)
                                            {
                                                echo "Rejected";
                                            }
                                            else if ($item['sts_progress']==2)
                                            {
                                                echo "Accepted";
                                            }
                                            else
                                            {
                                                echo "Done";
                                            }
                                        ?>
                                    </td>
                                    <td>
                                        <?php 
                                            if($item['sts_pembayaran']==0)
                                            {
                                                echo "Pay your task";
                                            }
                                            else if ($item['sts_pembayaran']==1)
                                            {
                                                echo "Waiting for Payment Checking";
                                            }
                                            else if ($item['sts_pembayaran']==2)
                                            {
                                                echo "Payment Rejected";
                                            }
                                            else if ($item['sts_pembayaran']==3)
                                            {
                                                echo "Done";
                                            }
                                        ?>
                                    </td>
                                    <td>
                                        <a class = "btn btn-primary"href="<?php echo base_url() . 'index.php/managemytask/confirming_task_completion/' . $item['id_artikel'] . '/5/' . $item['harga'] . '/' . $item['balance'] . '/' . $item['id_reviewer'] . '/';?>">Confirm</a>
                                    </td>
                                </tr>
                                <?php endforeach?>
                                <?php if(empty($task)):?>
                                    <td colspan="10"> No data found.</td>
                                <?php endif;?>
                                    <tr>
                                        <td colspan="10"><?php echo $page_link; ?></td>
                                    </tr>
                            </table>
                        </div>
                        <hr class="colorgraph">
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </body>
</html>