<?php if($error!=""){
	echo $error;
	die;
}else{?>
<form action="<?php echo $action; ?>" method="post"> 
    
    <input type="hidden" class="form-control" name="MerchantKeyId" id="" value="<?=MerchantKeyId;?>" /><br/>
    
    <input type="hidden" class="form-control" name="AuthenticationKey" id="" value="<?=$AuthenticationKey?>" /><br/>
     
    <input type="hidden" class="form-control" name="AuthenticationToken" id="" value="<?=$AuthenticationToken?>" /><br/>
   
    <input type="hidden" class="form-control" name="RequestUniqueId" id="" value="<?=$RequestUniqueId?>" /><br/>
    
    <input type="hidden" class="form-control" name="PaymentType" id="" value="CC" /><br/>
    
    <input type="hidden" class="form-control" name="Amount" id="" value="<?=$Amount?>" /><br/>
    
    <input type="hidden" class="form-control" name="ResponseRedirectUrl" id="" value="<?=$ResponseRedirectUrl?>" /><br/>
    
    <input type="hidden" class="form-control" name="CancelRedirectUrl" id="" value="<?=$CancelRedirectUrl?>" /> <br/>
     
    <input type="hidden" class="form-control" name="HashData" id="" value="<?=$txn_details?>" /><br/>
    
    <input type="hidden" class="form-control" name="RequestDateTime" value="<?=date("d/m/Y h:m:i")?>" /> <br/>
     
    <input type="hidden" class="form-control" name="UserName" value="praveen@inducocial.com" />  <br/>
    
    <input type="hidden" class="form-control" name="OrderId" id="" value="<?=$OrderId?>" /><br/>
    
    <input type="hidden" class="form-control" name="CustomerEmail" id="" value="<?=$CustomerEmail?>" /> <br/>
    
    <input type="hidden" class="form-control" name="TransactionType" id="" value="<?=$TransactionType?>" /> <br/>
    
    <input type="hidden" class="form-control" name="IntegrationType" id="" value="0" /> <br/>
    <input type="hidden" class="form-control" name="RefTransactionId" id="" value="<?=$RefTransactionId?>" /> <br/> 
  	
	<div class="buttons">
	<div class="right">
	    <input type="submit" value="<?php echo $button_confirm; ?>" class="button" />
	</div>
	</div>
</form>
<?php }?>