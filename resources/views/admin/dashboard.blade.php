@extends('admin.frame-public')

@section('content')
    <body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Dashboard</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3> {{ $events->count() }} </h3>

                                    <p>N° Eventi</p>
                                </div>
                                <div class="icon">
                                    <i class="icon icon-shape even text-white rounded-circle shadow"></i>
                                     <i class="fas fa-chart-pie"></i>
                                </div>
                                <a href="{{ route('admin.events') }}" class="small-box-footer"> Più Info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-danger">
                                <div class="inner">
                                    <h3> {{ $artists->count() }} </h3>

                                    <p>N° Artisti</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-headphones"></i>
                                </div>
                                <a href="{{ route('admin.artists') }}" class="small-box-footer"> Più Info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3> {{ $topics->count() }} </h3>
                                    <p>N° Topics</p>
                                </div>
                                <div class="icon">
                                    <i class="far fa-newspaper nav-icon"></i>
                                </div>
                                <a href="{{ route('admin.topics') }}" class="small-box-footer"> Più Info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-warning">
                                <div class="inner">
                                    <h3> {{ $users->count() }} </h3>

                                    <p>N° Utenti Registrati</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-users"></i>
                                </div>
                                <a href="{{ route('admin.gestione-utenti') }}" class="small-box-footer"> Più Info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                    </div>
                    <!-- /.row -->
                    <!-- Main row -->
                    <div class="row">
                        <!-- Left col -->
                        <section class="col-lg-7 connectedSortable">

                            <!-- lista eventi -->
                            <div class="card-e">
                                <div class="card-header border-transparent">
                                    <h3 class="card-title">Lista Eventi</h3>

                                    <div class="card-tools">
                                        <a href="{{ route('admin.events') }}" class="btn btn-sm btn-secondary ">Visualizza Tutti Gli Eventi</a>
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body p-0">
                                    <div class="table-responsive">
                                        <table class="table m-0">
                                            <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Nome</th>
                                                <th>Tipologia</th>
                                                <th></th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            @foreach($eventsList as $eventoList)
                                                <tr>
                                                    <td>{{ $eventoList->id }}</td>
                                                    <td>{{ $eventoList->nome }}</td>
                                                    <td>{{ $eventoList->tipologia }}</td>
                                                    <td><a href="{{ route('admin.evento', $eventoList->id) }}"><span class="badge badge-success">Visualizza</span></a></td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.table-responsive -->
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer clearfix">
                                    {{ $eventsList->links() }}
                                </div>
                                <!-- /.card-footer -->
                            </div>
                            <!-- fine lista eventi -->

                        </section>
                        <!-- /.Left col -->
                    </div>
                    <!-- /.row (main row) -->
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->
    </body>
@endsection
