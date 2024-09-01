@extends('layout')

@section('title')
    Storehouse
@endsection



@section('body')
    <div class="container">
        <h1 class="text-center text-dark fw-bold mt-4">Dashboard</h1>
        {{-- Counts --}}
        <div class="row g-4">
            <div class="col-sm-6 col-xl-3">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-chart-line fa-3x text-primary"></i>
                    <div class="ms-3 text-center">
                        <p class="mb-2">Stocks</p>
                        <h6 class="mb-0 fw-bold">{{ $stockCt }}</h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="bg-success rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-chart-line fa-3x text-light"></i>
                    <div class="ms-3 text-center text-light">
                        <p class="mb-2">Sales</p>
                        <h6 class="mb-0">${{ $salesCt }}</h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="bg-danger rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-chart-line fa-3x text-light"></i>
                    <div class="ms-3 text-center text-light">
                        <p class="mb-2">Purchases</p>
                        <h6 class="mb-0">${{ $purchaseCt }}</h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-chart-line fa-3x text-light"></i>
                    <div class="ms-3 text-center text-light">
                        <p class="mb-2">Pending tasks</p>
                        <h6 class="mb-0">{{ $tasksCt }}</h6>
                    </div>
                </div>
            </div>
        </div>

        {{-- Tables --}}
        {{-- Warehouse --}}
        <div class="shadow p-3 mb-5 bg-body-tertiary rounded rounded h-auto p-4 mt-5">
            <div class="d-flex justify-content-between">
                <h6 class="mb-4">Storhouse</h6>
                <a href="{{ route('warehouse.warehouse') }}">See all</a>
            </div>
            <div class="table-responsive">
                <table class="table text-center">
                    <thead>
                        <tr>
                            <th scope="col">Product</th>
                            <th scope="col">Type</th>
                            <th scope="col">Quantity</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($stock as $stock)
                            <tr>
                                <td>{{ $stock->category->name }}</td>
                                <td>{{ $stock->purchase->type }}</td>
                                <td>{{ $stock->quantity }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <hr>
        {{-- Sales & Purchases --}}
        <div class="row gap-2">
            <div class="col shadow p-3 mb-5 bg-body-tertiary rounded rounded h-auto p-4 mt-5 column">
                <div class="d-flex justify-content-between">
                    <h6 class="mb-4">Sales</h6>
                    <a href="{{ route('sales.sales') }}">See all</a>
                </div>
                <div class="table-responsive">
                    <table class="table text-center">
                        <thead>
                            <tr>
                                <th scope="col">Customer</th>
                                <th scope="col">Product</th>
                                <th scope="col">Type</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Price</th>
                                <th scope="col">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sales as $sale)
                                <tr>
                                    <td>{{ $sale->customer->name }}</td>
                                    <td>{{ $sale->category->name }}</td>
                                    <td>{{ $sale->purchase->type }}</td>
                                    <td>{{ $sale->quantity }}</td>
                                    <td>{{ $sale->price }}</td>
                                    <td>{{ $sale->total }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col shadow p-3 mb-5 bg-body-tertiary rounded rounded h-auto p-4 mt-5 column">
                <div class="d-flex justify-content-between">
                    <h6 class="mb-4">Purchases</h6>
                    <a href="{{ route('purchases.purchases') }}">See all</a>
                </div>
                <div class="table-responsive">
                    <table class="table text-center">
                        <thead>
                            <tr>
                                <th scope="col">Product</th>
                                <th scope="col">Type</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Price</th>
                                <th scope="col">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($purchases as $purchase)
                                <tr>
                                    <td>{{ $purchase->category->name }}</td>
                                    <td>{{ $purchase->comment }}</td>
                                    <td>{{ $purchase->quantity }}</td>
                                    <td>{{ $purchase->price }}</td>
                                    <td>{{ $purchase->total }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <hr>
        {{-- Tasks --}}
        <div class="shadow p-3 mb-5 bg-body-tertiary rounded rounded h-auto p-4 mt-5">
            <div class="d-flex justify-content-between">
                <h6 class="mb-4">Tasks</h6>
                <a href="{{ route('tasks.tasks') }}">See all</a>
            </div>
            <div class="table-responsive">
                <table class="table text-center">
                    <thead>
                        <tr>
                            <th scope="col">Title</th>
                            <th scope="col">Start date</th>
                            <th scope="col">Due date</th>
                            <th scope="col">status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tasks as $task)
                            <tr>
                                <td>{{ $task->title }}</td>
                                <td>{{ $task->start_date }}</td>
                                <td>{{ $task->due_date }}</td>
                                @if ($task->status === 'pending')
                                    <td class="text-secondary fw-bold">{{ ucfirst($task->status) }}</td>
                                @elseif ($task->status === 'done')
                                    <td class="text-success fw-bold">{{ ucfirst($task->status) }}</td>
                                @else
                                    <td class="text-danger fw-bold">{{ ucfirst($task->status) }}</td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
