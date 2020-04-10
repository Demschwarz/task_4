<html>
  <head>
  	 <meta name="lera" content="text/html: charset=utf-8">
  	 <title>Task Fout</title>
     <meta name="lera" content="text/html: charset=utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1">
  	 <style src='./style.css'></style>
    
  </head>
  <body>

<?php
if (!empty($messages)) {
  print('<div id="messages">');
  foreach ($messages as $message) {
    print($message);
  }
  print('</div>');
}
?>
	<div>
    	<form action="" method="POST">
    		<div class="group">
                <label>Name:</label>
    			<input type="text" name="fio" class="group1" <?php if ($errors['fio']) {print 'id="error"';} ?> value="<?php print $values['fio']; ?>" />
      		</div>
      		<div class="group">
                <label for="email">Email:</label>
                <input type="text" name="email" class="group1" <?php if ($errors['email']) {print 'id="error"';} ?> value="<?php print $values['email']; ?>" />
      		</div>
      		<div class="group">
                <label>DBirth:</label>
                
                <select class="group1" name="year" <?php if ($errors['year']) {print 'id="error"';} ?> >
                	<?php
                	$select=array(1992 => '',1993 => '',1994 => '',1995 => '',1996 => '',1997 => '',1998=>'', 1999 => '',2000 => '',2001 => '',2002 => '',2003 => '',2004 => '',2005 => '',2006 => '',2007 => '');
                	for($i=1992; $i<=2007; $i++){
                        if($values['year']==$i){
                                    $select[$i]='selected';
                                }
                            }
                     ?>
    				<?php for($i = 1992; $i < 2007; $i++) { ?>
    				<option value="<?php print $i; ?>" <?php print $select[$i]?> ><?= $i; ?></option>
    				<?php } ?>
  				</select>
            </div>
      		<span <?php if ($errors['year']) {print 'id="error"';} ?> >Gender:</span>
            <br>
            <div class="group2">
                <label class="group3">
                    <input type="radio" name="gender" value="female" <?php if($values['gender']=='female') {print'checked';}?>>Female
                </label>
            </div>
            <div class="group2">
                <label class="group3">
                    <input type="radio" name="gender" value="male" <?php if($values['gender']=='male') {print'checked';}?>>Male
                </label>
            </div>
      		<div class="group">
                Number of lungs <br>
                <div class="group2">
                    <label class="group3">
                        <input type="radio" name="lungs" value="0" <?php if($values['lungs']=='0') {print'checked';}?>>I got no
                    </label>
                </div>
                <div class="group2">
                    <label class="group3">
                        <input type="radio" name="lungs" value="1" <?php if($values['lungs']=='1') {print'checked';}?>>1
                    </label>
                </div>
                <div class="group2">
                    <label class="group3">
                        <input type="radio" name="lungs" value="2" <?php if($values['lungs']=='2') {print'checked';}?>>2
                    </label>
                </div>
                <div class="group2">
                    <label class="group3">
                        <input type="radio" name="lungs" value="2" <?php if($values['lungs']=='3') {print'checked';}?>>3
                    </label>
                </div>
                <div class="group2">
                    <label class="group3">
                        <input type="radio" name="lungs" value="2" <?php if($values['lungs']=='4') {print'checked';}?>>4
                    </label>
                </div>
            </div>
            <div class="group">
                <label>Abilities:</label>
                
                <select class="group1" name="abilities[]" multiple <?php if ($errors['abilities']) {print 'id="error"';} ?>>
                <?php 
                foreach ($abilities as $key => $value) {
                    $selected = empty($values['abilities'][$key]) ? '' : 'selected="selected"';
                    printf('<option value="%s" %s>%s</option>', $key, $selected, $value);
                } ?>
                </select>
            <div class="group">
                <label for="comment">Your biography</label>
                <textarea class="group1" rows="10" name="bio" <?php if ($errors['bio']) {print 'id="error"';} ?>><?php print $values['bio']; ?></textarea>
            </div>
            <label class="group3" id="mychek"><input class="form-check-input" type="checkbox" name="check" <?php if (!$errors['check']) {print 'checked';} else {print 'id="error"';} ?>> I do agree with the agreement </label>
      		<input type="submit" value="ok" />
    	</form>
    </div>
  </body>
</html>
