
<html>
    <body>
        <section id="featured" class="bg">
            <div class="container">
                <div class="row">
                 <div class="text-center">
                    <h2> View Task </h2>
                 </div>
                    <hr class="colorgraph">
                    <label><a href="<?php echo base_url() . 'index.php/managemytask/view_task/1';?>">On Progress</a></label>
                    <label><a href="<?php echo base_url() . 'index.php/managemytask/view_task/0';?>">Completed</a></label>
                    <label><a href="<?php echo base_url() . 'index.php/managemytask/view_task/-1';?>">All</a></label>
                    <div class="aligncenter">
                    <table <td align="center" border="">
                        <tr>
                            <td><a href="<?php echo base_url() . 'index.php/managemytask/view_task/' . $sts_artikel  . '/judul/'; ?>">Title</a></td>
                            <td><a href="<?php echo base_url() . 'index.php/managemytask/view_task/' . $sts_artikel  . '/penulis/'; ?>">Writer</a></td>
                            <td><a href="<?php echo base_url() . 'index.php/managemytask/view_task/' . $sts_artikel  . '/kata_kunci/'; ?>">Keyword</a></td>
                            <td><a href="<?php echo base_url() . 'index.php/managemytask/view_task/' . $sts_artikel  . '/bidang_ilmu/'; ?>">Field of Study</a></td>
                            <td><a href="<?php echo base_url() . 'index.php/managemytask/view_task/' . $sts_artikel  . '/jumlah_kata/'; ?>">Number of Words</a></td>
                            <td><a href="<?php echo base_url() . 'index.php/managemytask/view_task/' . $sts_artikel  . '/deadline/'; ?>">Deadline</a></td>
                            <td><a href="<?php echo base_url() . 'index.php/managemytask/view_task/' . $sts_artikel  . '/nama_reviewer/'; ?>">Reviewer Name</a></td>
                            <td><a href="<?php echo base_url() . 'index.php/managemytask/view_task/' . $sts_artikel  . '/sts_progress/'; ?>">Progress Status</a></td>
                            <td><a href="<?php echo base_url() . 'index.php/managemytask/view_task/' . $sts_artikel  . '/sts_pembayaran/'; ?>">Payment Status</a></td>
                            <td>Download Here</td>
                        </tr>
                        <?php foreach($artikel as $item):?>
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
                                            echo "Task has not been accepted/rejected";
                                        }
                                        else if ($item['sts_progress']==1)
                                        {
                                            echo "Rejected";
                                        }
                                        else if ($item['sts_progress']==2)
                                        {
                                            echo "Accepted, On Progress";
                                        }
                                        else if ($item['sts_progress']==3)
                                        {
                                            echo "Waiting for editor to confirm completion";
                                        }
                                        else if ($item['sts_progress']==4)
                                        {
                                            echo "Done accepted by makelar";
                                        }
                                        else if ($item['sts_progress']==5)
                                        {
                                            echo "Done accepted by editor";
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
                                            echo "Payment Accepted";
                                        }
                                    ?>
                                </td>
                                <td>
                                    <?php if($item['sts_pembayaran']==3 && $item['sts_progress']==3 || $item['sts_progress']==5):?>
                                        <a class = "btn" href="<?php echo base_url().'index.php/managemytask/artikel/' . $item['id_artikel'];?>"><i class= "glyphicon glyphicon-download-alt"></i>Download</a>
                                    <?php elseif ($item['sts_artikel']==0):?>
                                        <?php echo "Task closed" ;?>
                                    <?php else:?>
                                        <?php echo "Task/Payment is not done";?>
                                    <?php endif; ?>
                                </td>
                        <?php endforeach ?>
                        <?php if(empty($artikel)):?>
                            <td colspan="10"> No data found.</td>
                        <?php endif;?>
                            <tr>
                                <td colspan="10"><?php echo $page_link; ?></td>
                            </tr>
                    </table>
                    </div>
                    <hr class="colorgraph">
                </div>
            </div>
        </section>
    </body>	
</html>