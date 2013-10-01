<script type="text/javascript" src="<?php echo base_url();?>/js/common.js"></script>

<?php 
				$i_limit=1;
				if($count>0)
				{	$num=$numEscTeachers-$count;
				$i_limit=$count+1;;
				}
				else 
					$num=$numEscTeachers;
					
				if($num>0)
				{
					?>
                    <table width="100%" align="center" border="0" class="heading_tab">
                    
                    <?php if($count==0){
					?>
					
					
					<tr style="border-bottom:1px solid #AEAEAE;">
					  <th align="left" width="2%"><span class="style1">Slno</span></th>
					  <th align="left"  width="2%"><span class="style1">Teacher Name</span></th>
                      <th align="left"  width="3%"><span class="style1">Designation</span></th>
                   	  <th align="left"  width="4%"><span class="style1">Phone</span></th>
					
					</tr>
                    
					<?php
					}
					
					for($i=$i_limit;$i<=$numEscTeachers;$i++)
					{
						if($i%2==0)$class="  ";
						else $class=" class='alt' ";
						
					?>
						
						<tr >
						<td align="left"  width="2%"><?php echo $i ?></td>
						<td align="left"  width="14%"><input class="inputbox" type="text" id="escorting_teacher_name[<?php echo $i; ?>]"  name="escorting_teacher_name[<?php echo $i; ?>]"   onkeypress="javascript:return toUppercase(event,this)" ></td>
                        <td align="left"  width="10%">
                        <select  size=1 name="<?php echo "designation[".$i."]"; ?>" id="<?php echo "designation[".$i."]"; ?>" >
						<option value=0 >Designation</option>
						<?php
					
						foreach($designations as $row=>$values)
						{
						?>
						<option value="<?php echo $values['designation_code']; ?>" ><?php echo $values['designation']; ?></option>
						<?php
                        }
						?>
					    </select>
                        
						</td>
                      	<td align="left"  width="34%">
						<input  class="inputbox" type="text" name="escorting_teacher_phone[<?php echo $i; ?>]" id="escorting_teacher_phone[<?php echo $i; ?>]" onkeypress="javascript:return numbersonly(this, event, false);" >
						</td>
					  </tr>
						
						
					<?php
					}
					?>
				</table>
                    <?php
				}


				?>