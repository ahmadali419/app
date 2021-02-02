

<?php $__env->startSection('content'); ?>

<div class="row page-titles mx-0">
    <div class="col p-md-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(URL::to('/admin/home')); ?>">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Subscription Request</a></li>
        </ol>
    </div>
</div>
<!-- row -->
<?php if(Session::has('message')): ?>
<div class="alert alert-success" role="alert">
    <h4 class="alert-heading">Dear User !!</h4><hr>
    <p><?php echo Session('message'); ?></p>
    </div>
<?php endif; ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">All Subcription Requests</h4>
                    <div class="table-responsive" id="table-display">
                        <?php echo $__env->make('theme.SubscriptionRequestsTable', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- #/ container -->
<?php $__env->stopSection(); ?>
<!--<?php $__env->startSection('script'); ?>-->
<!--<script type="text/javascript">-->
<!--    $('.table').dataTable({-->
<!--      aaSorting: [[0, 'DESC']]-->
<!--    });-->
<!--    function DeleteData(id) {-->
<!--        swal({-->
<!--            title: "Are you sure?",-->
<!--            text: "Do you want to delete this Order ?",-->
<!--            type: "warning",-->
<!--            showCancelButton: true,-->
<!--            confirmButtonClass: "btn-danger",-->
<!--            confirmButtonText: "Yes, delete it!",-->
<!--            cancelButtonText: "No, cancel plz!",-->
<!--            closeOnConfirm: false,-->
<!--            closeOnCancel: false,-->
<!--            showLoaderOnConfirm: true,-->
<!--        },-->
<!--        function(isConfirm) {-->
<!--            if (isConfirm) {-->
<!--                $.ajax({-->
<!--                    headers: {-->
<!--                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')-->
<!--                    },-->
<!--                    url:"<?php echo e(URL::to('admin/orders/destroy')); ?>",-->
<!--                    data: {-->
<!--                        id: id-->
<!--                    },-->
<!--                    method: 'POST',-->
<!--                    success: function(response) {-->
<!--                        if (response == 1) {-->
<!--                            swal({-->
<!--                                title: "Approved!",-->
<!--                                text: "Order has been deleted.",-->
<!--                                type: "success",-->
<!--                                showCancelButton: true,-->
<!--                                confirmButtonClass: "btn-danger",-->
<!--                                confirmButtonText: "Ok",-->
<!--                                closeOnConfirm: false,-->
<!--                                showLoaderOnConfirm: true,-->
<!--                            },-->
<!--                            function(isConfirm) {-->
<!--                                if (isConfirm) {-->
<!--                                    $('#dataid'+id).remove();-->
<!--                                    swal.close();-->
                                    // location.reload();
<!--                                }-->
<!--                            });-->
<!--                        } else {-->
<!--                            swal("Cancelled", "Something Went Wrong :(", "error");-->
<!--                        }-->
<!--                    },-->
<!--                    error: function(e) {-->
<!--                        swal("Cancelled", "Something Went Wrong :(", "error");-->
<!--                    }-->
<!--                });-->
<!--            } else {-->
<!--                swal("Cancelled", "Your record is safe :)", "error");-->
<!--            }-->
<!--        });-->
<!--    }-->

<!--    function StatusUpdate(id,status) {-->
<!--        swal({-->
<!--            title: "Are you sure?",-->
<!--            text: "Do you want to change status?",-->
<!--            type: "warning",-->
<!--            showCancelButton: true,-->
<!--            confirmButtonClass: "btn-danger",-->
<!--            confirmButtonText: "Yes, change it!",-->
<!--            cancelButtonText: "No, cancel plz!",-->
<!--            closeOnConfirm: false,-->
<!--            closeOnCancel: false,-->
<!--            showLoaderOnConfirm: true,-->
<!--        },-->
<!--        function(isConfirm) {-->
<!--            if (isConfirm) {-->
<!--                $.ajax({-->
<!--                    headers: {-->
<!--                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')-->
<!--                    },-->
<!--                    url:"<?php echo e(URL::to('admin/orders/update')); ?>",-->
<!--                    data: {-->
<!--                        id: id,-->
<!--                        status: status-->
<!--                    },-->
                    method: 'POST', //Post method,
<!--                    dataType: 'json',-->
<!--                    success: function(response) {-->
<!--                        swal({-->
<!--                            title: "Approved!",-->
<!--                            text: "Status has been changed.",-->
<!--                            type: "success",-->
<!--                            showCancelButton: true,-->
<!--                            confirmButtonClass: "btn-danger",-->
<!--                            confirmButtonText: "Ok",-->
<!--                            closeOnConfirm: false,-->
<!--                            showLoaderOnConfirm: true,-->
<!--                        },-->
<!--                        function(isConfirm) {-->
<!--                            if (isConfirm) {-->
<!--                                swal.close();-->
<!--                                location.reload();-->
<!--                            }-->
<!--                        });-->
<!--                    },-->
<!--                    error: function(e) {-->
<!--                        swal("Cancelled", "Something Went Wrong :(", "error");-->
<!--                    }-->
<!--                });-->
<!--            } else {-->
<!--                swal("Cancelled", "Something went wrong :)", "error");-->
<!--            }-->
<!--        });-->
<!--    }-->

<!--    $(document).on("click", ".open-AddBookDialog", function () {-->
<!--         var myBookId = $(this).data('id');-->
<!--         $(".modal-body #bookId").val( myBookId );-->
<!--    });-->

<!--    function assign(){     -->
<!--        var bookId=$("#bookId").val();-->
<!--        var driver_id = $('#driver_id').val();-->
<!--        var CSRF_TOKEN = $('input[name="_token"]').val();-->
<!--        $('#preloader').show();-->
<!--        $.ajax({-->
<!--            headers: {-->
<!--                'X-CSRF-Token': CSRF_TOKEN -->
<!--            },-->
<!--            url:"<?php echo e(URL::to('admin/orders/assign')); ?>",-->
<!--            method:'POST',-->
<!--            data:{'bookId':bookId,'driver_id':driver_id},-->
<!--            dataType:"json",-->
<!--            success:function(data){-->
<!--                $('#preloader').hide();-->
<!--                if (data == 1) {-->
<!--                    location.reload();-->
<!--                }-->
<!--            },error:function(data){-->
               
<!--            }-->
<!--        });-->
<!--    }-->
<!--</script>-->
<!--<?php $__env->stopSection(); ?>-->
<?php echo $__env->make('theme.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\new-xampp\htdocs\app\resources\views/subs_requests.blade.php ENDPATH**/ ?>