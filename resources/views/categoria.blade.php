@extends('partials.mainlayout')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header alt">
                    <div class="row">
                        <div class="col-9">
                            <h3 class="title-3 m-b-30">
                                <i class="zmdi zmdi-account-calendar"></i>Categorias
                            </h3>
                        </div>
                        <div class="col-3">
                            <button id="BtnNewCategoria" type="button" class="btn btn-primary"><i
                                    class="fa fa-plus"></i>&nbsp;&nbsp;Nueva Categoria</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <!-- DATA TABLE-->
                            <div class="table-responsive m-b-40">
                                <table id="TableCategoria" class="table table-borderless table-data3" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- END DATA TABLE-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
