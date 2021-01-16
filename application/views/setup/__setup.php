
                <div class="card mb-4" id="pageRefresh">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="fs-17 font-weight-600 mb-0"><?php echo @$title;?></h6>
                            </div>

                            <div class="text-right">
                                <div class="actions">
                                   
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="row">

                            <div class="col-sm-6 offset-sm-3">
                        
                                <div class="tab-content" id="pills-tabContent">

                                        <div>
                                            <h3>Please put your (AmazonS3 / Digitaloceanspaces) credentials</h3>
                                        </div><br>

                                        <?php echo form_open('s3_and_spaces/s3_space_setup/save_setup',array('id'=>'s3Form'))?>
                        
                                            <div class="row form-group">
                                                <div class="col-sm-2">
                                                    <label>Access Key<span class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <input type="text" name="access_key" value="<?php echo html_escape(@$s3Info->access_key);?>" class="form-control"  required>
                                                    <span class="text-success">Your access key.</span>
                                                </div>
                                            </div> 

                                            <div class="row form-group">
                                                <div class="col-sm-2">
                                                    <label>Secret Key<span class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <input type="text" name="secret_key" value="<?php echo html_escape(@$s3Info->secret_key);?>" class="form-control" required>
                                                    <span class="text-success">Your Secret Key.</span>
                                                </div>
                                            </div>

                                            <div class="row form-group">
                                                <div class="col-sm-2">
                                                    <label>(Buckt/Space) Name<span class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <input type="text" name="bucket_name" value="<?php echo html_escape(@$s3Info->bucket_name);?>" class="form-control" required>
                                                    <span class="text-success">Your (Buckt/Space) Name.</span>
                                                </div>
                                            </div>

                                            <div class="row form-group">
                                                <div class="col-sm-2">
                                                    <label>Region Name<span class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <input type="text" name="region" value="<?php echo html_escape(@$s3Info->region);?>" class="form-control" required>
                                                    <span class="text-success">Your Region Name.</span>
                                                </div>
                                            </div>

                                            <div class="row form-group">

                                                <div class="col-sm-2">
                                                    <label>Type<span class="text-danger">*</span></label>
                                                </div>

                                                <div class="col-sm-9">
                                                    <div class="i-check">
                                                        <input tabindex="11" type="radio" id="square-radio-1" name="type" value="1" <?php echo (@$s3Info->type==1?'checked':'')?> >
                                                        <label for="square-radio-1">AmazonS3</label>
                                                    </div>
                                                    <div class="i-check">
                                                        <input tabindex="12" type="radio" id="square-radio-2" name="type" value="2" <?php echo (@$s3Info->type==2?'checked':'')?>>
                                                        <label for="square-radio-2">Digitaloceanspaces </label>
                                                    </div>
                                                </div>

                                            </div>


                                            <div class="row form-group">

                                                <div class="col-sm-2">
                                                    <label>Active status</label>
                                                </div>

                                                <div class="col-sm-9">
                                                   <div class="i-check">
                                                        <input tabindex="9" type="checkbox" id="square-checkbox-1" <?php echo (@$s3Info->active_status==1?'checked':'')?> name="status" value="1">
                                                        <label for="square-checkbox-1">Active Status</label>
                                                    </div>
                                                </div>

                                            </div>


                                            <div class="row form-group">
                                                <div class="col-sm-2"></div>
                                                <div class="col-sm-9">
                                                    <button type="submit" class="btn btn-sm btn-success"> <?php echo display('update')?></button>
                                                </div>
                                            </div> 
                                                          
                                        <?php echo form_close();?>

                                   
                                </div>
                            </div>
                        </div>
                                
                    </div>
                </div>

