<?php $__env->startSection('menu'); ?>
    <!-- [ Layout sidenav ] Start -->
    <div id="layout-sidenav" class="layout-sidenav sidenav sidenav-vertical bg-dark">
        <!-- Brand demo (see assets/css/demo/demo.css) -->
        <div class="app-brand demo">
            <span class="app-brand-logo demo">
                <img src="<?php echo e(URL::to('assets/img/logo-thumb.png')); ?>" alt="Brand Logo" class="img-fluid">
            </span>
            <a href="<?php echo e(route('home')); ?>" class="app-brand-text demo sidenav-text font-weight-normal ml-2"><?php echo e(Auth::user()->name); ?></a>
            <a href="javascript:" class="layout-sidenav-toggle sidenav-link text-large ml-auto">
                <i class="ion ion-md-menu align-middle"></i>
            </a>
        </div>
        <div class="sidenav-divider mt-0"></div>

        <!-- Links -->
        <ul class="sidenav-inner py-1">

            <!-- Dashboards -->
            <li class="sidenav-item">
                <a href="<?php echo e(route('home')); ?>" class="sidenav-link">
                    <i class="sidenav-icon feather icon-home"></i>
                    <div>Dashboards</div>
                    <?php if(Auth::user()->role_name == 'Admin'): ?>
                    <div class="pl-1 ml-auto">
                        <div class="badge badge-success"><?php echo e(Auth::user()->role_name); ?></div>
                    </div>
                    <?php endif; ?>
                    <?php if(Auth::user()->role_name == 'Normal User'): ?>
                    <div class="pl-1 ml-auto">
                        <div class="badge badge-danger"><?php echo e(Auth::user()->role_name); ?></div>
                    </div>
                    <?php endif; ?>
                    <?php if(Auth::user()->role_name == null): ?>
                    <div class="pl-1 ml-auto">
                        <div class="badge badge-warning"><?php echo e(Auth::user()->role_name); ?> <?php echo e('[N/A]'); ?></div>
                    </div>
                    <?php endif; ?>
                </a>
            </li>

            <!-- Layouts -->
            <li class="sidenav-divider mb-1"></li>
            <li class="sidenav-header small font-weight-semibold">Menu</li>

            <!-- UI elements -->
            <?php if(Auth::user()->role_name == 'Admin'): ?>
            <li class="sidenav-item">
                <a href="javascript:" class="sidenav-link sidenav-toggle">
                    <i class="sidenav-icon fa fa-user"></i>
                    <div>User Management</div>
                </a>
                <ul class="sidenav-menu">
                    <li class="sidenav-item">
                        <a href="<?php echo e(route('role/user/view')); ?>" class="sidenav-link">
                            <div>User Role</div>
                        </a>
                    </li>

                    <li class="sidenav-item">
                        <a href="bui_progress.html" class="sidenav-link">
                            <div>Maintanain user</div>
                        </a>
                    </li>
                </ul>
            </li>
            <?php endif; ?>
           <!-- Forms -->
           <li class="sidenav-item">
                <a href="javascript:" class="sidenav-link sidenav-toggle">
                    <i class="sidenav-icon feather icon-clipboard"></i>
                    <div>Forms</div>
                </a>
                <ul class="sidenav-menu">
                    <li class="sidenav-item">
                        <a href="<?php echo e(route('form/new')); ?>" class="sidenav-link">
                            <div>User Infomation</div>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Report -->
            <li class="sidenav-item active open">
                <a href="javascript:" class="sidenav-link sidenav-toggle">
                    <i class="sidenav-icon feather icon-file-minus"></i>
                    <div>Report</div>
                </a>
                <ul class="sidenav-menu">
                    <li class="sidenav-item active">
                        <a href="<?php echo e(route('form/view/report')); ?>" class="sidenav-link">
                            <div>Report Data</div>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
    <!-- [ Layout sidenav ] End -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('style'); ?>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.7/css/responsive.bootstrap4.min.css">
    <style>
        /* close icon */
        .close:focus, .close:hover {
            color: rgb(255, 0, 0) ;
            text-decoration: none;
            opacity: .75;
            outline: none !important;
        }
        .close {
            font-size: 45px !important;
            margin-top: 5px !important;
        }
    </style>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<!-- [ Layout content ] Start -->
<div class="layout-content">
    <!-- [ content ] Start -->
    <div class="container-fluid flex-grow-1 container-p-y">
        <h4 class="font-weight-bold py-3 mb-0">Report / Data</h4>
        <div class="text-muted small mt-0 mb-4 d-block breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>"><i class="feather icon-home"></i></a></li>
                <li class="breadcrumb-item">Report</li>
                <li class="breadcrumb-item active">Data Information</li>
            </ol>
        </div>

         <!-- [ content ] End -->

        <?php if(\Session::has('update')): ?>
            <div id="hide-message" class="alert alert-dark-success alert-dismissible fade show" style="width: 25%;">
                <i class="feather icon-check-circle" style="font-size:1em"></i>
                <?php echo \Session::get('update'); ?>

            </div>
        <?php endif; ?>

        <div class="card mb-4">
            <h6 class="card-header"><i class="feather icon-user"></i> List User</h6>
            <div class="card-body">
                <table id="example" class="table table-striped table-bordered nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Full Name</th>
                            <th>Company Name</th>
                            <th>Email Address</th>
                            <th>Gender</th>
                            <th>Country</th>
                            <th>Phone Number</th>
                            <th>Notes</th>
                            
                            <th>Modify</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td class="id"><?php echo e($item->rec_id); ?></td>
                                <td class="id"><?php echo e($item->name); ?></td>
                                <td class="id"><?php echo e($item->company); ?></td>
                                <td class="id"><?php echo e($item->email); ?></td>
                                <td class="id"><?php echo e($item->sex); ?></td>
                                <td class="id"><?php echo e($item->country); ?></td>
                                <td class="id"><?php echo e($item->phone); ?></td>
                                <td class="id"><?php echo e($item->notes); ?></td>
                                
                                <td class="text-center">
                                    <a href="<?php echo e(url('form/view/update/'.$item->id)); ?>" class="m-r-15 text-muted userUpdate">
                                        <i class="fa fa-edit" style="color: #2196f3;"></i>
                                    </a>
                                    <a href="<?php echo e(url('form/delete/'.$item->id)); ?>" onclick="return confirm('Are you sure to want to delete it?')"><i class="fa fa-trash" style="color: red;"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <!-- [ Layout footer ] Start -->
    <nav class="layout-footer footer bg-white">
        <div class="container-fluid d-flex flex-wrap justify-content-between text-center container-p-x pb-3">
            <div class="pt-3">
                <span class="footer-text font-weight-semibold">&copy; <a href="https://innoworx.site/" class="footer-link" target="_blank">INNOWORX</a></span>
            </div>
            <div>
                <a href="javascript:" class="footer-link pt-3">About Us</a>
                <a href="javascript:" class="footer-link pt-3 ml-4">Help</a>
                <a href="javascript:" class="footer-link pt-3 ml-4">Contact</a>
                <a href="javascript:" class="footer-link pt-3 ml-4">Terms &amp; Conditions</a>
            </div>
        </div>
    </nav>
    <!-- [ Layout footer ] End -->
</div>

<!-- Modal View-->
<div class="modal fade" id="UserView" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">View Detial</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="registration" action="" method = "post"><!-- form add -->
                    <?php echo e(csrf_field()); ?>

                    <input type="hidden" class="form-control" id="v_id" name="id" value=""/>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Full Name</label>
                            <div class="col-sm-9">
                                <input type="text" id="v_name"name="name" class="form-control" value=""/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Email Address</label>
                            <div class="col-sm-9">
                                <input type="text" id="v_email"name="email" class="form-control" value=""/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Phone Number</label>
                            <div class="col-sm-9">
                                <input type="tel" id="v_phone_number"name="mobile" class="form-control" value=""/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Group ID</label>
                            <div class="col-sm-9">
                                <input type="text" id="v_groupid"name="groupid" class="form-control" value=""/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Role Name</label>
                            <div class="col-sm-9">
                                <input type="text" id="v_role_name"name="role_name" class="form-control" value=""/>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- form add end -->
            </div>
            <div class="modal-footer">
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="icofont icofont-eye-alt"></i>Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Modal View-->

<!-- Modal Update-->
<div class="modal fade" id="UserUpdate" tabindex="-1" aria-labelledby="update" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="update">Update</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="registration" action="<?php echo e(route('role/user/update')); ?>" method = "post"><!-- form add -->
                <?php echo e(csrf_field()); ?>

                <div class="modal-body">

                    <input type="hidden" class="form-control" id="e_id" name="id" value=""/>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Full Name</label>
                            <div class="col-sm-9">
                                <input type="text" id="e_name" name="name" class="form-control" value="" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Email Address</label>
                            <div class="col-sm-9">
                                <input type="text" id="e_email" name="email" class="form-control" value="" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Phone Number</label>
                            <div class="col-sm-9">
                                <input type="tel" id="e_phone_number" name="phone_number" class="form-control" value="" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Group ID</label>
                            <div class="col-sm-9">
                                <input type="text" id="e_groupid" name="groupid" class="form-control" value="" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Role Name</label>
                            <div class="col-sm-9">
                                <input type="text" id="e_role_name" name="role_name" class="form-control" value="" />
                            </div>
                        </div>
                    </div>
                    <!-- form add end -->
                </div>
                <div class="modal-footer">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="icofont icofont-eye-alt"></i>Close</button>
                        <button type="submit" id=""name="" class="btn btn-success  waves-light"><i class="icofont icofont-check-circled"></i>Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Modal Update-->


<!-- [ Layout content ] Start -->
<?php $__env->startSection('script'); ?>
<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.7/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.7/js/responsive.bootstrap4.min.js"></script>


<script>

    $('#hide-message').show();
    setTimeout(function()
    {
        $('#hide-message').hide();
    },5000);

</script>




<script>
$(document).ready(function() {
  $('#example').DataTable({
    responsive: {
      details: {
        renderer: function(api, rowIdx, columns) {
          var data = $.map(columns, function(col, i) {
            if (col.hidden) {
              return '<tr data-dt-row="' + col.rowIndex + '" data-dt-column="' + col.columnIndex + '">' +
                '<td>' + col.title + ':' + '</td> ' +
                '<td>' + col.data + '</td>' +
                '</tr>';
            } else {
              return '';
            }
          }).join('');

          if (data) {
            return $('<table/>').append(data);
          } else {
            return false;
          }
        }
      }
    },
    columnDefs: [{
      targets: '_all',
      render: function(data, type, row, meta) {
        if (type === 'display' && data != null) {
          var words = data.split(' ');
          var result = '';
          var formattedData = data.replace(/\s/g, '');
          for (var i = 0; i < words.length; i++) {
            result += words[i] + ' ';
            if ((i + 1) % 8 === 0) {
              result += '<br>';
            }

          }

          return result.trim();

        } else {
          return data;
        }
      }
    }]
  });
});

  </script>

<?php $__env->stopSection(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\work\expo\resources\views/report/report.blade.php ENDPATH**/ ?>