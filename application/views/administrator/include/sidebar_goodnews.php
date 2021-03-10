  
          <?php 
          /**
           * module goodnews
           */
          ?>
          <li class="nav-item has-treeview module-goodnews">
            <a href="#" class="nav-link">
            <i class="nav-icon fas fa-cogs"></i>
            <p>Modul Goodnews <i class="right fas fa-angle-left"></i></p></a>
            <ul class="nav nav-treeview">
            <?php        
              //mod goodnews
              $cek=$this->model_app->umenu_akses("goodnews",$this->session->id_session);
              if($cek==1 OR $this->session->level=='admin'){
                echo "<li class='nav-item goodnews'><a class='nav-link' href='".base_url().$this->uri->segment(1)."/goodnews'><i class='far fa-circle nav-icon text-success'></i> <p>Goodnews Panel</p></a></li>";
              }  

            ?>
            </ul>
          </li>
 