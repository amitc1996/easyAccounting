<?php 
 $permissions= getUserPermissions();
 ?>
<style type="text/css">
    .nav-pills>li.active>a, .nav-pills>li.active>a:focus, .nav-pills>li.active>a:hover {
    color: #fff;
    background-color: #6da252;
}
.nav-stacked > li.active > a, .nav-stacked > li.active > a:hover {
    border-top: 0;
    border-left-color: #444444;
}
</style>
     <div class="col-xs-2">
        <div class="box box-solid">
          <?php  if(in_array(strtolower('company_index'),$permissions)){?>    
        <div class="box-header with-border">
        <h3 class="box-title">Company</h3>
        </div>
        <div class="box-body no-padding">
        <ul class="nav nav-pills nav-stacked">          
        <li class="<?php if($this->uri->segment(1)=='company' )echo  'active'?>">
        <a href="<?php echo site_url('company'); ?>"><i class="fa fa-building-o"></i>Company</a></li>
        </ul>
        </div>
        <?php }?>
        <div class="box-header with-border">
        <h3 class="box-title">Gernal</h3>
        </div>
        <div class="box-body no-padding">
        <ul class="nav nav-pills nav-stacked">
             <?php  if(in_array(strtolower('categories_index'),$permissions)){?>
        <li class="<?php if($this->uri->segment(1)=='categories' )echo  'active'?>">
        <a href="<?php echo site_url('categories'); ?>"><i class="fa fa fa-list"></i> Cateogries</a></li>
         <?php } if(in_array(strtolower('measurements_index'),$permissions)){?>
        <li class="<?php if($this->uri->segment(1)=='measurements' )echo  'active'?>">
        <a href="<?php echo site_url('measurements'); ?>"><i class="fa fa-dot-circle-o"></i>Units</a></li>
         <?php } if(in_array(strtolower('brands_index'),$permissions)){?>
       <li class="<?php if($this->uri->segment(1)=='brands' )echo  'active'?>">
        <a href="<?php echo site_url('brands'); ?>"><i class="fa fa-bolt"></i> Brand</a></li>
         <?php } if(in_array(strtolower('taxes_index'),$permissions)){?>
        <li class="<?php if($this->uri->segment(1)=='taxes' )echo  'active'?>">
        <a href="<?php echo site_url('taxes'); ?>"><i class="fa fa-percent"></i>Taxes</a></li>
         <?php } if(in_array(strtolower('discounts_index'),$permissions)){?>
        <li class="<?php if($this->uri->segment(1)=='discounts' )echo  'active'?>"><a href="<?php echo site_url('discounts'); ?>"><i class="fa fa-percent"></i>Discounts</a></li>
        <?php } if(in_array(strtolower('currencies_index'),$permissions)){?>
        <li class="<?php if($this->uri->segment(1)=='currencies' )echo  'active'?>"><a href="<?php echo site_url('currencies'); ?>"><i class="fa fa-btc"></i>Currencies</a></li>
         <?php } if(in_array(strtolower('wherehouses_index'),$permissions)){?>
        <li class="<?php if($this->uri->segment(1)=='wherehouses' )echo  'active'?>"><a href="<?php echo site_url('wherehouses'); ?>"><i class="fa fa-bank"></i>Wherehouses</a></li>
          <?php } if(in_array(strtolower('branches_index'),$permissions)){?>
        <li class="<?php if($this->uri->segment(1)=='branches' )echo  'active'?>"><a href="<?php echo site_url('branches'); ?>"><i class="fa fa-bank"></i>Branches</a></li>
         <?php }?>
        </ul>
        </div>
        <!-- /.box-body -->
        </div>
      </div>

           