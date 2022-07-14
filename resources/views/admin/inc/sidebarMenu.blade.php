<nav class="mt-2">


    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      <!-- Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->

        {{-- @include('admin.inc.adminMenu')
        @if(Auth::guard('web')->user()->role=="Admin")
            @include('admin.inc.adminMenu')
        @endif

        @if(Auth::guard('web')->user()->role=="Chef")
            @include('admin.inc.chefMenu')
        @endif

        @if(Auth::guard('web')->user()->role=="Agent")
            @include('admin.inc.agentMenu')
        @endif


        @if(Auth::guard('web')->user()->role=="Invite")
            @include('admin.inc.inviteMenu')
        @endif --}}
        @can('isAdmin')
            @include('admin.inc.adminMenu')
        @endcan

        @can('isChef')
            @include('admin.inc.chefMenu')
        @endcan


        @can('isAgent')
            @include('admin.inc.agentMenu')
        @endcan


        @can('isInvite')
            @include('admin.inc.inviteMenu')
        @endcan


    </ul>
  </nav>
