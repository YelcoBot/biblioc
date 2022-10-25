@extends('partials.mainlayout')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header alt">
                    <h3 class="title-3 m-b-30">
                        <i class="zmdi zmdi-account-calendar"></i>{{ $libro->titulo }}
                    </h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <embed src="{{ $libro->urlarchivo }}" width="100%" height="650" type="application/pdf">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
