<html>
	<body>
        <section id="featured" class="bg">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
                        <?php echo form_open_multipart(base_url() . 'index.php/managemytask/payed')?>
                          <div class="text-center">
                            <h2>Commit Your Payment</h2>
                          </div>
                            <hr class="colorgraph">
                            <div class="form_group">
                                <p>Price of review for article is Rp250/kata</p>
                            </div>
                            <div class="form_group">
                                <p>Berikut merupakan jumlah yang harus dibayar</p>
                            </div>
                            <div class="form_group">
                            <div class="aligncenter">
                                <table <td align="center" border="">
                                    <tr>
                                        <td>Title</td>
                                        <td>Writer</td>
                                        <td>Keyword</td>
                                        <td>Field of Study</td>
                                        <td>Number of Words</td>
                                        <td>Deadline</td>   
                                        <td>Price</td>
                                    </tr>
                                    <?php foreach ($artikel as $item): ?>
                                    <tr>
                                        <td><?php echo $item['judul'] ?></td>
                                        <td><?php echo $item['penulis'] ?></td>
                                        <td><?php echo $item['kata_kunci'] ?></td>
                                        <td><?php echo $item['bidang_ilmu'] ?></td>
                                        <td><?php echo $item['jumlah_kata'] ?></td>
                                        <td><?php echo $item['deadline'] ?></td>
                                        <td><?php echo strval($item['jumlah_kata'])*250?></td>
                                    </tr>
                                </table>
                            </div>
                            </div>
                            <div class="form_group">
                                <label for="bukti"> Proof of Payment: <small> (jpeg | jpg | png | pdf | gif) </small</label>
                                    <input type="file" id="userfile" name="userfile" required>
                                <input name="id" type="hidden" value="<?php echo $item['id_artikel']?>">
                                <?php endforeach ?>
                            </div> 
                            <hr class="colorgraph">
                            <div class="form-group">
                                <div class="aligncenter">
                                    <input type="submit" value="Pay" class="btn btn-primary btn-block btn-lg">
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </body>
</html>