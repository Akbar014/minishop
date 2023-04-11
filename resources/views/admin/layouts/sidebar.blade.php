<div class="sl-logo"><a href=""><i class="icon ion-android-star-outline"></i> Mini Sales</a></div>
<div class="sl-sideleft">
    <div class="sl-sideleft-menu">
    <a href="{{ route('admin.home') }}" class="sl-menu-link @yield('dashboard')">
            <div class="sl-menu-item">
                <i class="menu-item-icon icon ion-ios-home-outline tx-22"></i>
                <span class="menu-item-label">Dashboard</span>
            </div>
        </a>
    <a href="{{ route('admin.products') }}" class="sl-menu-link @yield('products')">
            <div class="sl-menu-item">
                <i class="menu-item-icon icon ion-ios-home-outline tx-22"></i>
                <span class="menu-item-label">Products</span>
            </div>
        </a>

        

    </div>
    <br>
</div>