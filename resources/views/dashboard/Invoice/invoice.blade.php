<!-- resources/views/dashboard/Invoice/invoice.blade.php -->

@extends('layouts.base')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h3>Invoices</h3>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createInvoiceModal">
                            Create Invoice
                        </button>
                    </div>
                    <table class="table table-striped text-center">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Payment Method</th>
                                <th>Reservation ID</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($Invoices as $invoice)
                            <tr>
                                <td>{{ $invoice->id }}</td>
                                <td>{{ $invoice->paymentMethod }}</td>
                                <td>{{ $invoice->reservationId }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Create Invoice Modal -->
<div class="modal fade" id="createInvoiceModal" tabindex="-1" aria-labelledby="createInvoiceModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createInvoiceModalLabel">Create Invoice</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('createInvoice') }}">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="paymentMethod" class="text-black">Payment Method</label>
                        <input type="text" class="form-control" id="paymentMethod" name="paymentMethod" required>
                    </div>
                    <div class="mb-3">
                        <label for="reservationId" class="text-black">Reservation ID</label>
                        <input type="text" class="form-control" id="reservationId" name="reservationId" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
