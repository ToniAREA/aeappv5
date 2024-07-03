<div class="card mt-1 mb-1">
    <div class="card-header"
        style="display: flex; justify-content: space-between; align-items: center; padding-top: 5px; padding-bottom: 5px;">
        @can('client_access')
            <a href="{{ route('frontend.clients.index') }}"
                class="btn btn-primary {{ request()->is('frontend/clients') || request()->is('frontend/clients/*') ? 'active' : '' }}"
                title="{{ trans('cruds.client.title') }}" style="flex: 1; margin: 0 5px; display: flex; justify-content: center; align-items: center;">
                <i class="fa-fw nav-icon fas fa-users"></i>
            </a>
        @endcan
        @can('boat_access')
            <a href="{{ route('frontend.boats.index') }}"
                class="btn btn-primary {{ request()->is('frontend/boats') || request()->is('frontend/boats/*') ? 'active' : '' }}"
                title="{{ trans('cruds.boat.title') }}" style="flex: 1; margin: 0 5px; display: flex; justify-content: center; align-items: center;">
                <i class="fa-fw nav-icon fas fa-ship"></i>
            </a>
        @endcan
        @can('marina_access')
            <a href="{{ route('frontend.marinas.index') }}"
                class="btn btn-primary {{ request()->is('frontend/marinas') || request()->is('frontend/marinas/*') ? 'active' : '' }}"
                title="{{ trans('cruds.marina.title') }}" style="flex: 1; margin: 0 5px; display: flex; justify-content: center; align-items: center;">
                <i class="fa-fw nav-icon fas fa-anchor"></i>
            </a>
        @endcan
        @can('work_access')
            @can('wlist_access')
                <a href="{{ route('frontend.wlists.index') }}"
                    class="btn btn-primary {{ request()->is('frontend/wlists') || request()->is('frontend/wlists/*') ? 'active' : '' }}"
                    title="{{ trans('cruds.wlist.title') }}" style="flex: 1; margin: 0 5px; display: flex; justify-content: center; align-items: center;">
                    <i class="fa-fw nav-icon fas fa-list"></i>
                </a>
            @endcan
            @can('wlog_access')
                <a href="{{ route('frontend.wlogs.index') }}"
                    class="btn btn-primary {{ request()->is('frontend/wlogs') || request()->is('frontend/wlogs/*') ? 'active' : '' }}"
                    title="{{ trans('cruds.wlog.title') }}" style="flex: 1; margin: 0 5px; display: flex; justify-content: center; align-items: center;">
                    <i class="fa-fw nav-icon fas fa-clock"></i>
                </a>
            @endcan
            @can('mlog_access')
                <a href="{{ route('frontend.mlogs.index') }}"
                    class="btn btn-primary {{ request()->is('frontend/mlogs') || request()->is('frontend/mlogs/*') ? 'active' : '' }}"
                    title="{{ trans('cruds.mlog.title') }}" style="flex: 1; margin: 0 5px; display: flex; justify-content: center; align-items: center;">
                    <i class="fa-fw nav-icon fas fa-cogs"></i>
                </a>
                </a>
                </a>
            @endcan
        @endcan
    </div>
</div>
