<table>
    <thead style="">
        <tr>
            <th style="width: 25px; font-weight: bold;">No</th>
            <th style="width: 90px; font-weight: bold;">ID Customer</th>
            <th style="width: 150px; font-weight: bold;">ID Outlet</th>
            <th style="width: 70px; font-weight: bold;">Type Usaha</th>
            <th style="width: 200px; font-weight: bold;">Nama Outlet</th>
            <th style="width: 120px; font-weight: bold;">Outlet Type</th>
            <th style="width: 200px; font-weight: bold;">Address Type</th>
            <th style="width: 400px; font-weight: bold;">Alamat</th>
            <th style="width: 90px; font-weight: bold;">provinsi</th>
            <th style="width: 110px; font-weight: bold;">Kota</th>
            <th style="width: 150px; font-weight: bold;">Kecamatan</th>
            <th style="width: 200px; font-weight: bold;">Kelurahan</th>
            <th style="width: 70px; font-weight: bold;">Kode Pos</th>
            <th style="width: 80px; font-weight: bold;">Latitude</th>
            <th style="width: 80px; font-weight: bold;">Longitude</th>
            <th style="width: 200px; font-weight: bold;">Nama Lengkap</th>
            <th style="width: 70px; font-weight: bold;">Jabatan</th>
            <th style="width: 150px; font-weight: bold;">No Handphone</th>
            <th style="width: 200px; font-weight: bold;">Email</th>
            <th style="width: 250px; font-weight: bold;">Brand</th>
            <th style="width: 100px; font-weight: bold;">Status Outlet</th>
            <th style="width: 300px; font-weight: bold;">Remarks</th>
            <th style="width: 100px; font-weight: bold;">AR</th>
        </tr>
    </thead>
    <tbody>
    @php $no = 1 @endphp
    @foreach($outlets as $data)
        <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $data->id_customer }}</td>
            <td>{{ $data->id_outlet }}</td>
            <td>{{ $data->type_usaha }}</td>
            <td>{{ $data->nama_outlet }}</td>
            <td>{{ $data->outlet_type }}</td>
            <td>{{ $data->address_type }}</td>
            <td>{{ $data->alamat }}</td>
            <td>{{ $data->provinsi }}</td>
            <td>{{ $data->kota }}</td>
            <td>{{ $data->kecamatan }}</td>
            <td>{{ $data->kelurahan }}</td>
            <td>{{ $data->kode_pos }}</td>
            <td>{{ $data->latitude }}</td>
            <td>{{ $data->longitude }}</td>
            <td>{{ $data->nama_lengkap }}</td>
            <td>{{ $data->jabatan }}</td>
            <td>{{ $data->no_telpon }}</td>
            <td>{{ $data->email }}</td>
            <td>{{ $data->brand }}</td>
            <td>{{ $data->status }}</td>
            <td>{{ $data->remarks }}</td>
            <td>{{ $data->ar }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
