<?php include("includes/header.php"); ?>
<div class="container">
    <div class="card-top"></div>
    <div class="card">
        <h1 class="title"><span>Hopital de louandjili</span>Mot pas passe oublié <span class="msg">Renseigner votre adresse mail</span></h1>
        <div class="col-md-12">
            <form class='form-oublie' id="form-oublie">
                
                <div class="input-group"> <span class="input-group-addon"> <i class="zmdi zmdi-account"></i> </span>
                    <div class="form-line">
                        <input type="text" class="form-control" name="email" placeholder="Adresse Mail" >
                    </div>
                </div>
               
                <div>
                   
                    <div class="text-center">
                        <button type="submit" class="btn btn-raised waves-effect bg-blue-grey" id="oublie">Envoyer</a>
                    </div>
                    <div class="text-center"> Vous avez déjà un compte ? <a href="<?php echo site_url(); ?>">Se connecter</a></div>
                </div>
            </form>
        </div>
    </div>    
</div>
<?php include("includes/footer.php"); ?>