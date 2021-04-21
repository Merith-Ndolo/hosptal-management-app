
<!--<div class="theme-bg"></div>--> 

<!-- Jquery Core Js --> 
<script src="<?php echo base_url('assets/plugins/jquery/jquery-3.1.0.min.js');?>"></script> <!-- Lib Scripts Plugin Js -->
<script src="<?php echo base_url('assets/bundles/libscripts.bundle.js');?>"></script> <!-- Lib Scripts Plugin Js -->
<script src="<?php echo base_url('assets/bundles/vendorscripts.bundle.js');?>"></script> <!-- Lib Scripts Plugin Js -->

<script src="<?php echo base_url('assets/bundles/mainscripts.bundle.js');?>"></script><!-- Custom Js -->
<script>
	var urlSite = <?php echo json_encode(site_url()); ?>;
	var urlConnect = <?php echo json_encode(site_url('authentification/se_connecter')); ?>;
	var urlOublie = <?php echo json_encode(site_url('authentification/mdp_oublie')); ?>;
	var app = <?php echo json_encode(site_url('app')); ?>;
</script>
<script src="<?php echo base_url("assets/js/authentification.js"); ?>"></script>
</body>
</html>