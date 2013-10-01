<style type="text/css">

.style9 {
	font-size:36px;
	font-weight: bold;
}
</style>
<page backtop='2mm' backbottom='0mm'>
<?php
$i=0;
$count = 1;
$printNo_perpage = $print_no;
$limit = $printNo_perpage - 1;
	if($printNo_perpage == 8)
	{$width = 150;
	}
	elseif($printNo_perpage == 6)
	{$width = 200;}
	elseif($printNo_perpage == 4)
	{$width = 350;}
	
for($i = 0; $i < count($fees_details);)
{
	$condition = 0;
	if($fair != 4)
	{
		if( @$fees_details[$i]['is_captain']=='Y' && @$fees_details[$i]['is_absent']== 0)
		{$condition = 1;	}
		if(@$fees_details[$i]['is_captain']=='Y' && @$fees_details[$i]['is_absent']== 1)
		{$condition = 0;	}
	}
	elseif($fair == 4)
	{ 
		if(@$fees_details[$i]['is_captain']=='Y')
		$condition = 1;
	}
	if(@$condition == 1){
		
		if($count >= $printNo_perpage)
		{	$count = 1;
		}
		
		if($count < $limit)
		{
			 $style = " border-bottom:1px #666666; font_size:36px;";
			 $style2 = "border-right:1px #666666; border-bottom:1px #666666;padding:2px;";
		}
		else
		{
			 $style = "font_size:36px;";
			 $style2 = "border-right:1px #666666;";
		}
?>
<!--<page backtop="2mm" backbottom="0mm">
--><table align="left" border="0" width="700" height=400 style="height:400;">

    <tr class="style9">
        <td width="500" style=" <?php echo $style;?>"  height=<?php echo $width;?> align="center">
        <?php
		if($fair != 4)
		{
			if( @$fees_details[$i]['is_captain']=='Y' && @$fees_details[$i]['is_absent']== 0)
			{	$condition = 1;		}
			else
				$condition = 0;
		}
		elseif($fair == 4)
		{ 
			if( @$fees_details[$i]['is_captain']=='Y')
			$condition = 1;
		}
		if($condition == 1)
		{
		?>
        <h1>
            <?php 
			echo @$fees_details[$i]['prefixCode'].@$fees_details[$i]['codeNo'];
			$i++;
			$count++;
            ?>
          </h1>
          <?php
		}
		?>
        </td>
    <td style=" <?php echo $style2;?>">&nbsp;</td>
     <td width="500" style=" <?php echo $style;?>" height=<?php echo $width;?> align="center">
      <?php
		if($fair != 4)
		{
			if(@$fees_details[$i]['is_captain']=='Y' && @$fees_details[$i]['is_absent']== 0)
			{	$condition = 1;		}
			else
				$condition = 0;
		}
		elseif($fair == 4)
		{ 
			if(@$fees_details[$i]['is_captain']=='Y')
			$condition = 1;
		}
		if($condition == 1)
		{
		?>
            <h1>  <?php 
			echo @$fees_details[$i]['prefixCode'].@$fees_details[$i]['codeNo'];
			$i++;
			$count++;
            ?>
            </h1>
              <?php
		}
		?>
        </td>
     
    </tr>
       
 
  </table>
  <!--</page>-->

<?php
	}//if
	else
	{
		$i++;
	}
}//for
?>
</page>
     
  
