<header class="navbar">
    <div class="container-fluid expanded-panel">
        <div class="row">
            <div id="logo" class="col-xs-12 col-sm-2">
                <a href="/">ContShare</a>
            </div>
            <div id="top-panel" class="col-xs-12 col-sm-10">
                <div class="row">
                    <div class="col-xs-8 col-sm-4">
                        <a href="#" class="show-sidebar">
                          <i class="fa fa-bars"></i>
                        </a>
                        <div id="search">
                            <input type="text" placeholder="Procure por pessoas" id="busca" onkeyup="search(this.value)"/>
                            <i class="fa fa-search"></i>
                            <div id="result"></div>
                        </div>
                        
                    </div>
                    <div class="col-xs-4 col-sm-8 top-panel-right">
                        <ul class="nav navbar-nav pull-right panel-menu">
                            <li class="hidden-xs">
                                <a href="#" class="notifi" onclick="return false">
                                    <i class="fa fa-bell"></i>
                                    <span class="badge"></span>
                                </a>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle account" data-toggle="dropdown">
                                    <div class="avatar">
                                        <img src="" class="img-rounded" alt="avatar" />
                                    </div>
                                    <i class="fa fa-angle-down pull-right"></i>
                                    <div class="user-mini pull-right">
                                        <span class="welcome">Bem-Vindo,</span>
                                        <span></span>
                                    </div>
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="">
                                            <i class="fa fa-user"></i>
                                            <span>Perfil</span>
                                        </a>
                                    </li>                                   
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-cog"></i>
                                            <span>Configurações</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="control/control_user.php?logout=1" >
                                            <i class="fa fa-power-off"></i>
                                            <span>Sair</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>