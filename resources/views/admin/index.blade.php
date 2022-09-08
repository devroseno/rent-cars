@extends('admin.layouts.app')

@section('title', 'Carro mt foda')


@section('content')
    <nav class="navbar bg-light mb-5">
        <div class="container-fluid">
            <span class="navbar-text">
             Carros foda
            </span>
            <a class="badge bg-danger" href=" {{ route('logout') }}">Sair</a>
        </div>
    </nav>

    <div class="container">
        @include('components.alerts')
        <div class="row">
            <div>
                <h5>Novo carro</h5>
                <div class="card">
                    <div class="card-body">
                        <form method="post" action="{{ route('car.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="form-group mb-3">
                                    <label for="formFile" class="form-label">Foto do carro</label>
                                    <input class="form-control" type="file" id="formFile" name="image">
                                </div>

                                <div class="form-group col">
                                    <label for="name">Nome</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Nome do carro">
                                </div>

                                <div class="form-group col">
                                    <label for="name">Ano</label>
                                    <input type="text" class="form-control" id="year" name="year" placeholder="Ano do carro">
                                </div>
                            </div>

                            <div class="row mt-2">
                                <div class="form-group col">
                                    <label for="name">Cor</label>
                                    <input type="text" class="form-control" id="color" name="color" placeholder="Cor do carro">
                                </div>
                            </div>

                            <div class="row justify-content-end mt-3 me-3">
                                <button type="submit" class="btn btn-primary col-1">Enviar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="mt-5">
                <h5>Carros cadastrados</h5>
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Foto</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Ano</th>
                        <th scope="col">Cor</th>
                        <th>Dono</th>
                        <th>Status</th>
                        <th>Ação</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($cars as $car)
                        @php
                            $lastRent = $car->rent()->count() > 0 ? $car->rent()->latest()->first()->pivot : null;
                        @endphp
                        <tr>
                            <td class="align-middle">
                                <img class="rounded-circle" src="{{ url('storage/images/'.$car->image) }}" width="50px" height="50px" alt="">
                            </td>
                            <td class="align-middle">{{ $car->name }}</td>
                            <td class="align-middle">{{ $car->year }}</td>
                            <td class="align-middle">{{ $car->color }}</td>
                            <td class="align-middle">{{ $car->user->name}}</td>
                            <td class="align-middle">
                                @if($car->status == \App\Enums\CarStatus::Available->value)
                                    <span class="badge bg-success">Disponível</span>
                                    @else
                                    <span class="badge bg-warning">Ocupado</span>
                                @endif
                            </td>
                            <td class="align-middle">
                                @if($car->user_id !== auth()->user()->id)

                                    @if($car->status == \App\Enums\CarStatus::Available->value)
                                        <form action="{{ route('car.rent') }}" method="post">
                                            @csrf
                                            <input type="text" hidden name="car_id" value="{{ $car->id }}">
                                            <button class="btn btn-sm btn-success text-white">Alugar</button>
                                        </form>
                                    @else
                                        <span class="badge bg-warning">Alugado</span>
                                    @endif

                                    @if($car->status == \App\Enums\CarStatus::Occupied->value
                                        && $lastRent->devolved == false
                                        && $lastRent->user_id == auth()->user()->id)
                                        <button class="btn btn-sm btn-danger">Devolver</button>
                                    @endif

                                @else
                                    <button class="btn btn-sm btn-primary text-white">Dados</button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                {{ $cars->links() }}
            </div>
        </div>
    </div>
@endsection
