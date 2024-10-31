<?php
// LAYOUT FOR THE SETTINGS/OPTIONS PAGE
?>

<style>
button {
 background: #8dc63f;
   background: -moz-linear-gradient(top,  #8dc63f 0%, #8dc63f 50%, #7fb239 51%, #7fb239 100%);
   background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#8dc63f), color-stop(50%,#8dc63f), color-stop(51%,#7fb239), color-stop(100%,#7fb239));
   background: -webkit-linear-gradient(top,  #8dc63f 0%,#8dc63f 50%,#7fb239 51%,#7fb239 100%);
   background: -o-linear-gradient(top,  #8dc63f 0%,#8dc63f 50%,#7fb239 51%,#7fb239 100%);
   background: -ms-linear-gradient(top,  #8dc63f 0%,#8dc63f 50%,#7fb239 51%,#7fb239 100%);
   background: linear-gradient(top,  #8dc63f 0%,#8dc63f 50%,#7fb239 51%,#7fb239 100%);
   margin: auto;
   cursor:pointer;
   color: #fff;
   text-shadow: 1px 0px 0 rgba(0,0,0,.4);
   border-radius: 5px;
   border: none;
   font-family: cabin,sans-serif;
   display: block;
   font-weight: bold;
   padding: 5px 15px;
}

.NotifyVisitors_desc {
	float: right;
	width: 40%;
	margin-top: 20px;
	background: #FFF;
	padding: 10px;
	border-radius: 10px;
}
.NotifyVisitors_logo {
	width: 96px;
	margin: 0 auto;
}

.NotifyVisitors_col {
	width: 50%;
	float: left;
}


</style>

<div class="wrap">

<div class="NotifyVisitors_col">


    <?php screen_icon(); ?>
    <form action="options.php" method="post" id=<?php echo $this->plugin_id; ?>"_options_form" name=<?php echo $this->plugin_id; ?>"_options_form">
    <?php settings_fields($this->plugin_id.'_options'); ?>
    <h2>NotifyVisitors &raquo; Options</h2>
    <table width="550" border="0" cellpadding="5" cellspacing="5">    
    
    <tr>
        <td width="144" height="26" align="right" style="padding:0 30px 0 0;vertical-align: top;"><label style="font-weight:600" for="<?php echo $this->plugin_id; ?>[brandID]">brandID:</label> </td>
        <td id="key-holder" width="366" style="padding:5px;"><input placeholder="Got a NotifyVisitors brandid? Enter it here." id="notifyvisitors_brandid" name="<?php echo $this->plugin_id; ?>[brandID]" type="text" value="<?php echo $options['brandID']; ?>" size="40" /></td>
    </tr>
    <tr>
        <td width="144" height="26" align="right" style="padding:0 30px 0 0;vertical-align: top;"><label style="font-weight:600" for="<?php echo $this->plugin_id; ?>[secretkey]">Secret Key:</label> </td>
        <td id="key-holder" width="366" style="padding:5px;"><input placeholder="Got a NotifyVisitors Secret key? Enter it here." id="notifyvisitors_secret_key" name="<?php echo $this->plugin_id; ?>[secretkey]" type="text" value="<?php echo $options['secretkey']; ?>" size="40" /></td>
    </tr>      

    <tr>
        <td width="144" height="16" align="right"></td>
        <td width="366" style="border-bottom: 1px solid #CCC;padding:0 0 10px 0;"><p style="margin-top:3px;font-size:10px;">You will get these credentials in NotifyVisitors admin panel Settings -> Store Integration. You may Click <a href="https://www.notifyvisitors.com/brand/admin/">here</a> to sign up on NotifyVisitors.</p></td>
    </tr>          
          
          
    <tr>
        <td width="144" height="26" align="right" style="margin-top:20px;padding:0 30px 0 0;vertical-align: top;"><label style="font-weight:600" for="<?php echo $this->plugin_id; ?>[enable]">Enable:</label> </td>
        <td width="366"><input type="hidden" name="<?php echo $this->plugin_id; ?>[enable]" value="0" /><input name="<?php echo $this->plugin_id; ?>[enable]" type="checkbox" <?php echo ($options['enable'] || !isset($options['enable']))?'checked="checked"':''; ?> /></td>
    </tr>	

    <tr>
        <td width="144" height="26" align="right"> </td>
        <td width="366"><input type="submit" name="submit" value="Save Options" class="button-primary" /><div>By installing InviteReferrals you agree to the <a href="http://www.invitereferrals.com/campaign/site/policy">Customer Agreement</a></div></td>
    </tr>
    </table>
    </form>
	
	</div>
	
	<div class="NotifyVisitors_desc">
		<div class="NotifyVisitors_logo"><a target="_blank" href="http://www.NotifyVisitors.com"><img src="https://tagnpin.s3.amazonaws.com/static/site/notifyvisitors_logo_x.png" width="150%" /></a></div>
		<hr/>
		<h3 style="text-align: center;">Increase sales with marketing automation software</h3> 
		<div style="text-align: justify;">Start using NotifyVisitors for free. <a target="_blank" href="https://www.notifyvisitors.com/brand/admin/register">Sign Up Here </a>
		<br>For Queries Contact: <strong>support@notifyvisitors.com</strong>
		<br>For Documentation <a target="_blank" href="https://docs.notifyvisitors.com/">Click Here </a></div> 
	</div>
	
</div>
