
<div align="center" class="heading_gray">
<h3>Participantion Certificate Participant Wise</h3>
</div>
<br/>
<div class="container">
<?php echo form_open('certificate/certificate/get_attended_certificate_pdf_participant_wise', array('id' => 'formIRL', 'name' => 'formIRL'));
?>
<div id="content_id">
<?php $this->load->view('certificate/participant_item_details'); ?>
</div>
<?php
//itemwise_report_interface
echo form_close();
?>
</div>