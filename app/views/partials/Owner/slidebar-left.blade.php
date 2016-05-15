<aside id="sidebar-left" class="sidebar-circle">

    <!--Inicio titleSidebarLeft -->
    @include('partials.Controles.titleSidebarLeft')
    <!--Fin titleSidebarLeft -->

    <ul class="sidebar-menu">
        <!--Inicio titleDashboardSidebarLeft -->
        @include('partials.Controles.titleDashboardSidebarLeft')
        <!--Fin titleDashboardSidebarLeft -->

        <li class="sidebar-category">
            <span>Administrador</span>
            <span class="pull-right"><i class="fa fa-code"></i></span>
        </li>
        <!--Inicio Consultas -->
        @include('partials.Controles.consultas')
        <!--Fin Consultas -->
    </ul>

    <!--Inicio footerSidebarLeft -->
    @include('partials.Controles.footerSidebarLeft')
    <!--Fin footerSidebarLeft -->

</aside>
