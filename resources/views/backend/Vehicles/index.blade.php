<!-- resources/views/salespeople/index.blade.php -->
@extends('backend.layouts.app')

@section('title', '| Vehicles Management')

@section('breadcrumb')
    <div class="page-header">
        <h1 class="page-title">Vehicles List</h1>
        <div>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Vehicles</li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
    <div class="card">
        <div class="card-header justify-content-between">
            <h3 class="card-title font-weight-bold">Vehicles</h3>
            @can('add_salesperson')
                <button type="button" class="btn dark-icon btn-primary" data-act="ajax-modal" data-method="get"
                    data-action-url="{{ route('salespeople.create') }}" data-title="Add New Salesperson">
                    <i class="ri-add-fill"></i> Add Vehicles
                </button>
            @endcan
        </div>
        <div class="card-body">
            <!-- Add Salesperson Form -->
            <form action="{{ route('Vehicles.store') }}" method="POST">
                @csrf
                <div class="form-group">
<select name="year" id="year">
    @foreach($years as $year)
    <option value="{{ $year }}">{{ $year }}</option>
@endforeach
</select>

<select name="make" id="make">
    @foreach($makes as $make)
        <option value="{{ $make }}">{{ $make }}</option>
    @endforeach
</select>

<select name="model" id="model">
    @foreach($models as $model)
        <option value="{{ $model }}">{{ $model }}</option>
    @endforeach
</select>

                </div>
                <div class="form-group">
                    <label for="fg_color">FG Color:</label>
                                        <select id="fg_color" name="fg_color">
                    <option value="CCCCCC" style="background-color:#CCCCCC; color:#000000;">CCCCCC</option>
                    <option value="666666" style="background-color:#fFFFFF; color:#000000;">666666</option>  
                                        </select>
                </div>
                <div class="form-group">
                    <label for="bg_color">BG Color:</label>
                    <select id="bg_color" name="bg_color">
                        <option value="CCCCCC" style="background-color:#CCCCCC; color:#000000;">CCCCCC</option>
                        <option value="666666" style="background-color:#666666; color:#000000;">666666</option>
                        <option value="999999" style="background-color:#999999; color:#000000;">999999</option>
                        <option value="CCFFFF" style="background-color:#CCFFFF; color:#000000;">CCFFFF</option>
                        <option value="66FFFF" style="background-color:#66FFFF; color:#000000;">66FFFF</option><option value="00CCCC" style="background-color:#00CCCC; color:#000000;">00CCCC</option><option value="009999" style="background-color:#009999; color:#000000;">009999</option><option value="66CCFF" style="background-color:#66CCFF; color:#000000;">66CCFF</option><option value="3366FF" style="background-color:#3366FF; color:#000000;">3366FF</option><option value="3333FF" style="background-color:#3333FF; color:#000000;">3333FF</option><option value="FFCCCC" style="background-color:#FFCCCC; color:#000000;">FFCCCC</option><option value="FF9999" style="background-color:#FF9999; color:#000000;">FF9999</option><option value="FF6666" style="background-color:#FF6666; color:#000000;">FF6666</option><option value="FF3333" style="background-color:#FF3333; color:#000000;">FF3333</option><option value="FFFFCC" style="background-color:#FFFFCC; color:#000000;">FFFFCC</option><option value="FFFF66" style="background-color:#FFFF66; color:#000000;">FFFF66</option><option value="FFFF00" style="background-color:#FFFF00; color:#000000;">FFFF00</option><option value="CCCC00" style="background-color:#CCCC00; color:#000000;">CCCC00</option><option value="999900" style="background-color:#999900; color:#000000;">999900</option><option value="CCFFCC" style="background-color:#CCFFCC; color:#000000;">CCFFCC</option><option value="99FF99" style="background-color:#99FF99; color:#000000;">99FF99</option><option value="33FF33" style="background-color:#33FF33; color:#000000;">33FF33</option><option value="00CC00" style="background-color:#00CC00; color:#000000;">00CC00</option><option value="009900" style="background-color:#009900; color:#000000;">009900</option><option value="CCCCFF" style="background-color:#CCCCFF; color:#000000;">CCCCFF</option><option value="9966FF" style="background-color:#9966FF; color:#000000;">9966FF</option><option value="FFCCFF" style="background-color:#FFCCFF; color:#000000;">FFCCFF</option><option value="FF33FF" style="background-color:#FF33FF; color:#000000;">FF33FF</option><option value="CC00CC" style="background-color:#CC00CC; color:#000000;">CC00CC</option><option value="FFCC99" style="background-color:#FFCC99; color:#000000;">FFCC99</option><option value="FF6633" style="background-color:#FF6633; color:#000000;">FF6633</option><option value="CCCC66" style="background-color:#CCCC66; color:#000000;">CCCC66</option><option value="4B8A17" style="background-color:#4B8A17; color:#000000;">4B8A17</option><option value="993300" style="background-color:#993300; color:#000000;">993300					</option></select>
                </div>
               
                <div class="form-group">
                    <label for="status">Active:</label>
                    <input type="checkbox" id="status" name="status"  checked>
                </div>
                <button type="submit" class="btn btn-primary">Add Salesperson</button>
            </form>

            <!-- Salespeople DataTable -->
            <div class="table-responsive mt-4">
                <table id="salesperson_datatable" class="table table-bordered text-nowrap key-buttons border-bottom w-100">
                    <thead>
                        <tr>
                            <th class="border-bottom-0">#</th>
                            <th class="border-bottom-0">Name</th>

                            <th class="border-bottom-0">Order</th>
                            <th class="border-bottom-0">Color</th>

                            <th class="border-bottom-0">Active</th>
                        </tr>
                    </thead>
                    <tbody>
                       
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
     $(function() {
    $('#vehicles_datatable').DataTable({
        ajax: '{{ route('salesperson-datatable') }}',
        processing: true,
        serverSide: true,
        scrollX: false,
        searching:false,
        autoWidth: true,
        columnDefs: [{
                width: 0,
                targets: 1
            },
            {
                width: '2%',
                targets: 0
            },
            {
                orderable: true, // Disable sorting for the action column
                targets: -3 // Targets the last column
            }
        ],
        columns: [
            {
                data: 'DT_RowIndex',
                name: 'id'
            },
            {
                data: 'name',
                name: 'name'
            },
           
            {
                data: 'order',
                name: 'order'
            },
            {
                data: 'fg_color',
                name: 'color'
            },
            {
                data: 'status',
                name: 'active'
            }

            
        ]
    });
    

});

</script>
@endpush
