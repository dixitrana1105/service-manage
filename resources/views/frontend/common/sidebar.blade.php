<ul id="account-panel" class="nav nav-pills flex-column col mb-4 mt-4">
    <li class="nav-item">
        <a href="{{ route('account.profile') }}"
            class="font-weight-bold {{ request()->routeIs('account.profile') ? 'active' : '' }}"
            style="color: #000000;">
            <i class="fas fa-user" style="font-size: 30px; width: 30px; height: 30px;"></i>&nbsp; My Profile
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('account.changePassword') }}" class="font-weight-bold" style="color: #000000;">
            <i class="fas fa-lock" style="font-size: 30px; width: 30px; height: 30px;"></i>&nbsp; Change Password
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('account.logout') }}" class="font-weight-bold" style="color: #000000;">
            <i class="fas fa-sign-out-alt" style="font-size: 30px; width: 30px; height: 300px;"></i>&nbsp; Logout
        </a>
    </li>
</ul>

<!-- <div class="col mt-4 mb-4">
    <a href="{{ route('home') }}" class="btn btn-primary btn-block">Back to Home</a>
</div> -->