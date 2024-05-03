<table>
    <thead style="">
        <tr>
            <th style="width: 25px; font-weight: bold;">No</th>
            <th style="width: 80px; font-weight: bold;">ID Customer</th>
            <th style="width: 90px; font-weight: bold;">Type Usaha</th>
            <th style="width: 100px; font-weight: bold;">Nama Usaha</th>
            <th style="width: 200px; font-weight: bold;">Nama Lengkap</th>
            <th style="width: 400px; font-weight: bold;">Alamat Kantor</th>
            <th style="width: 70px; font-weight: bold;">Jabatan</th>
            <th style="width: 100px; font-weight: bold;">No Telepon</th>
            <th style="width: 150px; font-weight: bold;">No Handphone</th>
            <th style="width: 200px; font-weight: bold;">Email</th>
            <th style="width: 250px; font-weight: bold;">Website</th>
            <th style="width: 200px; font-weight: bold;">No NPWP</th>
            <th style="width: 250px; font-weight: bold;">Nama NPWP</th>
            <th style="width: 400px; font-weight: bold;">Alamat NPWP</th>
            <th style="width: 200px; font-weight: bold;">NIK</th>
            <th style="width: 100px; font-weight: bold;">Jumlah Outlet</th>
            <th style="width: 100px; font-weight: bold;">AR</th>
        </tr>
    </thead>
    <tbody>
    @php $no = 1 @endphp
    @foreach($generals as $data)
        <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $data->id_customer }}</td>
            <td>{{ $data->type_usaha }}</td>
            <td>{{ $data->nama_usaha }}</td>
            <td>{{ $data->nama_lengkap }}</td>
            <td>{{ $data->alamat_kantor }}</td>
            <td>{{ $data->jabatan }}</td>
            <td>{{ $data->telepon }}</td>
            <td>{{ $data->mobile_phone }}</td>
            <td>{{ $data->email }}</td>
            <td>{{ $data->web_site }}</td>
            <td>{{ $data->no_npwp }}</td>
            <td>{{ $data->nama_npwp }}</td>
            <td>{{ $data->alamat_npwp }}</td>
            <td>{{ $data->nik }}</td>

            @php
                $get_outlet = DB::table('outlet')
                                ->where('id_customer', $data->id_customer)
                                ->get();
                $jumlah_outlet = $get_outlet->count();
            @endphp

            <td>{{ $jumlah_outlet }}</td>
            <td>{{ $data->ar }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

