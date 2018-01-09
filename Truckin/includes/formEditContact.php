<?php
  if (isset($_POST['ct_b_save'])) {
    updateContact();
    $_SESSION['mode'] = "Display";
  }

  if (isset($_POST['list_select'][0])) {
    $_SESSION['id'] = $_POST['list_select'][0];
  }

  function getContact(){
      $db_conn = dbconnect('localhost', 'week7', 'spencer', 'Mirr0r!');
      $qry = 'SELECT * FROM contact';
      $qry .= ' LEFT JOIN contact_address ON ct_id = ad_ct_id';
      $qry .= ' LEFT JOIN contact_phone ON ct_id = ph_ct_id';
      $qry .= ' LEFT JOIN contact_email ON ct_id = em_ct_id';
      $qry .= ' LEFT JOIN contact_web ON ct_id = we_ct_id';
      $qry .= ' LEFT JOIN contact_note ON ct_id = no_ct_id';
      $qry .= ' WHERE ct_id ='.$_POST['list_select'][0];
      $qry .= ' GROUP BY ct_id;';
      if ($rs = $db_conn->query($qry)){
    		if ($rs->num_rows > 0){
          return $rs;
        }
      }
  }

function formEditContact(){

  $rs = getContact();
  $row = $rs->fetch_assoc();

  $fname = '';
  $lname = '';
  $dname = '';
  if (isset($row['ct_first_name'])){
    $fname = $row['ct_first_name'];
  } else if (isset($_POST['ct_first_name'])){
    $fname = $_POST['ct_first_name'];
  }
  if (isset($row['ct_last_name'])){
    $lname = $row['ct_last_name'];
  } else if (isset($_POST['ct_last_name'])){
    $lname = $_POST['ct_last_name'];
  }
  if (isset($row['ct_disp_name'])){
    $dname = $row['ct_disp_name'];
  } else if (isset($_POST['ct_disp_name'])){
    $dname = $_POST['ct_disp_name'];
  }

  $ct_type = "";
	if (isset($row['ct_type'])) {
		$ct_type = $row['ct_type'];
	} else if (isset($_POST['ct_type'])){
		$t1 = $_POST['ct_type'];
		if (($t1 == "Friend") || ($t1 == "Family")
			|| ($t1 == "Business") || ($t1 == "Other")) {
			$ct_type = $_POST['ct_type'];
		}
 	}

  $ad_type = "";
	$line1 = "";
	$line2 = "";
	$line3 = "";
	$city = "";
	$province = "";
	$postcode = "";
	$country = "";
	if (isset($row['ad_type'])){
		$ad_type = $row['ad_type'];
	} else if (isset($_POST['ad_type'])){
		$type1 = $_POST['ad_type'];
		if (($type1 == "Home") ||  ($type1 == "Work")
			|| ($type1 == "Other")){
			$ad_type = $_POST['ad_type'];
		}
	}
	if (isset($row['ad_line_1'])){
		$line1 = $row['ad_line_1'];
	} else if (isset($_POST['ad_line_1'])){
		$line1 = $_POST['ad_line_1'];
	}
	if (isset($row['ad_line_2'])){
		$line2 = $row['ad_line_2'];
	} else if (isset($_POST['ad_line_2'])){
		$line2 = $_POST['ad_line_2'];
	}
	if (isset($row['ad_line_3'])){
		$line3 = $row['ad_line_3'];
	} else if (isset($_POST['ad_line_3'])){
		$line3 = $_POST['ad_line_3'];
	}
	if (isset($row['ad_city'])){
		$city = $row['ad_city'];
	} else if (isset($_POST['ad_city'])){
		$city = $_POST['ad_city'];
	}
	if (isset($row['ad_province'])){
		$province = $row['ad_province'];
	} else if (isset($_POST['ad_province'])){
		$province = $_POST['ad_province'];
	}
	if (isset($row['ad_post_code'])){
		$postcode = $row['ad_post_code'];
	} else if (isset($_POST['ad_post_code'])){
		$postcode = $_POST['ad_post_code'];
	}
	if (isset($row['ad_country'])){
		$country= $row['ad_country'];
	} else if (isset($_POST['ad_country'])){
		$country = $_POST['ad_country'];
	}

  $em_type = "";
	$email = "";
	if (isset($row['em_type'])){
		$em_type = $row['em_type'];
	} else if (isset($_POST['em_type'])){
		$type1 = $_POST['em_type'];
		if (($type1 == "Home") ||  ($type1 == "Work")
			 || ($type1 == "Other")){
			$em_type = $_POST['em_type'];
		}
	}
	if (isset($row['em_email'])){
		$email = $row['em_email'];
	} else if (isset($_POST['em_email'])){
		$email = $_POST['em_email'];
	}

  $ph_type = "";
  $number = "";
  if (isset($row['ph_type'])){
    $ph_type = $row['ph_type'];
  } else if (isset($_POST['ph_type'])){
    $type1 = $_POST['ph_type'];
    if (($type1 == "Home") ||  ($type1 == "Work")
      || ($type1 == "Mobile") || ($type1 == "Fax")
      || ($type1 == "Mobile") || ($type1 == "Other")){
      $ph_type = $_POST['ph_type'];
    }
  }
  if (isset($row['ph_number'])){
    $number = $row['ph_number'];
  } else if (isset($_POST['ph_number'])){
    $number = $_POST['ph_number'];
  }

  $we_type = "";
  $url = "";
  if (isset($row['we_type'])){
    $we_type = $row['we_type'];
  } else if (isset($_POST['we_type'])){
    $type1 = $_POST['we_type'];
    if (($type1 == "Personal") ||  ($type1 == "Work")
      || ($type1 == "LinkedIn") ||  ($type1 == "Facebook")
       || ($type1 == "Other")){
      $we_type = $_POST['we_type'];
    }
  }
  if (isset($row['we_url'])){
    $url = $row['we_url'];
  } else if (isset($_POST['we_url'])){
    $url = $_POST['we_url'];
  }


  $note = "";
  if (isset($row['no_note'])){
    $note = $row['no_note'];
  } else if (isset($_POST['no_note'])){
    $note = $_POST['no_note'];
  }

?>
<h3>Edit Contact Information</h3>
<br /><b>Notice</b>:  Undefined variable: line1 in <b>C:\xampp\htdocs\Project_2\includes\formEditContact.php</b> on line <b>257</b><br />
<!-- <?php
  echo "<pre>\n";
  print_r($row);
  echo "</pre>\n";
?> -->
<p>Change contact information as needed<br>
   Press the 'Save' button when complete</p>
<br>
<form method="POST" >
  <table>
    <!-- // name fields -->
	<tr><td><label for="ct_first_name">First Name</label></td>
		<td><input type="text" name="ct_first_name" id="ct_first_name" size="50" maxlength="100" value="<?php echo $fname; ?>"></td>
	</tr>
	<tr><td><label for="ct_last_name">Last Name</label></td>
		<td><input type="text" name="ct_last_name" id="ct_last_name" size="50" maxlength="100" value="<?php echo $lname; ?>"></td>
	</tr>
<!-- <?php if ($_SESSION['ct_type'] == "Business"){ ?>
	<tr><td><label for="ct_disp_name">Business Name</label></td>
<?php } else{ ?> -->
	<tr><td><label for="ct_disp_name">Display Name</label></td>
<!-- <?php } ?> -->
		<td><input type="text" name="ct_disp_name" id="ct_disp_name" size="50" maxlength="200" value="<?php echo $dname; ?>"></td>
	</tr>
<!-- // contact type fields -->
		<tr><td><label for="ct_type">Contact Type:</label></td>
			<td><select id="ct_type" name="ct_type" size="1">
<?php if((strlen($ct_type) ==0) ){ ?>
				<option selected="selected" value="Choice">Select type</option>
<?php } else { ?>
				<option value="Choice">Select type</option>
<?php }
	  if ($ct_type == "Family"){ ?>
				<option selected="selected" value="Family">Family</option>
<?php } else { ?>
				<option value="Family">Family</option>
<?php }
	  if ($ct_type == "Friend"){ ?>
				<option selected="selected" value="Friend">Friend</option>
<?php } else { ?>
				<option value="Friend">Friend</option>
<?php }
	  if ($ct_type == "Business"){ ?>
				<option selected="selected" value="Business">Business</option>
<?php } else { ?>
				<option value="Business">Business</option>
<?php }
	  if ($ct_type == "Other"){ ?>
				<option selected="selected" value="Other">Other</option>
<?php } else { ?>
				<option value="Other">Other</option>
<?php } ?>
			</select></td>
		</tr>
<!-- // address fields -->
<tr><td><label for="ad_type">Address Type:</label></td>
<td><select id="ad_type" name="ad_type" size="1">
<?php if ($ad_type == ""){ ?>
    <option selected="selected" value="Choice">Choose Type</option>
<?php } else { ?>
    <option  value="Choice">Choose Type</option>
<?php }
if ($ad_type == "Home"){ ?>
    <option selected="selected" value="Home">Home</option>
<?php } else { ?>
    <option  value="Home">Home</option>
<?php }
if ($ad_type == "Work"){ ?>
    <option selected="selected" value="Work">Work</option>
<?php } else { ?>
    <option value="Work">Work</option>
<?php }
if ($ad_type == "Other"){ ?>
    <option selected="selected" value="Other">Other</option>
<?php } else { ?>
    <option value="Other">Other</option>
<?php } ?>
  </select>
</td>
</tr>
<tr><td><label for="ad_line_1">Address Line 1</label></td>
<td><input type="text" id="ad_line_1" name="ad_line_1" size="50" maxlength="100" value="<?php echo $line1; ?>"></td>
</tr>
<tr><td><label for="ad_line_2">Address Line 2</label></td>
<td><input type="text" id="ad_line_2" name="ad_line_2" size="50" maxlength="100" value="<?php echo $line2; ?>"></td>
</tr>
<tr><td><label for="ad_line_3">Address Line 3</label></td>
<td><input type="text" id="ad_line_3" name="ad_line_3" size="50" maxlength="100" value="<?php echo $line3; ?>"></td>
</tr>
<tr><td><label for="ad_city">City</label></td>
<td><input type="text" id="ad_city" name="ad_city" size="30" maxlength="50" value="<?php echo $city; ?>"></td>
</tr>
<tr><td><label for="ad_province">Province</label></td>
<td><input type="text" id="ad_province" name="ad_province" size="30" maxlength="50" value="<?php echo $province; ?>"></td>
</tr>
<tr><td><label for="ad_post_code">Post Code</label></td>
<td><input type="text" id="ad_post_code" name="ad_post_code" size="30" maxlength="50" value="<?php echo $postcode; ?>"></td>
</tr>
<tr><td><label for="ad_country">Country</label></td>
<td><input type="text" id="ad_country" name="ad_country" size="30" maxlength="50" value="<?php echo $country; ?>"></td>
</tr>
<!-- // phone number -->
<tr><td><label for="ph_type">Phone # Type:</label></td>
  <td><select id="ph_type" name="ph_type" size="1">
<?php if ($ph_type == ""){ ?>
      <option selected="selected" value="Choice">Choose Type</option>
<?php } else { ?>
      <option  value="Choice">Choose Type</option>
<?php }
  if ($ph_type == "Home"){ ?>
      <option selected="selected" value="Home">Home</option>
<?php } else { ?>
      <option  value="Home">Home</option>
<?php }
  if ($ph_type == "Work"){ ?>
      <option selected="selected" value="Work">Work</option>
<?php } else { ?>
      <option  value="Work">Work</option>
<?php }
  if ($ph_type == "Mobile"){ ?>
      <option selected="selected" value="Mobile">Mobile</option>
<?php } else { ?>
      <option value="Mobile">Mobile</option>
<?php }
  if ($ph_type == "Fax"){ ?>
      <option selected="selected" value="Fax">Fax</option>
<?php } else { ?>
      <option value="Fax">Fax</option>
<?php }
  if ($ph_type == "Other"){ ?>
      <option selected="selected" value="Other">Other</option>
<?php } else { ?>
      <option value="Other">Other</option>
<?php } ?>
    </select>
  </td>
</tr>
<tr><td><label for="ph_number">Phone Number</label></td>
  <td><input type="tel" id="ph_number" name="ph_number" size="50" maxlength="50" value="<?php echo $number; ?>"></td>
</tr>

<!-- // email fields -->
<tr><td><label for="em_type">Email Type:</label></td>
  <td><select id="em_type" name="em_type" size="1">
<?php if ($em_type == ""){ ?>
      <option selected="selected" value="Choice">Choose Type</option>
<?php } else { ?>
      <option  value="Choice">Choose Type</option>
<?php }
  if ($em_type == "Home"){ ?>
      <option selected="selected" value="Home">Home</option>
<?php } else { ?>
      <option  value="Home">Home</option>
<?php }
  if ($em_type == "Work"){ ?>
      <option selected="selected" value="Work">Work</option>
<?php } else { ?>
      <option value="Work">Work</option>
<?php }
  if ($em_type == "Other"){ ?>
      <option selected="selected" value="Other">Other</option>
<?php } else { ?>
      <option value="Other">Other</option>
<?php } ?>
    </select>
  </td>
</tr>
<tr><td><label for="em_email">Email Address</label></td>
  <td><input type="email" id="em_email" name="em_email" size="50" maxlength="50" value="<?php echo $email; ?>"></td>
</tr>

<!-- // website fields -->
<tr><td><label for="we_type">Web Site Type:</label></td>
  <td><select id="we_type" name="we_type" size="1">
<?php if ($we_type == ""){ ?>
      <option selected="selected" value="Choice">Choose Type</option>
<?php } else { ?>
      <option  value="Choice">Choose Type</option>
<?php }
  if ($we_type == "Personal"){ ?>
      <option selected="selected" value="Personal">Personal</option>
<?php } else { ?>
      <option  value="Personal">Personal</option>
<?php }
  if ($we_type == "Work"){ ?>
      <option selected="selected" value="Work">Work</option>
<?php } else { ?>
      <option value="Work">Work</option>
<?php }
  if ($we_type == "LinkedIn"){ ?>
      <option selected="selected" value="LinkedIn">LinkedIn</option>
<?php } else { ?>
      <option value="LinkedIn">LinkedIn</option>
<?php }
  if ($we_type == "FaceBook"){ ?>
      <option selected="selected" value="Facebook">Facebook</option>
<?php } else { ?>
      <option value="Facebook">Facebook</option>
<?php }
  if ($we_type == "Other"){ ?>
      <option selected="selected" value="Other">Other</option>
<?php } else { ?>
      <option value="Other">Other</option>
<?php } ?>
    </select>
  </td>
</tr>
<tr><td><label for="we_url">Web Site URL</label></td>
  <td><input type="url" id="we_url" name="we_url" size="50" maxlength="50" value="<?php echo $url; ?>"></td>
</tr>

<!-- // contact note fields -->
<tr><td><label for="no_note">Note</label></td>
  <td><textarea id="no_note" name="no_note" rows="10" cols="50" maxlength="65530" ><?php echo $note; ?></textarea></td>
</tr>
</table>
<table>
<tr>
  <td><input type="submit" name="ct_b_back" value="Back"></td>
  <td><input type="submit" name="ct_b_save" value="Save"></td>
</tr>
<tr>
<td><input type="submit" name="ct_b_cancel" value="Cancel"></td>
</tr>
</table>
</form>
<?php } ?>
<?php
function updateContact(){
  $db_conn = dbconnect('localhost', 'week7', 'spencer', 'Mirr0r!');
  $id = $_SESSION['id'];
	$qry_ct = "UPDATE contact SET ct_type='".$_POST['ct_type']."'";
	if (isset($_POST['ct_first_name'])){
		$qry_ct .= ", ct_first_name='".$_POST['ct_first_name']."'";
	} else {
		$qry_ct .= ", ct_first_name=''";
	}
	if (isset($_POST['ct_last_name'])){
		$qry_ct .= ", ct_last_name='".$_POST['ct_last_name']."'";
	} else {
		$qry_ct .= ", ct_last_name=''";
	}
	if (isset($_POST['ct_disp_name'])){
		$qry_ct .= ", ct_disp_name='".$_POST['ct_disp_name']."'";
	} else {
		$qry_ct .= ", ct_disp_name=''";
	}
	$qry_ct .= ", ct_deleted='N'";
  $qry_ct .= " WHERE ct_id = ".$id.";";
	$db_conn->query($qry_ct);

	if (isset($_POST['ad_type'])){
		$qry_ad = "UPDATE contact_address SET ad_type='".$_POST['ad_type']."'";
		if (isset($_POST['ad_line_1'])){
			$qry_ad .= ", ad_line_1='".$_POST['ad_line_1']."'";
		} else {
			$qry_ad .= ", ad_line_1=''";
		}
		if (isset($_POST['ad_line_2'])){
			$qry_ad .= ", ad_line_2='".$_POST['ad_line_2']."'";
		} else {
			$qry_ad .= ", ad_line_2=''";
		}
		if (isset($_POST['ad_line_3'])){
			$qry_ad .= ", ad_line_3='".$_POST['ad_line_3']."'";
		} else {
			$qry_ad .= ", ad_line_3=''";
		}
		if (isset($_POST['ad_city'])){
			$qry_ad .= ", ad_city='".$_POST['ad_city']."'";
		} else {
			$qry_ad .= ", ad_city=''";
		}
		if (isset($_POST['ad_province'])){
			$qry_ad .= ", ad_province='".$_POST['ad_province']."'";
		} else {
			$qry_ad .= ", ad_province=''";
		}
		if (isset($_POST['ad_post_code'])){
			$qry_ad .= ", ad_post_code='".$_POST['ad_post_code']."'";
		} else {
			$qry_ad .= ", ad_post_code=''";
		}
		if (isset($_POST['ad_contry'])){
			$qry_ad .= ", ad_country='".$_POST['ad_country']."'";
		} else {
			$qry_ad .= ", ad_country=''";
		}
		$qry_ad .= ", ad_active='Y'";
    $qry_ad .= " WHERE ad_ct_id = ".$id.";";
		$db_conn->query($qry_ad);
	}
	if (isset($_POST['ph_type'])){
		$qry_ph = "UPDATE contact_phone SET ph_ct_id='".$id."'";
		$qry_ph .= ", ph_type='".$_POST['ph_type']."'";
		if (isset($_POST['ph_number'])){
			$qry_ph .= ", ph_number='".$_POST['ph_number']."'";
		} else {
			$qry_ph .= ", ph_number=''";
		}
		$qry_ph .= ", ph_active='Y';";
		$db_conn->query($qry_ph);
	}
	if (isset($_POST['em_type'])){
		$qry_em = "UPDATE contact_email SET em_ct_id='".$id."'";
		$qry_em .= ", em_type='".$_POST['em_type']."'";
		if (isset($_POST['em_email'])){
			$qry_em .= ", em_email='".$_POST['em_email']."'";
		} else {
			$qry_em .= ", em_email=''";
		}
		$qry_em .= ", em_active='Y'";
    $qry_ad .= " WHERE ad_ct_id = ".$id.";";
		$db_conn->query($qry_em);
	}
	if (isset($_POST['we_type'])){
		$qry_we = "UPDATE contact_web SET we_ct_id='".$id."'";
		$qry_we .= ", we_type='".$_POST['we_type']."'";
		if (isset($_POST['we_url'])){
			$qry_we .= ", we_url='".$_POST['we_url']."'";
		} else {
			$qry_we .= ", we_url=''";
		}
		$qry_we .= ", we_active='Y'";
    $qry_ad .= " WHERE ad_ct_id = ".$id.";";
		$db_conn->query($qry_we);
	}
	if (isset($_POST['no_note'])){
		$qry_no = "UPDATE contact_note SET no_ct_id='".$id."'";
		$qry_no .= ", no_type=''";
		$qry_no .= ", no_note='".$_POST['no_note']."'";
    $qry_ad .= " WHERE ad_ct_id = ".$id.";";
		$db_conn->query($qry_no);
	}
}
?>
