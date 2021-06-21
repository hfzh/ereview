<html>
    <body>
        <section id="featured" class="bg">
            <div class="container">
                <div class="row">
                    <div class="text-center">
                        <h2>Monitor Task</h2>
                    </div>
                        <?php if($this->session->flashdata('accept_completion')):?>
                            <div class="alert alert-success"><?php echo $this->session->flashdata('accept_completion');?></div>
                        <?php endif;?>
                        <hr class="colorgraph">
                        <label><a href="<?php echo base_url() . 'index.php/managealltask/monitor_tasks/1';?>">On Progress</a></label>
                        <label><a href="<?php echo base_url() . 'index.php/managealltask/monitor_tasks/0';?>">Completed</a></label>
                        <label><a href="<?php echo base_url() . 'index.php/managealltask/monitor_tasks/-1';?>">All</a></label>
                        <div class="aligncenter">
                        <table <td align="center" border="">
                            <tr>
                                <td><a href="<?php echo base_url() . 'index.php/managealltask/monitor_tasks/' . $sts_artikel  . '/judul/'; ?>">Title</a></td>
                                <td><a href="<?php echo base_url() . 'index.php/managealltask/monitor_tasks/' . $sts_artikel  . '/penulis/'; ?>">Writer</a></td>
                                <td><a href="<?php echo base_url() . 'index.php/managealltask/monitor_tasks/' . $sts_artikel  . '/kata_kunci/'; ?>">Keyword</a></td>
                                <td><a href="<?php echo base_url() . 'index.php/managealltask/monitor_tasks/' . $sts_artikel  . '/bidang_ilmu/'; ?>">Field of Study</a></td>
                                <td><a href="<?php echo base_url() . 'index.php/managealltask/monitor_tasks/' . $sts_artikel  . '/jumlah_kata/'; ?>">Number of Words</a></td>
                                <td><a href="<?php echo base_url() . 'index.php/managealltask/monitor_tasks/' . $sts_artikel  . '/deadline/'; ?>">Deadline</a></td>
                                <td><a href="<?php echo base_url() . 'index.php/managealltask/monitor_tasks/' . $sts_artikel  . '/harga/'; ?>">Price</a></td>
                                <td><a href="<?php echo base_url() . 'index.php/managealltask/monitor_tasks/' . $sts_artikel  . '/nama_editor/'; ?>">Editor Name</a></td>
                                <td><a href="<?php echo base_url() . 'index.php/managealltask/monitor_tasks/' . $sts_artikel  . '/nama_reviewer/'; ?>">Reviewer Name</a></td>
                                <td><a href="<?php echo base_url() . 'index.php/managealltask/monitor_tasks/' . $sts_artikel  . '/sts_progress/'; ?>">Progress Status</a></td>
                                <td><a href="<?php echo base_url() . 'index.php/managealltask/monitor_tasks/' . $sts_artikel  . '/sts_pembayaran/'; ?>">Payment Status</a></td>
                                <td>Download</td>
                                <td>Confirm Task</a></td>
                            </tr>
                            <?php foreach($task as $item): ?>
                                <tr>
                                    <td><?php echo $item['judul']?></td>
                                    <td><?php echo $item['penulis']?></td>
                                    <td><?php echo $item['kata_kunci']?></td>
                                    <td><?php echo $item['bidang_ilmu']?></td>
                                    <td><?php echo $item['jumlah_kata']?></td>
                                    <td><?php echo $item['deadline']?></td>
                                    <td><?php echo $item['harga']?></td>
                                    <td><?php echo $item['nama_editor']?></td>
                                    <td><?php echo $item['nama_reviewer']?></td>
                                    <td>
                                        <?php 
                                            if($item['sts_progress']==0)
                                            {
                                                echo "Task has not been accepted/rejected";
                                            }
                                            else if ($item['sts_progress']==1)
                                            {
                                                echo "Rejected";
                                            }
                                            else if ($item['sts_progress']==2)
                                            {
                                                echo "Accepted, task on progress";
                                            }
                                            else if ($item['sts_progress']==3)
                                            {
                                                echo "Waiting confirmation from editor";
                                            }
                                            else if ($item['sts_progress']==4)
                                            {
                                                echo "Review accepted, task is done";
                                            }
                                            else if ($item['sts_progress']==5)
                                            {
                                                echo "Review accepted, task is done";
                                            }
                                        ?>
                                    </td>
                                    <td>
                                        <?php 
                                            if ($item['sts_pembayaran']==1)
                                            {
                                                echo "Waiting for payment checking";
                                            }
                                            else if ($item['sts_pembayaran']==2)
                                            {
                                                echo "Payment rejected";
                                            }
                                            else if ($item['sts_pembayaran']==3)
                                            {
                                                echo "Payment accepted by makelar";
                                            }
                                            else if ($item['sts_pembayaran']==0)
                                            {
                                                echo "Editor has not done any payment";
                                            }
                                        ?>
                                    </td>
                                    <td><a href="<?php echo base_url() . 'index.php/managealltask/artikel/' . $item['id_artikel'];?>"><i class= "glyphicon glyphicon-download-alt"></i>Download</a></td>
                                    <td>
                                        <?php if($item['sts_progress']==3):?>
                                            <a class="btn btn-primary" href="<?php echo base_url() . 'index.php/managealltask/confirming_task_completion/' . $item['id_artikel'] . '/4/' . $item['harga'] . '/' . $item['balance'] . '/' . $item['id_reviewer'] . '/';?>">Confirm</a>
                                        <?php else: ?>
                                            <label> - </label>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                                <?php if(empty($task)):?>
                                    <td colspan="12"> No data found.</td>
                                <?php endif;?>
                                <tr>
                                    <td colspan="12"><?php echo $page_link;?></td>
                                </tr>
                        </table>
                        </div>
                    <hr class="colorgraph">
                </div>
            </div>
        </section>
    </body>
</html>