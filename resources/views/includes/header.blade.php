<header class="navbar">
    @if(Auth::check())
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
                                <input type="text" placeholder="Procure por pessoas" id="busca" onkeyup="searchUsers(this.value)"/>
                                <i class="fa fa-search"></i>
                                <div id="result"></div>
                            </div>
                            
                        </div>
                        <div class="col-xs-4 col-sm-8 top-panel-right">
                            <ul class="nav navbar-nav pull-right panel-menu">
                                <li class="hidden-xs">
                                    <a href="#" class="notifi" onclick="return false">
                                        <i class="fa fa-bell"></i>
                                        <span class="badge">{{$notifications > 0 ? $notifications : ''}}</span>
                                    </a>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle account" data-toggle="dropdown">
                                        <div class="avatar">
                                            <img src="{{asset('avatars/'.auth()->user()->avatar)}}" class="img-rounded" alt="avatar" />
                                        </div>
                                        <i class="fa fa-angle-down pull-right"></i>
                                        <div class="user-mini pull-right">
                                            <span class="welcome">Bem-Vindo,</span>
                                            <span>{{auth()->user()->name}}</span>
                                        </div>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a href="{{url('/'.auth()->user()->id)}}">
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
                                            <a href="{{ url('/logout') }}" >
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
                <div id="sidebar-navbar">
                    <ul class="">
                        <li title="Início" id="nav-index" class="index">
                            <a href="/groups" >
                            <i class="glyphicon glyphicon-home"></i>
                            <span class="hidden-xs">Início</span>
                            </a>
                        </li>
                                
                        <li title="Perfil" id="nav-profile">
                            <a href="{{url('/'.auth()->user()->id)}}" >
                            <i class="glyphicon glyphicon-user"></i>
                            <span class="hidden-xs">Perfil</span>
                            </a>
                        </li>
                        <li title="Novo Link">
                            <a href="#"  data-toggle="modal" data-target="#modalSave">
                            <i class="glyphicon glyphicon-plus"></i>
                            <span class="hidden-xs">Novo link</span>
                            </a>
                        </li>
                         <li title="Pesquisar" id="nav-notifications" class="nav-li-mobile" style="display:none">
                            <a href="/notificationUsers">
                                 <i class="fa fa-bell"></i>
                                 <span class="badge">{{$notifications > 0 ? $notifications : ''}}</span>
                            </a>
                        </li>
                        <li title="Pesquisar" id="nav-searchconts" class="nav-li-mobile" style="display:none">
                            <a href="mobile/searchConts">
                                <i class="fa fa-search"></i>
                            </a>
                        </li>                       
                    </ul>
                </div>
            </div>
        </div>
    @else
        <div class="container-fluid expanded-panel">
            <div class="row">
                <div id="logo" class="col-xs-12 col-sm-2">
                    <a href="/">ContShare</a>
                </div>
                <div id="top-panel" class="col-xs-12 col-sm-10">
                    <div class="row">
                        <div class="col-xs-8 col-sm-4">

                        </div>
                        <div class="col-xs-4 col-sm-8 top-panel-right">
                            <a href="/login" class="pull-right btn btn-default" style="height: 50px; margin-right: 20px;"><p style="margin-top: 10px">Cadastre-se</p></a>
                            <button class="pull-right btn btn-default" style="width:100px; height: 50px; margin-right: 25px;" data-toggle='modal' data-target='#modalEnter'>Entrar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</header>
<script>
$(document).ready(function() {
    $('.notifi').tooltipster({
        content: 'Carregando',
        trigger: 'click',
        contentAsHTML: true,
        interactive: true,
        // 'instance' is basically the tooltip. More details in the "Object-oriented Tooltipster" section.
        functionBefore: function(instance, helper) {
            
            var $origin = $(helper.origin);
            
            // we set a variable so the data is only loaded once via Ajax, not every time the tooltip opens
            if ($origin.data('loaded') !== true) {
    
                $.get('/notificationUsers', function(data) {
    
                    // call the 'content' method to update the content of our tooltip with the returned data
                    instance.content(data);
    
                    // to remember that the data has been loaded
                    $origin.data('loaded', true);
                });
            }
        }
    });
});
</script>
