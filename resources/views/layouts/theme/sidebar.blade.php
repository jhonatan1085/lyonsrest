

<div class="left_col scroll-view">
    <div class="navbar nav_title" style="border: 0;">
        <a href="index.html" class="site_title"><i class="fa fa-paw"></i> <span>Gentelella Alela!</span></a>
    </div>

    <div class="clearfix"></div>

    <!-- menu profile quick info -->
    <div class="profile clearfix">
        <div class="profile_pic">
            <img src="{{ asset('images/img.jpg') }}" alt="..." class="img-circle profile_img">
        </div>
        <div class="profile_info">
            <span>Bienvenido,{{ Auth::user()->name }} </span>
            <h2></h2>
        </div>
    </div>
    <!-- /menu profile quick info -->

    <br />

    <!-- sidebar menu -->
    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
        <div class="menu_section">
            <h3>General</h3>
            <ul class="nav side-menu">
                <li><a><i class="fa fa-money"></i> Créditos <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="{{ url('estadocuenta') }}">Estado de Cuenta</a></li>
                        
                    </ul>
                </li>



            </ul>
        </div>


    </div>
    <!-- /sidebar menu -->
</div>