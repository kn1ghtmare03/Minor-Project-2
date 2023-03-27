<!-- modal start -->
<div class="modal text-left" id="default" tabindex="-1" aria-labelledby="myModalLabel1" aria-modal="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-label"></h5>
                <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>
            <iframe class="modal-body">
            </iframe>
        </div>
    </div>
</div>
<!-- modal start -->

<script src="<?php echo $sys_link; ?>/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="<?php echo $sys_link; ?>/assets/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo $sys_link; ?>/assets/vendors/apexcharts/apexcharts.js"></script>
<script src="<?php echo $sys_link; ?>/assets/vendors/jquery/jquery.min.js"></script>
<script src="<?php echo $sys_link; ?>/assets/vendors/DataTable/datatables.min.js"></script>

<!-- start code for handling modal data -->
<script>
    function showModal(button) {
        document.querySelector('#modal-label').innerText = button.getAttribute('data-title')
        document.querySelector('.modal-body').src = button.getAttribute('data-url');
        document.querySelector('.modal-body').style.height = button.getAttribute('data-modal-height');
        if (button.getAttribute('data-modal-size') != 'default'){
            $('.modal-dialog').removeClass().
            addClass("modal-" + button.getAttribute('data-modal-size') +
            ' modal-dialog modal-dialog-scrollable');
        } else {
            $('.modal-dialog').removeClass().
            addClass('modal-dialog modal-dialog-scrollable');
        }

        $('.modal').show();
    }

    $('[data-bs-dismiss="modal"]').on('click',function(e) {
        e.preventDefault();
        $('.modal').hide();
    })

    $(function(){
        if (document.querySelector('#loader-screen')) {
            setTimeout(function(){
                $('#loader-screen').fadeOut("slow",)
            },600)
        }
    })
</script>
<!-- end code for handling modal data -->