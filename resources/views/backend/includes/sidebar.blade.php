<div class="c-sidebar c-sidebar-light c-sidebar-fixed c-sidebar-lg-show" id="sidebar">
    <div class="c-sidebar-brand d-lg-down-none">
        <h4>LifeStyle MarketPlace</h4>
        {{-- <img src="{{ url('img/brand/logo_max.png') }}" class="c-sidebar-brand-full" alt="Logo Max" />
        <img src="{{ url('img/brand/logo_min.png') }}" class="c-sidebar-brand-minimized" alt="Logo Min" /> --}}
    </div>
    <!--c-sidebar-brand-->

    <ul class="c-sidebar-nav">
        <li class="c-sidebar-nav-item">
            <x-utils.link class="c-sidebar-nav-link" :href="route('admin.dashboard')" :active="activeClass(Route::is('admin.dashboard'), 'c-active')"
                icon="c-sidebar-nav-icon cil-speedometer" :text="__('Dashboard')" />
        </li>

        @if ($logged_in_user->hasAllAccess() || ($logged_in_user->can('admin.acce  ss.user.list') || $logged_in_user->can('admin.access.user.deactivate') || $logged_in_user->can('admin.access.user.reactivate') || $logged_in_user->can('admin.access.user.clear-session') || $logged_in_user->can('admin.access.user.impersonate') || $logged_in_user->can('admin.access.user.change-password')))
            <li class="c-sidebar-nav-title">@lang('System')</li>

            <li
                class="c-sidebar-nav-dropdown {{ activeClass(Route::is('admin.auth.user.*') || Route::is('admin.auth.role.*'), 'c-open c-show') }}">
                <x-utils.link href="#" icon="c-sidebar-nav-icon cil-user" class="c-sidebar-nav-dropdown-toggle"
                    :text="__('Access')" />

                <ul class="c-sidebar-nav-dropdown-items">
                    @if ($logged_in_user->hasAllAccess() || ($logged_in_user->can('admin.access.user.list') || $logged_in_user->can('admin.access.user.deactivate') || $logged_in_user->can('admin.access.user.reactivate') || $logged_in_user->can('admin.access.user.clear-session') || $logged_in_user->can('admin.access.user.impersonate') || $logged_in_user->can('admin.access.user.change-password')))
                        <li class="c-sidebar-nav-item">
                            <x-utils.link :href="route('admin.auth.user.index')" class="c-sidebar-nav-link" :text="__('User Management')"
                                :active="activeClass(Route::is('admin.auth.user.*'), 'c-active')" />
                        </li>
                    @endif

                    @if ($logged_in_user->hasAllAccess())
                        <li class="c-sidebar-nav-item">
                            <x-utils.link :href="route('admin.auth.role.index')" class="c-sidebar-nav-link" :text="__('Role Management')"
                                :active="activeClass(Route::is('admin.auth.role.*'), 'c-active')" />
                        </li>
                    @endif
                </ul>
            </li>
        @endif

        @if ($logged_in_user->hasAllAccess())
            <li class="c-sidebar-nav-dropdown">
                <x-utils.link href="#" icon="c-sidebar-nav-icon cil-list" class="c-sidebar-nav-dropdown-toggle"
                    :text="__('Logs')" />

                <ul class="c-sidebar-nav-dropdown-items">
                    <li class="c-sidebar-nav-item">
                        <x-utils.link :href="route('log-viewer::dashboard')" class="c-sidebar-nav-link" :text="__('Dashboard')" />
                    </li>
                    <li class="c-sidebar-nav-item">
                        <x-utils.link :href="route('log-viewer::logs.list')" class="c-sidebar-nav-link" :text="__('Logs')" />
                    </li>
                </ul>
            </li>
        @endif

        {{-- @role('Administrator|Tenant admin') --}}
        {{-- NEW --}}
        <li class="c-sidebar-nav-item">
            <x-utils.link class="c-sidebar-nav-link" :href="route('admin.user_extra.index')" :active="activeClass(Route::is('admin.userextra.*'), 'c-active')"
                icon="c-sidebar-nav-icon cil-people" text="User Management" />
        </li>
        <li class="c-sidebar-nav-item">
            <x-utils.link class="c-sidebar-nav-link" :href="route('admin.customer.index')" :active="activeClass(Route::is('admin.customer.*'), 'c-active')"
                icon="c-sidebar-nav-icon cil-book" text="Customer Management" />
        </li>
        <li class="c-sidebar-nav-item">
            <x-utils.link class="c-sidebar-nav-link" :href="route('admin.supplier.index')" :active="activeClass(Route::is('admin.supplier.*'), 'c-active')"
                icon="c-sidebar-nav-icon cil-book" text="Supplier Management" />
        </li>

        <li class="c-sidebar-nav-dropdown">
            <x-utils.link href="#" icon="c-sidebar-nav-icon fa fa-user" class="c-sidebar-nav-dropdown-toggle"
                text="Products Management" />

            <ul class="c-sidebar-nav-dropdown-items">
                <li class="c-sidebar-nav-item">
                    <x-utils.link class="c-sidebar-nav-link" :href="route('admin.category.index')" :active="activeClass(Route::is('userextra.*'), 'c-active')"
                        icon="c-sidebar-nav-icon cil-user" text="Category List" />
                </li>

                <li class="c-sidebar-nav-item">
                    <x-utils.link class="c-sidebar-nav-link" :href="route('admin.product.index')" :active="activeClass(Route::is('tenant.*'), 'c-active')"
                        icon="c-sidebar-nav-icon cil-people" text="Product List" />
                </li>
            </ul>
        </li>

        <li class="c-sidebar-nav-item">
            <x-utils.link class="c-sidebar-nav-link" :href="route('admin.stock.index')" :active="activeClass(Route::is('admin.stock.*'), 'c-active')"
                icon="c-sidebar-nav-icon cil-book" text="Stock Management" />
        </li>
        {{-- NEW END --}}
        {{-- @endrole --}}

        <button class="c-sidebar-minimizer c-class-toggler" type="button" data-target="_parent"
            data-class="c-sidebar-minimized"></button>
</div>
<!--sidebar-->
