<?php
$wherehouse_options = array(''=>'--Select--');
if($wherehouses && count($wherehouses)> 0)
{
  foreach($wherehouses as $val)
  {
    $wherehouse_options[$val['wherehouse_id']]= $val['wherehouse_name'];
  }
}
$wherehouses = array(
  'name'  => 'wherehouse',
  'id'  => 'wherehouse',
  'value' => set_value('wherehouse'),
  'class'=>'form-control item_row',
  'data-parsley-required'=>'true',
);

$products_options = array(''=>'--Select--');
if($products && count($products)> 0)
{
  foreach($products as $val)
  {
    $products_options[$val['product_id']]= $val['item_title'];
  }
}
$products = array(
  'name'  => 'product',
  'id'  => 'product',
  'value' => set_value('product'),
  'class'=>'form-control',
  'data-parsley-required'=>'true',
);

$stock = array(
  'name'  => 'stock',
  'id'  => 'stock',
  'value' => set_value('stock',0),
  'class'=>'form-control',
  'type'=>'number',
  'placeholder'=>'Stock',
  'min'=>'0',
);
$csrf = array(
  'name' => $this->security->get_csrf_token_name(),
  'hash' => $this->security->get_csrf_hash()
);
?>
<div class="content-wrapper" style="min-height: 916px;">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1 class="pull-left">
      <?php echo $title; ?>

    </h1>
    <div class="pull-right" >
      <a href="#" class="btn btn-custom" title="Add Product" data-toggle="modal" data-target="#add_stock" ><span class="glyphicon glyphicon-plus-sign " style="margin-right: 5px;"></span>Back</a>
    </div>
    <div class="clearfix"></div>
  </section>
  <!-- Main content -->
  <section class="content">
    <!-- Small boxes (Stat box) -->
    <div id="alert_area">
    </div>
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-danger">
          <div class="box-body">
            <table id="stocks_listing" class="table table-bordered table-striped table-condensed">
              <thead>
                <tr>
                  <th>Wherehouse name</th>
                  <th>Product name</th>
                  <th>Stocks</th>
                  <th class="actions">Actions</th>
                </tr>
              </thead>
            </table>
          </div><!-- /.box-body -->
        </div>
      </div>
    </div>
  </section><!-- /.content -->
</div>


