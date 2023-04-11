<div class="sl-logo"><a href=""><i class="icon ion-android-star-outline"></i> Mini Sales</a></div>
<div class="sl-sideleft">
    <div class="sl-sideleft-menu">
        <a href="{{ route('user.home') }}" class="sl-menu-link @yield('dashboard')">
            <div class="sl-menu-item">
                <i class="menu-item-icon icon ion-ios-home-outline tx-22"></i>
                <span class="menu-item-label">User Dashboard</span>
            </div>
        </a>
        <a href="{{ route('user.product.index') }}" class="sl-menu-link @yield('product')">
            <div class="sl-menu-item">
                <i class="menu-item-icon icon ion-briefcase tx-22"></i>
                <span class="menu-item-label">Product</span>
            </div>
        </a>
        <a href="{{ route('user.sale.index') }}" class="sl-menu-link @yield('sale')">
            <div class="sl-menu-item">
                <i class="menu-item-icon icon ion-gear-a tx-22"></i>
                <span class="menu-item-label">Sale</span>
            </div>
        </a>
        <a href="{{ route('user.invoice.index') }}" class="sl-menu-link @yield('invoice')">
            <div class="sl-menu-item">
                <i class="menu-item-icon icon ion-clipboard tx-22"></i>
                <span class="menu-item-label">Invoice </span>
            </div>
        </a>
        <a href="{{ route('user.stock.index') }}" class="sl-menu-link @yield('stock')">
            <div class="sl-menu-item">
                <i class="menu-item-icon icon ion-document-text tx-22"></i>
                <span class="menu-item-label">Stock Report  </span>
            </div>
        </a>

    </div>
    <br>
</div>