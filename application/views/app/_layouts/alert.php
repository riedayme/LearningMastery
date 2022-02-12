<?php  
if ($this->session->flashdata('message')) {
  if ($this->session->flashdata('message') == TRUE) {
    ?>

	<!-- alert-automatic -->
    <div class="c-alert c-alert--<?php echo $this->session->flashdata('message_type') ?>">
      <?php echo $this->session->flashdata('message_text') ?>     
    </div>

    <?php
  }
}
?>