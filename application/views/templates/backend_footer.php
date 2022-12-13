    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Version</b> 1.0
        </div>
        <strong>Copyright &copy; <?= date('Y'); ?> <a href="google.com" target="_blank"><?php echo $this->config->item('nama_mhs'); ?></a>.</strong> All rights
        reserved.
    </footer>

    <!-- Add the sidebar's background. This div must be placed
        immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
    </div>
    <!-- ./wrapper -->

    <!-- jQuery 3 -->
    <script src="<?= base_url('assets/backend') ?>/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="<?= base_url('assets/backend') ?>/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- Select2 -->
    <script type="text/javascript" src="<?php echo base_url('assets/backend/js/bootstrap-select.js'); ?>"></script>
    <!-- SlimScroll -->
    <script src="<?= base_url('assets/backend') ?>/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <!-- <script src="/pos/asset/bower_components/fastclick/lib/fastclick.js"></script> -->
    <!-- bootstrap datepicker -->
    <script src="<?= base_url('assets/backend') ?>/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url('assets/backend') ?>/dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for datatables -->
    <script src="<?= base_url('assets/backend') ?>/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?= base_url('assets/backend') ?>/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <!-- Select2 -->
    <script src="<?= base_url('assets/backend') ?>/bower_components/select2/dist/js/select2.full.min.js"></script>

    <!-- Bootstrap WYSIHTML5 -->
    <script src="<?= base_url('assets/backend') ?>/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.sidebar-menu').tree();
            $('#table1').DataTable({
                "language": {
                    "url": "indonesia.json",
                    "sEmptyTable": "Kosong"
                }
            });

            //Initialize Select2 Elements
            $('.select2').select2()

        })
    </script>

    <script>
        $(function() {
            $('.textarea').wysihtml5()
        })
    </script>

    <script>
        // function setDateRangePicker(input1, input2) {
        //     $(input1).datepicker({
        //         autoclose: true,
        //         format: "yyyy-mm-dd",
        //     }).on("change", function() {
        //         $(input2).val("").datepicker('setStartDate', $(this).val());
        //     }).attr("readonly", "readonly").css({
        //         "cursor": "pointer",
        //         "background": "white"
        //     });
        //     $(input2).datepicker({
        //         autoclose: true,
        //         format: "yyyy-mm-dd",
        //         orientation: "bottom right"
        //     }).attr("readonly", "readonly").css({
        //         "cursor": "pointer",
        //         "background": "white"
        //     });
        // }

        //Date picker
        $('#datepicker').datepicker({
            autoclose: true
        })
    </script>

    </body>

    </html>