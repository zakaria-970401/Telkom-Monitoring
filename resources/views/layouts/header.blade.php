<div id="kt_header" class="header header-fixed">
    <div class="container-fluid d-flex align-items-stretch justify-content-between">
        <div class="header-menu-wrapper header-menu-wrapper-right" id="kt_header_menu_wrapper">
            <div class="header-logo">
                <a href="{{ url('/') }}">
                    <img alt="Logo" src="{{ url('/') }}/assets/media/logos/logo.png" style="width: 50px;" />
                </a>
            </div>
            <div id="kt_header_menu" class="header-menu header-menu-mobile header-menu-layout-default">
                @if(Auth::check())
                <ul class="menu-nav">
                    @if(in_array('permission', $permissions))
                    <li class="menu-item menu-item-submenu menu-item-rel {{ (request()->is('permission/*')) ? 'menu-item-active' : '' }}" data-menu-toggle="click" aria-haspopup="true">
                        <a href="javascript:;" class="menu-link menu-toggle">
                            <span class="menu-text">Permission <i class="ml-1 ki ki-bold-triangle-bottom icon-xs text-dark-50"></i></span>
                        </a>
                        <div class="menu-submenu menu-submenu-classic menu-submenu-left">
                            <ul class="menu-subnav">
                                @if(in_array('permission', $permissions))
                                <li class="menu-item" aria-haspopup="true">
                                    <a href="{{ url('permission/auth-permission') }}" class="menu-link">
                                        <i class="menu-bullet menu-bullet-line">
                                            <span></span>
                                        </i>
                                        <span class="menu-text">Auth Permission</span>
                                    </a>
                                </li>
                                @endif
                                @if(in_array('permission_auth_group', $permissions))
                                <li class="menu-item" aria-haspopup="true">
                                    <a href="{{ url('permission/auth-group') }}" class="menu-link">
                                        <i class="menu-bullet menu-bullet-line">
                                            <span></span>
                                        </i>
                                        <span class="menu-text">Auth Group</span>
                                    </a>
                                </li>
                                @endif
                            </ul>
                        </div>
                    </li>
                    @endif
                    @if(in_array('admin', $permissions))
                    <li class="menu-item menu-item-submenu menu-item-rel {{ (request()->is('admin/*')) ? 'menu-item-active' : '' }}" data-menu-toggle="click" aria-haspopup="true">
                        <a href="javascript:;" class="menu-link menu-toggle">
                            <span class="menu-text">MASTER<i class="ml-1 ki ki-bold-triangle-bottom icon-xs text-dark-50"></i></span>
                        </a>
                        <div class="menu-submenu menu-submenu-classic menu-submenu-left">
                            <ul class="menu-subnav">
                                <li class="menu-item" aria-haspopup="true">
                                    <a href="{{ url('super_admin/master_user') }}" class="menu-link">
                                        <i class="menu-bullet menu-bullet-line">
                                            <span></span>
                                        </i>
                                        <span class="menu-text">Master User</span>
                                    </a>
                                </li>
                                <li class="menu-item" aria-haspopup="true">
                                    <a href="{{ url('super_admin/master_dept') }}" class="menu-link">
                                        <i class="menu-bullet menu-bullet-line">
                                            <span></span>
                                        </i>
                                        <span class="menu-text">Master Dept</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    @endif
                    @if(in_array('teknisi', $permissions))
                    <li class="menu-item menu-item-submenu menu-item-rel {{ (request()->is('teknisi/*')) ? 'menu-item-active' : '' }}" data-menu-toggle="click" aria-haspopup="true">
                        <a href="javascript:;" class="menu-link menu-toggle">
                            <span class="menu-text">TEKNISI<i class="ml-1 ki ki-bold-triangle-bottom icon-xs text-dark-50"></i></span>
                        </a>
                        <div class="menu-submenu menu-submenu-classic menu-submenu-left">
                            <ul class="menu-subnav">
                                @if(in_array('teknisi', $permissions))
                                <li class="menu-item" aria-haspopup="true">
                                    <a href="{{ url('teknisi') }}" class="menu-link">
                                        <i class="menu-bullet menu-bullet-line">
                                            <span></span>
                                        </i>
                                        <span class="menu-text">Scan WO</span>
                                    </a>
                                </li>
                                <li class="menu-item" aria-haspopup="true">
                                    <a href="{{ url('teknisi/list_wo') }}" class="menu-link">
                                        <i class="menu-bullet menu-bullet-line">
                                            <span></span>
                                        </i>
                                        <span class="menu-text">List WO <b class="ml-1"> {{Auth::user()->name}}</b></span>
                                    </a>
                                </li>
                                @endif
                            </ul>
                        </div>
                    </li>
                    @endif
                    @if(in_array('helpdesk', $permissions))
                    <li class="menu-item menu-item-submenu menu-item-rel {{ (request()->is('user/*')) ? 'menu-item-active' : '' }}" data-menu-toggle="click" aria-haspopup="true">
                        <a href="javascript:;" class="menu-link menu-toggle">
                            <span class="menu-text">Helpdesk Menu<i class="ml-1 ki ki-bold-triangle-bottom icon-xs text-dark-50"></i></span>
                        </a>
                        <div class="menu-submenu menu-submenu-classic menu-submenu-left">
                            <ul class="menu-subnav">
                                @if(in_array('helpdesk', $permissions))
                                <li class="menu-item" aria-haspopup="true">
                                    <a href="{{ url('helpdesk/create_tiket') }}" class="menu-link">
                                        <i class="menu-bullet menu-bullet-line">
                                            <span></span>
                                        </i>
                                        <span class="menu-text">Create Ticket</span>
                                    </a>
                                </li>
                                <li class="menu-item" aria-haspopup="true">
                                    <a href="{{ url('helpdesk/master_helpdesk') }}" class="menu-link">
                                        <i class="menu-bullet menu-bullet-line">
                                            <span></span>
                                        </i>
                                        <span class="menu-text">Master Helpdesk</span>
                                    </a>
                                </li>
                                <li class="menu-item" aria-haspopup="true">
                                    <a href="{{ url('helpdesk/master_pelanggan') }}" class="menu-link">
                                        <i class="menu-bullet menu-bullet-line">
                                            <span></span>
                                        </i>
                                        <span class="menu-text">Master Pelanggan</span>
                                    </a>
                                </li>
                                @endif
                            </ul>
                        </div>
                    </li>
                    @endif
                @else
                <ul class="menu-nav">
                    <li class="menu-item menu-item-submenu menu-item-rel menu-item-active" data-menu-toggle="click" aria-haspopup="true">
                        <a href="{{ url('login') }}" class="menu-link menu-toggle">
                            <span class="menu-text">Login</span>
                            <i class="menu-arrow"></i>
                        </a>
                    </li>
                </ul>
                @endif
            </div>
        </div>
        <div class="topbar">
            <div class="topbar-item">
                <div class="btn btn-icon w-auto btn-clean d-flex align-items-center btn-lg px-2" id="kt_quick_user_toggle">
                    <span class="text-muted font-weight-bold font-size-base d-none d-md-inline mr-1">Hi,</span>
                    <span class="text-dark-50 font-weight-bolder font-size-base d-none d-md-inline mr-3">
                        @if(Auth::check()) {{ explode(' ', Auth::user()->name)[0] }} @endif</span>
                    <span class="symbol symbol-35 symbol-light-danger">
                        <span class="symbol-label font-size-h5 font-weight-bold">
                            @if(Auth::check())
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            @else
                                <i class="far fa-smile text-dark-50"></i>
                            @endif
                        </span>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
