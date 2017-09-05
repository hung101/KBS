<html> 
<title>SPSB</title>
<style>
body {
margin: 0px;
}
</style>
<script>
    // Grab the iframe document
document.oncontextmenu = function() { 
    return false; 
};
</script>
<body>
    <?php $url_src = "http://$_SERVER[HTTP_HOST]/kbs/frontend/web/";
    //$url_src = "https://spsb.kbs.gov.my/frontend/web/site/login";?>
<iframe align="center" width="100%" height="100%" src="<?=$url_src?>" frameborder="no" scrolling="yes" id="spsb_frame"> </iframe>   
</body>
</html>