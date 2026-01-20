<aside id="with-navbar-sidebar"
    class="overlay [--auto-close:lg] lg:shadow-none overlay-open:translate-x-0 drawer drawer-start hidden h-full max-w-75 lg:z-0 lg:block lg:translate-x-0 lg:pt-16"
    role="dialog" tabindex="-1">
    <div class="drawer-head flex lg:hidden px-2 py-3">
        <button type="button" class="btn btn-text max-lg:btn-square lg:hidden me-2" aria-haspopup="dialog"
            aria-expanded="false" aria-controls="with-navbar-sidebar" data-overlay="#with-navbar-sidebar">
            <span class="icon-[tabler--menu-2] size-5"></span>
        </button>
        <div class="flex flex-1 items-center">
            <a class="link text-base-content link-neutral text-xl font-semibold no-underline"
                href="{{ route('dashboard') }}">
                <div class="flex items-center gap-3">
                    <img src="https://pub-99de907071b34c5b818be772a36c0976.r2.dev/logo-icon.jpg" class="size-8"
                        alt="brand-logo" />
                    <h2 class="text-base-content text-xl font-bold whitespace-nowrap">{{ config('app.name') }}
                    </h2>
                </div>
            </a>
        </div>
    </div>
    <div class="drawer-body h-full px-2 pt-4 lg:border-e border-base-content/25">
        <ul class="menu space-y-0.5 p-0">
            <!-- Dashboard Menu Item -->
            <li>
                <a href="{{ route('dashboard') }}" @class([
                    'menu-active' => request()->routeIs('dashboard'),
                ])>
                    <span class="icon-[tabler--apps] size-5"></span>
                    Dashboard
                </a>
            </li>

            <!-- Section Divider -->
            <div class="divider text-base-content/50 py-3 after:border-0">Management</div>

            <li class="space-y-0.5">
                <a @class([
                    'collapse-toggle collapse-open:bg-base-content/10',
                    'open' => request()->routeIs('users.*'),
                ]) id="user-management" data-collapse="#user-management-collapse">
                    <span class="icon-[tabler--settings] size-5"></span>
                    Management
                    <span class="icon-[tabler--chevron-down] collapse-open:rotate-180 size-4 transition-all"></span>
                </a>
                <ul id="user-management-collapse" @class([
                    'collapse w-auto space-y-0.5 overflow-hidden transition-[height]',
                    'open' => request()->routeIs('users.*'),
                    'hidden' => !request()->routeIs('users.*'),
                ]) aria-labelledby="user-management">
                    <li>
                        <a href="{{ route('users.index') }}" @class(['', 'menu-active' => request()->routeIs('users.*')])>
                            <span class="icon-[tabler--users] size-5"></span>
                            Users
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</aside>
