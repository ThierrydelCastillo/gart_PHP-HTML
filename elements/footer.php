</main><!-- /.container -->

<footer>
    <hr>
    <div class="row">
        <div class="col-md-4">
            <?php
            require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'class' . DIRECTORY_SEPARATOR . 'DoubleCompteur.php';
            $compteur = new DoubleCompteur(dirname(__DIR__) . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'compteur');
            $compteur->incrementer();
            $vue = $compteur->recuperer();
            ?>
            Il y a <?= $vue ?> visite<?php if ($vue > 1):?>s<?php endif ?> sur le site.
        </div>
        <div class="col-md-4">
            <form action="newsletter.php" method="post" class="form-inline">
                <div class="form-group">
                    <input type="email" name="email" placeholder="Entrez votre email" required class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">S'inscrire</button>
            </form>
        </div>
        <div class="col-md-4">
            <h5>Navigation</h5>
            <ul class="list-unstyle text-small">
                <?= nav_menu() ?>
            </ul>
        </div>
    </div>
</footer>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>
      
  </body>
</html>