<html>
    <body>
        <section class="bg">
            <div class="container" >
                <div class="row">
                    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
                    <?php echo form_open_multipart(base_url() . 'index.php/managealltask/dumping_reviewer')?>
                      <div class="text-center">
                        <h2> Dump Reviewers</h2>
                      </div>
                        <?php if($this->session->flashdata('dump_reviewer')): ?>
                            <div class="alert alert-success"><?php echo $this->session->flashdata('dump_reviewer'); ?></div>
                        <?php endif; ?>
                        <hr class="colorgraph">
                            <div class="aligncenter">
                            <table <td align="center"border="">
                                <tr>
                                    <td><a href="<?php echo base_url() . 'index.php/managealltask/dump_reviewers' .'/id_user/'; ?>">Id User</a></td>
                                    <td><a href="<?php echo base_url() . 'index.php/managealltask/dump_reviewers' .'/nama_reviewer/'; ?>">Name</a></td>
                                    <td><a href="<?php echo base_url() . 'index.php/managealltask/dump_reviewers' .'/nama_reviewer/'; ?>">Email</a></td>
                                    <td><a href="<?php echo base_url() . 'index.php/managealltask/dump_reviewers' .'/date_created/'; ?>">Date Created</a></td>
                                    <td>Dump</td>
                                </tr>
                                <?php foreach($reviewers as $item):?>
                                    <tr>
                                        <td><?php echo $item['id_user']?></td>
                                        <td><?php echo $item['nama_reviewer']?></td>
                                        <td><?php echo $item['email_reviewer']?></td>
                                        <td><?php echo $item['date_created']?></td>
                                       
                                        <td><a href="<?php echo base_url() . 'index.php/managealltask/dumping_reviewer/' . $item['id_user'];?>">Dump</a></td>
                                        </td>
                                    </tr>
                                    <?php endforeach;?>
                                    <tr>
                                        <td colspan="6"> <?php echo $page_link; ?> </td>
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