<?php if($error!=""){
	echo $error;
	die;
}else{?>
<form action="<?php echo $action; ?>" method="post"> 
    
    <input type="hidden" class="form-control" name="MerchantKeyId"  value="<?=$MerchantKeyId;?>" /><br/>
    
    <input type="hidden" class="form-control" name="AuthenticationKey"  value="<?=$AuthenticationKey?>" /><br/>
     
    <input type="hidden" class="form-control" name="AuthenticationToken"  value="<?=$AuthenticationToken?>" /><br/>
   
    <input type="hidden" class="form-control" name="RequestUniqueId"  value="<?=$RequestUniqueId?>" /><br/>
    
    <input type="hidden" class="form-control" name="PaymentType"  value="<?=$PaymentType?>" /><br/>
    
    <input type="hidden" class="form-control" name="Amount"  value="<?=$Amount?>" /><br/>
    
    <input type="hidden" class="form-control" name="ResponseRedirectUrl"  value="<?=$ResponseRedirectUrl?>" /><br/>
    
    <input type="hidden" class="form-control" name="CancelRedirectUrl"  value="<?=$CancelRedirectUrl?>" /> <br/>
     
    <input type="hidden" class="form-control" name="HashData"  value="<?=$txn_details?>" /><br/>
    
    <input type="hidden" class="form-control" name="RequestDateTime" value="<?=date("d/m/Y h:m:i")?>" /> <br/>
     
    <input type="hidden" class="form-control" name="UserName" value="" />  <br/>
    
    <input type="hidden" class="form-control" name="OrderId"  value="<?=$OrderId?>" /><br/>
    
    <input type="hidden" class="form-control" name="CustomerEmail"  value="<?=$CustomerEmail?>" /> <br/>
    
    <input type="hidden" class="form-control" name="TransactionType"  value="<?=$TransactionType?>" /> <br/>
    
    <input type="hidden" class="form-control" name="IntegrationType"  value="0" />  
  	
	<div class="buttons">
	<div class="right">
	    <input type="submit" value="<?php echo $button_confirm; ?>" class="button" />
	</div>
	</div>
</form>
<?php }?>