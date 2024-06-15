<!-- Bootstrap JS -->
<script src="{{ asset('public/assets/js/bootstrap.bundle.min.js') }}"></script>
<!--plugins-->
<script src="{{ asset('public/assets/plugins/simplebar/js/simplebar.min.js') }}"></script>
<script src="{{ asset('public/assets/plugins/metismenu/js/metisMenu.min.js') }}"></script>
<script src="{{ asset('public/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
<script src="{{ asset('public/assets/js/custom.js') }}"></script>
<script src="{{ asset('public/assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('public/assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#example').DataTable();
    });

</script>
<!--app JS-->
<script src="{{ asset('public/assets/js/app.js') }}"></script>
<script src="{{ asset('public/assets/js/getcategory.js') }}" defer></script>


{{-- MY Js --}}
<script src="{{ asset('public\assets\js\my_js\copy.js') }}"></script>
