<html>
	<body>
        <section id="featured" class="bg">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
                        <?php echo form_open_multipart(base_url() . 'index.php/manageassignedtask/submitting_review')?>
                          <div class="text-center">
                            <h2> Submit Review </h2>
                          </div>
                            <?php if($this->session->flashdata('fail_upload')):?>
                                <div class="alert alert-danger"><?php echo $this->session->flashdata('fail_upload')?></div>
                            <?php endif; ?>
                            <?php if($this->session->flashdata('success_submit')):?>
                                <div class="alert alert-success"><?php echo $this->session->flashdata('success_submit')?></div>
                            <?php endif; ?>
                            <hr class="colorgraph">
                            <label for="id">Select an article you want to submit: </label>
                            <select id="id" name="id" required>
                                <option value="" disabled selected>Select your option</option>
                                <?php foreach ($artikel as $item): ?>
                                    <option value="<?php echo $item['id_artikel']?>"> <?php echo $item['judul']?>
                                <?php endforeach; ?> 
                            </select>
                            <label for="file">Article</label>
                            <input type="file" id="userfile" name="userfile">
                            <input type="hidden" id="progress" name="progress" value="3">
                            <hr class="colorgraph">
                            <div class="form-group">
                                <div class="aligncenter">
                                    <input type="submit" value="Submit Review" class="btn btn-primary btn-block btn-lg">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </body>
</html>