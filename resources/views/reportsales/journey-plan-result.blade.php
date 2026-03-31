<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Journey Plan - {{ $user->name }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://unpkg.com/xlsx/dist/xlsx.full.min.js"></script>
    <style>
        @media print {
            .no-print { display: none; }
            body { padding: 0; margin: 0; }
            .container-fluid { width: 100% !important; }
        }
        table { width: 100%; border-collapse: collapse; font-size: 12px; }
        th, td { border: 1px solid #333; padding: 6px; text-align: center; }
        th { background-color: #76933c; color: white; vertical-align: middle; }
        .customer-name { text-align: left; background-color: #f2f2f2; }
        .new-customer { background-color: #c6e0b4 !important; } /* Light green background for new customers */
        .grand-total { background-color: #f2f2f2; font-weight: bold; }
        .grand-total-header { background-color: #76933c; color: white; }
        .analisa-section { margin-top: 20px; font-size: 14px; }
        .analisa-title { font-weight: bold; text-decoration: underline; margin-bottom: 5px; }
    </style>
</head>
<body>
    <div class="container-fluid py-4">
        <div class="d-flex justify-content-between align-items-center mb-4 no-print">
            <h3>Report Journey Plan</h3>
            <div>
                <button class="btn btn-success" onclick="exportToExcel()">Export to Excel</button>
                <button class="btn btn-primary" onclick="window.print()">Print Report</button>
                <button class="btn btn-secondary" onclick="window.close()">Close</button>
            </div>
        </div>

        <table class="table table-bordered" id="report-table">
            <thead>
                <tr>
                    <th rowspan="2" style="width: 50px;">No</th>
                    <th rowspan="2">Nama Customer</th>
                    <th colspan="{{ count($months) }}">Bulan</th>
                    <th rowspan="2" style="width: 100px;">Grand Total</th>
                </tr>
                <tr>
                    @foreach($months as $month)
                        <th>{{ explode(' ', $month)[0] }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @php $no = 1; @endphp
                @foreach($pivotData as $id => $data)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td class="customer-name {{ $data['is_new'] ? 'new-customer' : '' }}">
                            {{ $data['name'] }}
                        </td>
                        @foreach($months as $month)
                            <td>{{ $data['months'][$month] > 0 ? $data['months'][$month] : '' }}</td>
                        @endforeach
                        <td class="grand-total">{{ $data['total'] }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr class="grand-total">
                    <td colspan="2" class="text-start ps-3">Grand Total</td>
                    @foreach($months as $month)
                        <td>{{ $monthlyGrandTotal[$month] }}</td>
                    @endforeach
                    <td>{{ $overallTotal }}</td>
                </tr>
            </tfoot>
        </table>

        <div class="analisa-section" id="analisa-section">
            <p><strong>Sales : {{ $user->name }}</strong></p>
            <p><strong>Periode : {{ $startDate->format('d/m/Y') }} - {{ $endDate->format('d/m/Y') }}</strong></p>
            <p class="analisa-title">Analisa :</p>
            <ul id="analisa-list">
                <li>{{ $analysis['trend'] }}</li>
                <li>ada {{ $analysis['new_cust_count'] }} customer baru di tambahkan selama periode ini</li>
                @foreach($months as $month)
                    <li>customer baru yang dikunjungi bulan {{ $month }} : {{ $newCustPerMonth[$month] }} customer</li>
                @endforeach
                <li>ada {{ $analysis['single_visit_count'] }} customer hanya di visit 1 kali</li>
                <li>dalam {{ $analysis['period_months'] }} bulan dapat {{ $analysis['total_customers'] }} customer, rata2 perhari {{ $analysis['avg_new_cust'] }} customer</li>
                <li>dalam {{ $analysis['period_months'] }} bulan visit {{ $analysis['total_visits'] }} kali, rata2 perhari {{ $analysis['avg_visits'] }} visit</li>
                @if($analysis['avg_visits'] < 4)
                    <li>hanya tercapai dibawah target minimal visit perhari nya (4 customer/hari)</li>
                @else
                    <li>mencapai atau melebihi target minimal visit perhari nya (4 customer/hari)</li>
                @endif
            </ul>
        </div>
    </div>

    <script>
        function exportToExcel() {
            // Get table
            var table = document.getElementById('report-table');

            // Create a new workbook
            var wb = XLSX.utils.book_new();

            // 1. Convert Table to Worksheet
            // Using aoa to handle merging and custom headers if needed,
            // but table_to_sheet is simpler for standard tables.
            var ws = XLSX.utils.table_to_sheet(table);

            // 2. Extract Analisa section as rows
            var salesName = "Sales : {{ $user->name }}";
            var range = "Periode : {{ $startDate->format('d/m/Y') }} - {{ $endDate->format('d/m/Y') }}";
            var analysisData = [
                [""], // Empty row
                [salesName],
                [range],
                ["Analisa :"]
            ];

            var listItems = document.querySelectorAll('#analisa-list li');
            listItems.forEach(function(item) {
                analysisData.push(["- " + item.innerText.trim()]);
            });

            // Append analysis data to worksheet
            XLSX.utils.sheet_add_aoa(ws, analysisData, { origin: -1 }); // append to end

            // Add worksheet to workbook
            XLSX.utils.book_append_sheet(wb, ws, "Journey Plan Report");

            // Generate Excel file
            var filename = "Report-Journey-Plan-{{ $user->name }}-" + new Date().getTime() + ".xlsx";
            XLSX.writeFile(wb, filename);
        }
    </script>
</body>

</html>
