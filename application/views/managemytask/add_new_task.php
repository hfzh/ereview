<html>
<body>
<section id="featured" class="bg">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
                <?php echo form_open_multipart(base_url() . 'index.php/managemytask/adding_new_task')?>
                  <div class="text-center">
                    <h2>Add New Task</h2>
                  </div>
                    <?php if($this->session->flashdata('fail_upload')):?>
                        <div class="alert alert-danger"><?php echo $this->session->flashdata('fail_upload'); ?></div>
                    <?php endif;?>
                    <?php if($this->session->flashdata('success_add')):?>
                        <div class="alert alert-success"><?php echo $this->session->flashdata('success_add');?></div>
                    <?php endif;?>
                    <hr class="colorgraph">
                    <div class="form-group">
                        <input type="text" id="judul" name="judul" minlength="2" maxlength="150" required class="form-control input-lg" placeholder="Title">
                    </div>
                    <div class="form-group">
                        <input type="text" id="penulis" name="penulis" minlength="2" maxlength="150" required class="form-control input-lg" placeholder="Writer">
                    </div>
                    <div class="form-group">
                        <input type="text" id="katakunci" name="katakunci" minlength="2" maxlength="150" required class="form-control input-lg" placeholder="Keyword">
                    </div>
                    <div class="form-group">
                        <input type="text" id="bidangilmu" name="bidangilmu" minlength="2" maxlength="50" required class="form-control input-lg" placeholder="Field of Study">
                    </div>
                    <div class="form-group">
                        <input type="number" id="jumlahkata" name="jumlahkata" required class="form-control input-lg" placeholder="Number of Words">
                    </div>
                    <div class="form-group">
                        <label for="deadline"> Deadline: </label>
                        <input type="date" id="deadline" name="deadline" required min="<?php echo date('y-m-d') ?>">
                    </div>
                    <div class="form-group">
                        <label for="reviewer">Select reviewer:</label>
                        <select id="reviewer" name="reviewer">
                            <option value="" disabled selected>Select your option</option>
                            <?php if (!empty($reviewers)) : ?>
                                <?php foreach ($reviewers as $item): ?>
                                    <option value="<?php echo $item['id_reviewer']?>"><?php echo $item['nama_reviewer']?></option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select> 
                    </div>
                    <div class="form-group">
                        <label for="artikel"> Article<small> (file must be on .pdf) </small> </label>
                        <input type="file" id="userfile" name="userfile" required>
                    </div>
                    <hr class="colorgraph">
                    <div class="form-group">
                        <div class="aligncenter">
                            <input type="submit" value="Add New Task" class="btn btn-primary btn-block btn-lg">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
</html>