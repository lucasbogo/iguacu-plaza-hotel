@extends('customer.layout.master')

@section('heading', 'Minhas Reservas')

@section('main_content')
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="example1">
                                <thead>
                                    <tr>
                                        <th>Sequencia/Reserva</th>
                                        <th>Numero do Pedido</th>
                                        <th>Método de Pagamanento</th>
                                        <th>Data da Reserva</th>
                                        <th>Valor Pago</th>
                                        <th>Ação</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $row)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $row->order_no }}</td>
                                            <td>{{ $row->payment_method }}</td>
                                            <td>{{ $row->booking_date }}</td>
                                            <td>{{ $row->paid_amount }}</td>
                                            <td class="pt_10 pb_10">
                                                <a href="{{ route('customer.customer_invoice', $row->id) }}"
                                                    class="btn btn-primary">Detalhes</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
