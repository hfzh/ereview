<html>
    <body>
        <section id="featured" class="bg">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-offset-2">
                     <div class="text-center">
                        <h2> Monitor Payment </h2>
                     </div>
                        <?php if($this->session->flashdata('reject_payment')): ?>
                            <div class="alert alert-success"><?php echo $this->session->flashdata('reject_payment'); ?></div>
                        <?php endif; ?>
                        <?php if($this->session->flashdata('accept_payment')): ?>
                            <div class="alert alert-success"><?php echo $this->session->flashdata('accept_payment'); ?></div>
                        <?php endif; ?>
                        <hr class="colorgraph">
                        <p> Every article payment in this page need your confirmation. Download the proof of payment and make sure it has the same amount of value within the price coulumn. </p>
                        <div class="aligncenter">
                        <table <td align="center" border="">
                            <tr>
                                <td><a href="<?php echo base_url() . 'index.php/managealltask/monitor_payments' .'/judul/'; ?>">Title</a></td>
                                <td><a href="<?php echo base_url() . 'index.php/managealltask/monitor_payments' .'/penulis/'; ?>">Writer</a></td>
                                <td><a href="<?php echo base_url() . 'index.php/managealltask/monitor_payments' . '/kata_kunci/'; ?>">Keyword</a></td>
                                <td><a href="<?php echo base_url() . 'index.php/managealltask/monitor_payments' . '/bidang_ilmu/'; ?>">Field of Study</a></td>
                                <td><a href="<?php echo base_url() . 'index.php/managealltask/monitor_payments' . '/jumlah_kata/'; ?>">Number of Words</a></td>
                                <td><a href="<?php echo base_url() . 'index.php/managealltask/monitor_payments' . '/deadline/'; ?>">Deadline</a></td>
                                <td><a href="<?php echo base_url() . 'index.php/managealltask/monitor_payments' . '/harga/'; ?>">Price</a></td>
                                <td><a href="<?php echo base_url() . 'index.php/managealltask/monitor_payments' . '/nama_editor/'; ?>">Editor Name</a></td>
                                <td><a href="<?php echo base_url() . 'index.php/managealltask/monitor_payments' . '/nama_reviewer/'; ?>">Reviewer Name</a></td>
                                <td><a href="<?php echo base_url() . 'index.php/managealltask/monitor_payments' . '/bukti_pembayaran/'; ?>">Proof of Payment</a></td>
                                <td colspan="2">Confirmation</td>
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
                                    <td><a class="btn" href="<?php echo base_url().'index.php/managealltask/bukti_pembayaran/' . $item['id_artikel'];?>"><i class="glyphicon glyphicon-download-alt"></i> Download</a></td>
                                    <td><a class="btn btn-primary" href="<?php echo base_url() . 'index.php/managealltask/monitoring_payment/' . $item['id_artikel'] . '/3/';?>">Accept</a></td>
                                    <td><a class="btn btn-danger" href="<?php echo base_url() . 'index.php/managealltask/monitoring_payment/' . $item['id_artikel'] . '/2/';?>">Reject</a></td>
                                </tr> 
                                <?php endforeach ?>
                                <?php if(empty($task)):?>
                                    <td colspan="11"> No data found.</td>
                                <?php endif;?>
                                <tr>
                                    <td colspan="11"> <?php echo $page_link; ?> </td>
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