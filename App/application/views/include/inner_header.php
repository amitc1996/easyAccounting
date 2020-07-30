
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title><?php echo $title; ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <!-- bootstrap.css -->
  <link href="<?php echo base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet" type="text/css" />
  <!-- font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url('assets/font-awesome/css/font-awesome.min.css');?>">

  <!-- Datatable style -->
  <link href="<?php echo base_url('assets/css/dataTables.bootstrap.css') ?>" rel="stylesheet" type="text/css" />
  <!--Jquery-ui.css-->
  <link href="<?php echo base_url('assets/css/jquery-ui.min.css') ?>" rel="stylesheet" type="text/css" />
  <link href="<?php echo base_url('assets/plugins/toastr/toastr.min.css') ?>" rel="stylesheet" type="text/css" />
  <link href="<?php echo base_url('assets/plugins/pace/pace.min.css') ?>" rel="stylesheet" type="text/css" />

  <!--Parsley.css-->
  <link href="<?php echo base_url('assets/css/parsley.css') ?>" rel="stylesheet" type="text/css" />
  <!-- Admin LTE Theme style -->
  <link href="<?php echo base_url('assets/css/AdminLTE.css') ?>" rel="stylesheet" type="text/css" />
  <link href="<?php echo base_url('assets/css/skins/skin-green.min.css') ?>" rel="stylesheet" type="text/css" />
  <!-- Custom style inner.css -->
  <link href="<?php echo base_url('assets/css/inner.css') ?>" rel="stylesheet" type="text/css" />
  <link href="<?php echo base_url('assets/css/custom.css') ?>" rel="stylesheet" type="text/css" />
  <!-- jquery 1.10.2 -->
<link rel="shortcut icon" href="<?php echo base_url('assets/img/logosm.png');?>">
   <script src="<?php echo base_url('assets/js/jquery.min.js')?>"></script>
  <script src="<?php echo base_url('assets/js/jquery-migrate-1.2.1.min.js')?>"></script>
  <script src="<?php echo base_url('assets/js/jquery-ui.min.js')?>"></script>
  <script src="<?php echo base_url('assets/js/parsley.min.js')?>"></script>
  <script src="<?php echo base_url('assets/plugins/toastr/toastr.min.js')?>"></script>
  <script src="<?php echo base_url('assets/plugins/pace/pace.min.js')?>"></script>
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>

<body id="myvideo" class="hold-transition skin-green fixed  sidebar-mini">
  <div class="wrapper">

    <header class="main-header">
      <!-- Logo -->
      <a href="<?php echo site_url('');?>" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><label for="" class="label label-primary">Am</label>
          
        </span>
        
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><label for="" class="label label-primary">Am</label> Enterprises
      </span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">

          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-user"></i>
              <?php echo htmlentities($admin_data['username']) ?>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header" >
                <p>
                  <?php echo htmlentities($admin_data['username']) ?>
                  <small>Last Login: <?php echo date('M-d-Y H:i:s', strtotime($admin_data['last_login'])) ?> </small>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="<?php echo site_url('settings');?>" class="btn btn-default btn-flat">Settings</a>
                </div>
                <div class="pull-right">
                  <a href="<?php echo site_url('auth/logout');?>" class="btn btn-default btn-flat">Logout</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>

  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
           <li class="<?php if($this->uri->segment(1)=='dashboard' || $this->uri->segment(1)=='')echo  'active'?>">
            <a href="<?php echo site_url('dashboard');?>">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span> </a>
            </li>
             <?php if(in_array(strtolower('clients_index'),$permissions)){?>
            <li class="<?php if($this->uri->segment(1)=='clients' )echo  'active'?>">
            <a href="<?php echo site_url('clients'); ?>">
              <i class="fa fa-user-circle-o"></i> <span>Clients</span> </a>
            </li>
             <?php } if(in_array(strtolower('suppliers_index'),$permissions)){?>  
            <li class="<?php if($this->uri->segment(1)=='suppliers' )echo  'active'?>">
            <a href="<?php echo site_url('suppliers'); ?>">
              <i class="fa fa-user-circle"></i> <span>Suppliers</span> </a>
            </li>
             <?php } if(in_array(strtolower('sales_index'),$permissions)){?>  
             <li class="<?php if(($this->uri->segment(1)=='sales' && $this->uri->segment(2)=='') || $this->uri->segment(1)=='')echo  'active'?>">
            <a href="<?php echo site_url('sales');?>">
              <i class="fa fa-shopping-cart"></i> <span>Sales</span></a>
            </li>
              <?php } if(in_array(strtolower('purchases_index'),$permissions)){?>  
            <li class="<?php if($this->uri->segment(1)=='purchases')echo  'active'?>">
              <a href="<?php echo site_url('purchases');?>">
                <i class="fa fa-truck"></i> <span>Purchases</span></a>
              </li>
              <?php } if(in_array(strtolower('products_index'),$permissions)){?>  
                  <li class="<?php if($this->uri->segment(1)=='products')echo  'active'?>">
                    <a href="<?php echo site_url('products');?>">
                    <i class="fa fa-product-hunt"></i> <span>Products</span></a>
                  </li>
               <?php } if(in_array(strtolower('stocks_index'),$permissions)){?>    
                  <li class="<?php if($this->uri->segment(1)=='stocks')echo  'active'?>">
                    <a href="<?php echo site_url('stocks');?>">
                    <i class="fa fa-archive"></i> <span>Stocks</span></a>
                  </li>
                <?php }?>
                 <?php  if(in_array(strtolower('account_groups'),$permissions)||in_array(strtolower('ledgers_index'),$permissions)||in_array(strtolower('expenses_index'),$permissions)||in_array(strtolower('cash_flows_index'),$permissions)){?>
                  <li class="treeview <?php if($this->uri->segment(1)=='account_groups' || $this->uri->segment(1)=='ledgers'|| $this->uri->segment(1)=='cash_flows' || $this->uri->segment(1)=='expenses')echo  'active';?>">
                      <a href="#">
                        <i class="fa fa-line-chart"></i> <span>Finance</span> <i class="fa fa-angle-left pull-right"></i>
                      </a>
                  <ul class="treeview-menu">
                     <?php if(in_array(strtolower('account_groups_index'),$permissions)){?>    
                    <li class="<?php if($this->uri->segment(1)=='account_groups' && $this->uri->segment(2)=='')echo  'active'?>">
                        <a href="<?php echo site_url('account_groups'); ?>">
                            <i class="fa fa-copy"></i> <span>Account Groups</span>
                        </a>
                    </li>
                     <?php } if(in_array(strtolower('ledgers_index'),$permissions)){?>    
                    <li class="<?php if($this->uri->segment(1)=='ledgers' )echo  'active'?>">
                       <a href="<?php echo site_url('ledgers');?>">
                       <i class="fa fa-book"></i> <span>Ledgers</span>
                       </a>
                    </li>
                     <?php } if(in_array(strtolower('expenses_index'),$permissions)){?>    
                   <li class="<?php if($this->uri->segment(1)=='expenses' )echo  'active'?>">
                       <a href="<?php echo site_url('expenses');?>">
                       <i class="fa fa-sitemap"></i> <span>Expense</span>
                       </a>
                    </li>
                     <?php } if(in_array(strtolower('cash_flows_index'),$permissions)){?>    
                    <li class="<?php if($this->uri->segment(1)=='cash_flows' )echo  'active'?>">
                       <a href="<?php echo site_url('cash_flows');?>">
                       <i class="fa fa-money"></i> <span>Cash Flow</span>
                       </a>
                    </li>
                  <?php }?>
                    <!-- <li class="<?php if($this->uri->segment(1)=='menus' )echo  'active'?>">
                       <a href="<?php echo site_url('menus');?>">
                       <i class="fa fa-area-chart"></i> <span>Statement</span>
                       </a>
                    </li> -->
                  </ul>
                </li>
              <?php }?>
                 <?php  if(in_array(strtolower('payments_index'),$permissions)||in_array(strtolower('receipts_index'),$permissions)){?>
               <li class="treeview <?php if($this->uri->segment(1)=='payments' || $this->uri->segment(1)=='receipts')echo  'active';?>">
                <a href="#">
                  <i class="fa fa-exchange"></i> <span>Transactions</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                  <ul class="treeview-menu">
                     <?php if(in_array(strtolower('payments_index'),$permissions)){?>    
                    <li class="<?php if($this->uri->segment(1)=='payments')echo  'active'?>">
                        <a href="<?php echo site_url('payments'); ?>">
                            <i class="fa fa-money"></i> <span>Payments</span>
                        </a>
                    </li>
                     <?php } if(in_array(strtolower('receipts_index'),$permissions)){?>    
                    <li class="<?php if($this->uri->segment(1)=='receipts' )echo  'active'?>">
                       <a href="<?php echo site_url('receipts');?>">
                       <i class="fa fa-money"></i> <span>Receipt</span>
                       </a>
                    </li>
                    <?php }?>
                  </ul>
                </li>
              <?php }?>
               <!-- <li class="treeview <?php if($this->uri->segment(1)=='payments' || $this->uri->segment(1)=='receipts')echo  'active';?>">
                <a href="#">
                  <i class="fa fa-file"></i> <span>Reports</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                  <ul class="treeview-menu">
                    
                    <li class="<?php if($this->uri->segment(1)=='payments')echo  'active'?>">
                        <a href="<?php echo site_url('payments'); ?>">
                            <i class="fa fa-cubes"></i> <span>Stocks</span>
                        </a>
                    </li>

                    <li class="<?php if($this->uri->segment(1)=='payments')echo  'active'?>">
                        <a href="<?php echo site_url('payments'); ?>">
                            <i class="fa fa-money"></i> <span>Payable</span>
                        </a>
                    </li>
                   
                    <li class="<?php if($this->uri->segment(1)=='receipts' )echo  'active'?>">
                       <a href="<?php echo site_url('receipts');?>">
                       <i class="fa fa-money"></i> <span>Receivable</span>
                       </a>
                    </li>
                  
                  </ul>
                </li> -->
                    <li class="<?php if($this->uri->segment(1)=='company' )echo  'active'?>">
                  <a href="<?php echo site_url('company'); ?>">
                    <i class="fa fa-cogs"></i> <span>Company Settings</span> </a>
                  </li>
                      <?php if(in_array(strtolower('staff_index'),$permissions)){?>
                      <li class="header">USER MANAGEMENT</li>
                      <li class="<?php if($this->uri->segment(1)=='staff' )echo  'active'?>">
                        <a href="<?php echo site_url('staff'); ?>">
                          <i class="fa fa-user-plus"></i> <span>Staff</span> </a>
                        </li>
                         <?php } if(in_array(strtolower('groups_index'),$permissions)){?>  
                          <li class="<?php if($this->uri->segment(1)=='groups' )echo  'active'?>">
                            <a href="<?php echo site_url('groups'); ?>">
                              <i class="fa fa-code-fork"></i> <span>Groups</span> </a>
                            </li>
                            <?php } if(in_array(strtolower('permissions_index'),$permissions)){?> 
                            <li class="<?php if($this->uri->segment(1)=='permissions' )echo  'active'?>">
                              <a href="<?php echo site_url('permissions'); ?>">
                                <i class="fa fa-check-square"></i> <span>Permissions</span> </a>
                              </li>
                               <?php } ?>
                            <li class="header">ACCOUNT</li>
                            <li class="<?php if($this->uri->segment(1)=='settings')echo  'active'?>">
                              <a href="<?php echo site_url('settings');?>">
                                <i class="fa fa-cogs"></i><span>Settings</span>
                              </a>
                            </li>
                            <li>
                              <a href="<?php echo site_url('auth/logout')?>">
                                <i class="fa fa-power-off "></i> <span>Logout</span>
                              </a>
                            </li>
                          </ul>
                        </section>
                        <!-- /.sidebar -->
                      </aside>
