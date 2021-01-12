<header>
    <!-- <h1 class="logo type2"><img src="img/logo.png" alt="UJ レンタル"></h1> -->
    <div id="r-head">
        <div id="r-head-right">
            <input type="button" class="logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">

            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </div>
</header>