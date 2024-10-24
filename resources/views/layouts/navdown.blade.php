<!-- NAVBAR DOWN -->
<nav id="navdown" class="navbar navbar-expand-lg avbar fixed-bottom bg-light border-top d-lg-none">
    <div class="container-fluid">
        <div class="container-fluid">
            <div class="row flex-nowrap justify-content-around justify-content-md-around">
                <div class="col-auto">
                    <a href="{{ route('generals.index') }}" class="btn lh-1">
                        <i class="uil-dashboard fs-3"></i>
                        <br>
                        <medium>Dashboard</medium>
                    </a>
                </div>
                <div class="col-auto">
                    <a href="{{ route('jadwal.createJadwal') }}" class="btn lh-1">
                        <i class="uil-presentation-check fs-3"></i>
                        <br>
                        <medium>Buat Jadwal</medium>
                    </a>
                </div>
                <div class="col-auto">
                    <a href="{{ route('kunjungan.index') }}" class="btn lh-1">
                        <i class="uil-car fs-3"></i>
                        <br>
                        <medium>Kunjungan</medium>
                    </a>
                </div>
            </div>
        </div>
    </div>
</nav>
<style>
    #navdown a.btn small {
        font-size: .75em;
    }
</style>
