  <?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark text-white ">
      <div class="container-fluid">

          <a class="navbar-brand" href="#">
              <img src="./assets/imgs/icon.png" width="100" alt="cachorro do apoio pet">
              APOIO PET
          </a>

         <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	      <span class="navbar-toggler-icon"></span>
	    </button>
	    <div class="collapse navbar-collapse" id="navbarSupportedContent">
	      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
	        <li class="nav-item">
	          <a class="nav-link active" aria-current="page" href="index.php">Inicio</a>
	        </li>
	        <li class="nav-item">
	          <a class="nav-link" href="blog.php">Blog</a>
	        </li>
	        <li class="nav-item">
	          <a class="nav-link" href="sobre.php">Sobre</a>
	        </li>
	        <li class="nav-item">
	          <a class="nav-link" 
	             href="categoria.php">
	             Categoria</a>
	        </li>
	        <li class="nav-item">
	          <a class="nav-link" 
	             href="animals.php">
	             Animais</a>
	        </li>
	         <?php 
               if ($logged) {
	         ?>
	        <li class="nav-item dropdown">
	          <a class="nav-link dropdown-toggle" 
	             href="profile.php" 
	             role="button" 
	             data-bs-toggle="dropdown" 
	             aria-expanded="false">
	             <i class="fa fa-user" 
	                aria-hidden="true"></i> 
	            @<?=$_SESSION['username']?>
	          </a>
	          <ul class="dropdown-menu">
	            <li><a class="dropdown-item" 
	            	   href="logout.php">
	            	   Sair</a></li>
	          </ul>
	        </li>
	        <?php 
               } else {
	         ?>
	         <li class="nav-item">
	          <a class="nav-link" href="login.php">entrar | Signup</a>
	        </li>
	         <?php 
               }
	         ?>
	      </ul>
	      <form class="d-flex" 
	             role="search"
	             method="GET"
	             action="blog.php">
	        <input class="form-control me-2" 
	               type="search"
	               name="search" 
	               placeholder="Procurar" 
	               aria-label="Search">

	        <button class="btn btn-outline-success" 
	                type="submit">
	                Procurar</button>
	      </form>
	    </div>
	  </div>
	</nav>
