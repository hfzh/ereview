<html>
	<body>
        <section id="featured" class="bg">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-offset-2">
                      <div class="text-center">
                        <h2>Task Confirmation</h2>
                      </div>
                        <?php if($this->session->flashdata('reject_task')):?>
                            <div class="alert alert-success"><?php echo $this->session->flashdata('reject_task');?></div>
                        <?php endif;?>
                        <?php if($this->session->flashdata('accept_task')):?>
                            <div class="alert alert-success"><?php echo $this->session->flashdata('accept_task');?></div>
                        <?php endif;?>
                        <?php if($this->session->flashdata('mark_task_done')):?>
                            <div class="alert alert-success"><?php echo $this->session->flashdata('mark_task_done');?></div>
                        <?php endif;?>
                        <hr class="colorgraph">
                        <div class="aligncenter">
                        <table <td align="center" border="">
                            <tr>
                                <td>Title</td>
                                <td>Writer</td>
                                <td>Keyword</td>
                                <td>Field of Study</td>
                                <td>Number of Words</td>
                                <td>Deadline</td>
                                <td>Editor Name</td>
                                <td>Task Status</td>
                                <td>Payment Status</td>
                                <td>Download</td>
                                <td colspan="2">Confirmation</td>
                            </tr>
                            <?php foreach($task as $item):?>
                            <tr>
                                <td><?php echo $item['judul']?></td>
                                <td><?php echo $item['penulis']?></td>
                                <td><?php echo $item['kata_kunci']?></td>
                                <td><?php echo $item['bidang_ilmu']?></td>
                                <td><?php echo $item['jumlah_kata']?></td>
                                <td><?php echo $item['deadline']?></td>
                                <td><?php echo $item['nama_editor']?></td>
                                <td>
                                    <?php
                                        if($item['sts_progress']==0)
                                            echo 'Awaiting your confirmation';
                                        else if($item['sts_progress'] == 2 && $item['sts_pembayaran']==0)
                                            echo 'Task accepted, awaiting for payment';
                                        else if($item['sts_progress'] == 2)
                                            echo 'Review on Progress';
                                    ?>
                                </td>
                                <td>
                                    <?php
                                        if($item['sts_pembayaran']==0 && $item['sts_progress']==0)
                                            echo 'Awaiting your confirmation';
                                        else if($item['sts_pembayaran']==0)
                                            echo 'Awaiting payment from editor';
                                        else if($item['sts_pembayaran']==1)
                                            echo 'Payment awaiting confirmation by makelar';
                                        else if($item['sts_pembayaran']==2)
                                            echo 'Payment Rejected, you can mark task as done';
                                    ?>
                                </td>
                                <td><a class="btn" href="<?php echo base_url().'index.php/manageassignedtask/artikel/' . $item['id_artikel'];?>"><i class="glyphicon glyphicon-download-alt"></i> Download</a></td>
                                <?php if($item['sts_pembayaran']==0 && $item['sts_progress']==0):?>
                                    <td><a class="btn btn-primary" href="<?php echo base_url() . 'index.php/manageassignedtask/confirming_task/' . $item['id_artikel'] . '/2/';?>">Accept</a></td>
                                    <td><a class="btn btn-danger" href="<?php echo base_url() . 'index.php/manageassignedtask/confirming_task/' . $item['id_artikel'] . '/1/';?>">Reject</a></td>
                                <?php elseif ($item['sts_pembayaran']==1 && $item['sts_progress']==0):?>
                                    <td colspan="2"> <label> Payment awaiting confirmation by makelar </label> </td>
                                <?php elseif ($item['sts_pembayaran']==2):?>
                                    <td colspan ="2"><a class="btn btn-primary" href="<?php echo base_url() . 'index.php/manageassignedtask/mark_task_done/' . $item['id_artikel'];?>">Mark as Done</a></td>
                                <?php elseif ($item['sts_progress']!=0):?>
                                    <td colspan="2"> <label> Awaiting payment from editor </label> </td>
                                <?php endif;?>
                            </tr>

                            <?php endforeach;?>
                            <?php if(empty($task)):?>
                                <td colspan="12"> No data found.</td>
                            <?php endif;?>
                        </table>
                        </div>
                        <hr class="colorgraph">
                    </div>
                    </form>
                    </div>
                </div>
            </div>
        </section>
    </body>
</html>