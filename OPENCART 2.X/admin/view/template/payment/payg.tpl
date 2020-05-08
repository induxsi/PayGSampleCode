<?php echo $header; ?>
<?php echo $column_left; ?>
<div id="content">

  <?php if ($error_warning) { ?>
  <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
    <button type="button" class="close" data-dismiss="alert">&times;</button>
  </div>
  <?php } ?>

  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-html" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
      <h1><?php echo $heading_title; ?></h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="container-fluid">
  
	<div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_edit; ?></h3>
      </div>

      <div class="panel-body">
        
		<form action="<?php echo $form_action; ?>" method="post" enctype="multipart/form-data" id="form-html" class="form-horizontal">
     <div class="form-group">  
			<label class="col-sm-2 control-label" for="input-status"><?=$pg_mode;?> *</label>
            <div class="col-sm-10">
              <select name="paygpayment_environment" id="input-status" class="form-control">
                <?php if ($paygpayment_environment) { ?>
                  <option value="1" selected="selected"><?=$pg_enabled;?></option>
                  <option value="0"><?=$pg_disabled;?></option>
                <?php } else { ?>
                   <option value="1" ><?=$pg_enabled;?></option>
                  <option value="0" selected="selected"><?=$pg_disabled;?></option>
                <?php } ?>
              </select>
   			</div>
		  </div>     
		  <div class="form-group">            
			<label class="col-sm-2 control-label" for="input-name"><?php echo $merchant_id_title; ?> *</label>
            <div class="col-sm-10">
              <input type="text" name="paygpayment_merchant_id" value="<?php echo $paygpayment_merchant_id; ?>" placeholder="<?php echo $merchant_id_title; ?>" id="input-name" class="form-control" />
			</div>
          </div>

		  <div class="form-group">
			<label class="col-sm-2 control-label" for="input-html"><?php echo $merchant_secureHashKey_title; ?> *</label>
			<div class="col-sm-10">
       <input type="text" name="paygpayment_secure_key" value="<?php echo $paygpayment_secure_key; ?>" placeholder="<?php echo $merchant_secureHashKey_title; ?>" id="paygpayment_secure_key" class="form-control" />
       </div>
		  </div>
		  
          <div class="form-group">
			<label class="col-sm-2 control-label" for="input-html"><?php echo $authentication_key_title; ?> *</label>
			<div class="col-sm-10">
       <input type="text" name="paygpayment_authentication_key" value="<?php echo $paygpayment_authentication_key; ?>" placeholder="<?php echo $paygpayment_authentication_key; ?>" id="paygpayment_authentication_key" class="form-control" />
    </div>
		  </div>
       
          <div class="form-group">
			<label class="col-sm-2 control-label" for="input-html"><?php echo $authentication_token_title; ?> *</label>
			<div class="col-sm-10">
              <input type="text" name="paygpayment_authentication_token" value="<?php echo $paygpayment_authentication_token; ?>" placeholder="<?php echo $paygpayment_authentication_token; ?>" id="paygpayment_authentication_key" class="form-control" />
          </div>
		  </div>
		    <div class="form-group">
			<label class="col-sm-2 control-label" for="input-html"><?php echo $paygpayment_url_title; ?> *</label>
			<div class="col-sm-10">
             <input type="text" name="paygpayment_url" value="<?php echo $paygpayment_url; ?>" placeholder="<?php echo $paygpayment_url; ?>" id="paygpayment_url" class="form-control" />  </div>
		  </div>
		  
      
		  
               
		
		 <div class="form-group">  
			<label class="col-sm-2 control-label" for="input-status">Status *</label>
            <div class="col-sm-10">
              <select name="payg_status" id="input-status" class="form-control">
                <?php if ($payg_status) { ?>
                  <option value="1" selected="selected">Enabled</option>
                  <option value="0">Disabled</option>
                <?php } else { ?>
                  <option value="1">Enabled</option>
                  <option value="0" selected="selected">Disabled</option>
                <?php } ?>
              </select>
   			</div>
		  </div>
		</form>

	  </div>
	</div>
    
  </div>
</div>
<?php echo $footer; ?>