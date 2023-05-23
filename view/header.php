<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= SERVER_URL ?>/img/icon.ico" />
    <link rel="stylesheet" href="<?= SERVER_URL ?>/css/bootstrap.min.css" />
    <link href="<?= SERVER_URL ?>/css/styles.css" rel="stylesheet"> 
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.css">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.21.3/dist/bootstrap-table.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title><?= $title ?></title>
  </head>
  <body>
    <!-- Début de la navbar -->
    <nav class="navbar navbar-expand-md bg-dark navbar-dark fixed-top">
      <div class="container">
      <a href="<?= SERVER_URL ?>"><img src="<?= SERVER_URL ?>/img/accueil/logo1.png" class="col-sm-12" alt="shiba" id="shiba"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>          
        <div class="row">
          <div class="col-lg-12">
            <div class="collapse navbar-collapse" id="navbarColor02">
              <ul class="navbar-nav m-auto my-2 my-lg-0">
                <li class="nav-item">
                  <a class="nav-link <?= $actifA ?>" href="<?= SERVER_URL ?>">Accueil</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link <?= $actifB ?>" href="<?= SERVER_URL."/boutique/" ?>">Boutique</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link <?= $actifN ?>" href="<?= SERVER_URL ?>/nft/">A propos des NFT</a>
                </li>
              </ul>
              <?php if(isset($_SESSION['LOGGED_USER'])){ ?>
              <ul class="navbar-nav">
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
  
                    <li id="panie">
                      <a class="dropdown-item" href="<?= SERVER_URL ?>/panier/">
                        <i class="fa fa-shopping-basket"></i>&nbsp; Panier <span class="badge bg-danger rounded-pill"><?php if($_SESSION['panier'] != null) { echo $_SESSION['panier']; } ?></span>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="<?= SERVER_URL ?>/favoris/">
                        <i class="fa fa-heart"></i>&nbsp; Votre sélection
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="<?= SERVER_URL ?>/commandes/">
                        <i class="fas fa-box"></i>&nbsp; Commandes
                      </a>
                    </li>
                  </ul>
                </li>
              </ul>
              <div class="collapse navbar-collapse" id="navbarNavDarkDropdown1">
                <ul class="navbar-nav">
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown" href="#" id="navbarDarkDropdownMenuLink1" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      <i class="fa fa-user" aria-hidden="true"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                      <?php if($_SESSION['user']->getRole() == 'admin') { ?>
                      <li>
                        <a class="dropdown-item" href="<?= SERVER_URL ?>/produit/">Dashboard</a>
                      </li>
                      <?php } ?>
                      <li>
                        <a class="dropdown-item" href="<?= SERVER_URL ?>/mon-compte/">Mon compte</a>
                      </li>
                      <li>
                        <a class="dropdown-item" href="<?= SERVER_URL ?>/deconnexion/">Se déconnecter</a>
                      </li>
                    </ul>
                  </li>
                </ul>
              </div>
              <?php } else { ?>
              <div class="collapse navbar-collapse" id="navbarNavDarkDropdown2">
                <ul class="navbar-nav">
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown" href="#" id="navbarDarkDropdownMenuLink2" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      <i class="fa fa-user" aria-hidden="true"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                      <li>
                        <a class="dropdown-item" href="<?= SERVER_URL ?>/connexion/">Se connecter</a>
                      </li>
                      <li>
                        <a class="dropdown-item" href="<?= SERVER_URL ?>/inscription/">S'inscrire</a>
                      </li>
                    </ul>
                  </li>
                </ul>
              </div>                       
              <?php } ?>
              <!-- Début menu déroulant -->
              <div class="collapse navbar-collapse" id="navbarNavDarkDropdown3">
                <ul class="navbar-nav">
                  <li class="nav-item dropdown">
                    <form method="GET">
                      <input class="form-control me-sm-4 mx-2" name="search" type="text" placeholder="Rechercher">
                    </form>
                  </li>
                </ul>
              </div>
              <!-- Fin menu déroulant -->
            </div>
          </div>
        </div>
      </div>
    </nav>
    <!-- Fin de la navbar -->

    <!-- <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Link</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Dropdown
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
        </li>
      </ul>
      <form class="d-flex">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav> -->
