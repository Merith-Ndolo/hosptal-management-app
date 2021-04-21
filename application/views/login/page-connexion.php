<?php include("includes/header.php"); ?>
<div class="container">
    <div class="card-top"></div>
    <div class="card">
        <h1 class="title"><span>Hopital de louandjili</span>Connexion <span class="msg"></span></h1>
        <div class="col-md-12">
            <form class='form-connexion' id="form-connexion">
                <div class="input-group text-center retour" style="font-size:13px"></div>
                <div class="input-group"> <span class="input-group-addon"> <i class="zmdi zmdi-account"></i> </span>
                    <div class="form-line">
                        <input type="text" class="form-control login" name="login" placeholder="Identifiant" >
                    </div>
                </div>
                <div class="input-group"> <span class="input-group-addon"> <i class="zmdi zmdi-lock"></i> </span>
                    <div class="form-line">
                        <input type="password" class="form-control pass" name="pwd" placeholder="Mot de passe">
                    </div>
                </div>
                <div>
                   
                    <div class="text-center">
                        <button type="submit" class="btn btn-raised waves-effect bg-blue-grey" id="connexion">Se connecter</a>
                    </div>
                    <div class="text-center"> <a href="<?php echo site_url("authentification/oublie"); ?>">Mot de passe oublié ?</a></div>
                </div>
            </form>
        </div>
    </div>    
</div>
<?php include("includes/footer.php"); ?>