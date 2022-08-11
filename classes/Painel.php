<?php
	
	class Painel {
		public static $cargos = [
           '0' => 'Normal',
           '1' => 'Sub Administrador',
           '2' => 'Administrador'
        ];

       public static function alert($tipo,$mensagem){
          if($tipo == 'sucesso'){
             echo '<div class="box-alert sucesso"><i class="fa fa-check"></i> '.$mensagem.'</div>';
          }else if($tipo == 'erro'){
             echo '<div class="box-alert erro"><i class="fa fa-times"></i> '.$mensagem.'</div>';
          }else if($tipo == 'atencao'){
             echo '<div class="box-alert atencao"><i class="fa fa-warning"></i> '.$mensagem.'</div>';
          }
       }
		
		public static function loadJS($files,$page) {
			$url = explode('/',@$_GET['url'])[0];
			if($page == $url){
				foreach ($files as $key => $value) {
					echo '<script src="'.INCLUDE_PATH_PAINEL.'js/'.$value.'"></script>';
				}
			}
		}

		public static function logado() {
			return isset($_SESSION['login']) ? true : false;
		}

		public static function loggout() {
			setcookie('lembrar','true',time()-1,'/');
			session_destroy();
			header('Location: '.INCLUDE_PATH_PAINEL);
		}

       public static function carregarPagina() {
          if (isset($_GET['url'])) {
             $url = explode('/', $_GET['url']);

             if (file_exists('pages/' . $url[0] . '.php'))
             {
                include 'pages/' . $url[0] . '.php';
             }
             else
             {
                //Pagina não existe
                header('Location: ' . INCLUDE_PATH_PAINEL);
                // include('pages/home.php');
             }
          }
          else
          {
             include 'pages/home.php';
          }
       }

		public static function redirect($url) {
			echo '<script>location.href="'.$url.'"</script>';
			die();
		}

	}

?>