<!-- Left Panel -->

<aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">

        <div class="navbar-header">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu"
                    aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand" href="./"><img src="{{asset('template-admin/images/logo.png')}}" alt="Logo"></a>
            <a class="navbar-brand hidden" href="./"><img src="{{asset('template-admin/images/logo2.png')}}" alt="Logo"></a>
        </div>

        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active">
                    <a href="{{url('dashboard')}}"> <i class="menu-icon fa fa-dashboard"></i>Dashboard </a>
                </li>
                <li>
                    <a href="{{url('transaksi')}}"> <i class="menu-icon fa fa-shopping-cart"></i> Transaksi</a>
                </li>
                <li>
                    <a href="{{url('dataset')}}"> <i class="menu-icon fa fa-signal"></i> Dataset</a>
                </li>
                @if(Session::get('level') == 0)
                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                       aria-expanded="false"> <i class="menu-icon fa fa-cog"></i>Setting</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="menu-icon fa fa-user"></i>
                            <a href="{{url('user')}}">kelola User</a>
                        </li>
{{--                        <li><i class="menu-icon fa fa-transgender"></i>--}}
{{--                            <a href="{{url('user')}}"> Kategori</a>--}}
{{--                        </li>--}}
                    </ul>
                </li>
                @endif
                <li>
                    <a href="{{url('auth/out')}}" onclick="return confirm('Anda yakin ?')"> <i class="menu-icon fa fa-power-off"></i> Logout</a>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </nav>
</aside><!-- /#left-panel -->

<!-- Left Panel -->