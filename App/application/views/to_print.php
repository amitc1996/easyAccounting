<style type="text/css" media="print">
   body *{display:none}
   iframe{display:block}
   </style>
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
    <div class="row">
    <div class="col-xs-12">
<iframe style="width: 100%;height: 950px;" src="<?php echo base_url($file_path); ?>"></iframe>
</div>
</div>
</section>
</div>
<script>
$(document).ready(function(){
 window.frames[0].print();
});
</script>
