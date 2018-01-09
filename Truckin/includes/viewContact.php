<?php
function viewContact($db_conn){
  $qry = 'SELECT * FROM contact';
  $qry .= ' LEFT JOIN contact_address ON ct_id = ad_ct_id';
  $qry .= ' LEFT JOIN contact_phone ON ct_id = ph_ct_id';
  $qry .= ' LEFT JOIN contact_email ON ct_id = em_ct_id';
  $qry .= ' LEFT JOIN contact_web ON ct_id = we_ct_id';
  $qry .= ' LEFT JOIN contact_note ON ct_id = no_ct_id';
  $qry .= ' WHERE ct_id ='.$_POST['list_select'][0];
  $qry .= ' GROUP BY ct_id;';
	if ($rs = $db_conn->query($qry)){
?>
	<table border="1" style="padding:3px; width:50%;">
	   <tr><th>First Name</th><th>Last Name</th><th>Display Name</th><th>Type</th></tr>
  <?php $row = $rs->fetch_assoc() ?>
    <tr>
			<td style="background-color:lightgrey"><?php echo $row['ct_first_name']; ?></td>
			<td style="background-color:lightgrey"><?php echo $row['ct_last_name']; ?></td>
      <td style="background-color:lightgrey"><?php echo $row['ct_disp_name']; ?></td>
      <td style="background-color:lightgrey"><?php echo $row['ct_type']; ?></td>
		</tr>
    <tr height="8px"></tr>
    <tr><th>Address Line 1</th><th>Address Line 2</th><th>Address Line 3</th></tr>
    <tr>
      <td style="background-color:lightgrey"><?php echo $row['ad_line_1']; ?></td>
      <td style="background-color:lightgrey"><?php echo $row['ad_line_2']; ?></td>
      <td style="background-color:lightgrey"><?php echo $row['ad_line_3']; ?></td>
    </tr>
    <tr><th>City</th><th>Province</th><th>Postal Code</th><th>Country</th></tr>
    <tr>
      <td style="background-color:lightgrey"><?php echo $row['ad_city']; ?></td>
      <td style="background-color:lightgrey"><?php echo $row['ad_province']; ?></td>
      <td style="background-color:lightgrey"><?php echo $row['ad_post_code']; ?></td>
      <td style="background-color:lightgrey"><?php echo $row['ad_country']; ?></td>
    </tr>
    <tr height="8px"></tr>
    <tr><th>Email</th><th>Email Type</th></tr>
    <tr>
      <td style="background-color:lightgrey"><?php echo $row['em_email']; ?></td>
      <td style="background-color:lightgrey"><?php echo $row['em_type']; ?></td>
    </tr>
    <tr><th>Phone</th><th>Phone Type</th></tr>
    <tr>
      <td style="background-color:lightgrey"><?php echo $row['ph_number']; ?></td>
      <td style="background-color:lightgrey"><?php echo $row['ph_type']; ?></td>
    </tr>
    <tr><th>Website</th><th>Website Type</th></tr>
    <tr>
      <td style="background-color:lightgrey"><?php echo $row['we_url']; ?></td>
      <td style="background-color:lightgrey"><?php echo $row['we_type']; ?></td>
    </tr>
    <tr height="8px"></tr>

    <tr><th colspan="4">Note</th></tr>
    <tr>
      <td colspan="4" style="background-color:lightgrey"><?php echo $row['no_note']; ?></td>
    </tr>
  </table>
  <?php
  } else {
    printf("Errormessage: %s\n", $db_conn->error);
  }
  ?>
  <form method="POST" >
    <input type="submit" name="ct_b_back" value="Back" style="margin:10px 3px">
  </form>
<?php
  }
?>
