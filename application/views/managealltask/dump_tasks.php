<html>
    <body>
        <section id="featured" class="bg">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-offset-2">
                      <div class="text-center">
                        <h2> Dump Tasks </h2>
                      </div>
                        <?php if($this->session->flashdata('dump_task')): ?>
                            <div class="alert alert-success"><?php echo $this->session->flashdata('dump_task'); ?></div>
                        <?php endif; ?>
                        <hr class="colorgraph">
                        <div class="aligncenter">
                        <table <td align="center" border="">
                            <tr>
                                <td><a href="<?php echo base_url() . 'index.php/managealltask/dump_tasks' .'/judul/'; ?>">Title</a></td>
                                <td><a href="<?php echo base_url() . 'index.php/managealltask/dump_tasks' .'/penulis/'; ?>">Writer</a></td>
                                <td><a href="<?php echo base_url() . 'index.php/managealltask/dump_tasks' . '/kata_kunci/'; ?>">Keyword</a></td>
                                <td><a href="<?php echo base_url() . 'index.php/managealltask/dump_tasks' . '/bidang_ilmu/'; ?>">Field of Study</a></td>
                                <td><a href="<?php echo base_url() . 'index.php/managealltask/dump_tasks' . '/jumlah_kata/'; ?>">Number of Words</a></td>
                                <td><a href="<?php echo base_url() . 'index.php/managealltask/dump_tasks' . '/deadline/'; ?>">Deadline</a></td>
                                <td><a href="<?php echo base_url() . 'index.php/managealltask/dump_tasks' . '/harga/'; ?>">Price</a></td>
                                <td><a href="<?php echo base_url() . 'index.php/managealltask/dump_tasks' . '/nama_editor/'; ?>">Editor Name</a></td>
                                <td><a href="<?php echo base_url() . 'index.php/managealltask/dump_tasks' . '/nama_reviewer/'; ?>">Reviewer Name</a></td>
                                <td><a href="<?php echo base_url() . 'index.php/managealltask/dump_tasks' . '/sts_progress/'; ?>">Progress Status</a></td>
                                <td><a href="<?php echo base_url() . 'index.php/managealltask/dump_tasks' . '/sts_pembayaran/'; ?>">Payment Status</a></td>
                                <td>Dump</td>
                            </tr>
                            <?php foreach($tasks as $item): ?>
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
                                            echo "Task have not been accepted/rejected";
                                        }
                                        else if ($item['sts_progress']==1)
                                        {
                                            echo "Rejected";
                                        }
                                        else if ($item['sts_progress']==2)
                                        {
                                            echo "Accepted on Progress";
                                        }
                                        else if ($item['sts_progress']==3)
                                        {
                                            echo "Waiting Confirmation from Editor";
                                        }
                                        else if ($item['sts_progress']==4)
                                        {
                                            echo "Review Accepted, Task is Done";
                                        }
                                        else if ($item['sts_progress']==5)
                                        {
                                            echo "Review Accepted, Task is Done";
                                        }
                                    ?>
                                </td>
                                <td>
                                    <?php 
                                        if ($item['sts_pembayaran']==1)
                                        {
                                            echo "Waiting for Payment Checking";
                                        }
                                        else if ($item['sts_pembayaran']==2)
                                        {
                                            echo "Payment Rejected";
                                        }
                                        else if ($item['sts_pembayaran']==3)
                                        {
                                            echo "Payment Accepted by Makelar";
                                        }
                                        else if ($item['sts_pembayaran']==0)
                                        {
                                            echo "Belum melakukan pembayaran";
                                        }
                                    ?>
                                </td>
                                <td><a href="<?php echo base_url() . 'index.php/managealltask/dumping_task/' . $item['id_artikel'];?>">Dump</a></td>
                            </tr>
                        <?php endforeach ?>
                            <?php if(empty($tasks)):?>
                                <td colspan="13"> No data found.</td>
                            <?php endif;?>
                                <tr>
                                    <td colspan="13"> <?php echo $page_link; ?> </td>
                                </tr>
                        </table>
                        </div>
                        <hr class="colorgraph">
                        <div class="form-group">
                            <div class="aligncenter">
                                <input type="submit" value="Confirm" class="btn btn-primary btn-block btn-lg">
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </body>
</html>