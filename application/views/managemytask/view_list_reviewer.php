
<html>
    <body>
        <section id="featured" class="bg">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
                      <div class="text-center">
                        <h2> View List Reviewers </h2>
                      </div>
                        <hr class="colorgraph">
                        <table <td align="center" border="">
                            <tr>
                                <td><a href="<?php echo base_url() . 'index.php/managemytask/view_list_reviewer' . '/nama_reviewer/'; ?>">Reviewer Name</a></td>
                                <td><a href="<?php echo base_url() . 'index.php/managemytask/view_list_reviewer' . '/email_reviewer/'; ?>">Reviewer Email</a></td>
                                <td><a href="<?php echo base_url() . 'index.php/managemytask/view_list_reviewer/' .'/bidang_ahli/'; ?>">Proffesionality</a></td>
                            </tr>
                            <?php foreach($reviewer as $item):?>
                                <tr>                       
                                    <td><?php echo $item['nama_reviewer']?></td>
                                    <td><?php echo $item['email_reviewer']?></td>
                                    <td><?php echo $item['bidang_ahli']?></td>
                                </tr>
                            <?php endforeach ?>
                                <tr>
                                    <td colspan="3"><?php echo $page_link; ?></td>
                                </tr>
                        </table>
                        <hr class="colorgraph">
                    </div>
                    
                </div>
            </div>
        </section>
    </body>	
</html>