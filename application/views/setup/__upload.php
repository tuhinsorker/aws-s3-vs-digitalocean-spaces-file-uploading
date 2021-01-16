
                <div class="card mb-4">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="fs-17 font-weight-600 mb-0"><?php echo @$title;?></h6>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">

                        <?php if(!empty($img_url)){?>
                            <?php echo $img_url;?>
                            <img src="<?php echo $img_url?>" width="200">
                        <?php }?>


                        <?php echo form_open_multipart('s3_and_spaces/upload/addImages');?>
                        
                        <?php //echo form_open_multipart('s3_and_spaces/upload/fileUpload')?>

                                            <div class="col-md-4">
                                                <fieldset>
                                                    <legend>Thumb Image Size</legend><hr>
                                                    <div class="col-xs-12">
                                                        <div class="form-group">
                                                            <label>Height(Y)</label>
                                                            <input type="number" name="thime_y" value="280" class="form-control"/>
                                                        </div>
                                                    </div>

                                                    <div class="col-xs-12">
                                                        <div class="form-group">
                                                           <label>Width(X):</label>
                                                            <input type="number" name="thime_x" value="400" class="form-control"/>     
                                                        </div>
                                                    </div>
                                                </fieldset>
                                            </div>


                                            <div class="col-md-4">
                                                <fieldset>
                                                    <legend>Large Image Size</legend>
                                                    <hr>

                                                    <div class="col-xs-12">
                                                        <div class="form-group">
                                                            <label>Height(Y):</label>
                                                           <input type="number" name="img_y" value="451" class="form-control"/>
                                                        </div>
                                                    </div>

                                                    <div class="col-xs-12">
                                                        <div class="form-group">
                                                           <label>Width(X):</label>
                                                             <input type="number" name="img_x" value="643" class="form-control" />
                                                        </div>
                                                    </div>
                                                </fieldset>
                                            </div>




                            <div class="row form-group">
                                <div class="col-sm-2">
                                    <label>Upload<span class="text-danger">*</span></label>
                                </div>
                                <div class="col-sm-9">
                                    <input  type="file" name="files" multiple class="form-control"  required>
                                </div>
                            </div> 

                            <div class="row form-group">
                                <div class="col-sm-2"></div>
                                <div class="col-sm-9">
                                    <button type="submit"  class="btn btn-sm btn-success"> <?php echo display('Upload')?></button>
                                </div>
                            </div>        
                        <?php echo form_close();?>

                    </div>
                </div>
          