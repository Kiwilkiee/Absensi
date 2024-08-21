@extends('layouts.app')

@section('title', 'Absensi')

@section('content')
    <h3 class="justify-content-center">Absensi</h3>
    <div id="userInfo" class="mb-3">
        <strong>Nama:</strong> <span id="userNama"></span><br>
        <strong>Jabatan:</strong> <span id="userPosition"></span>
    </div>
    <button id="absenButton" class="btn btn-primary mb-2" onclick="handleAbsenMasuk()">Absen Masuk</button>
    <div id="masukTime" class="time-info mb-2"></div>
    <button id="absenButtonPulang" class="btn btn-danger" onclick="handleAbsenPulang()">Absen Pulang</button>
    <div id="pulangTime" class="time-info"></div>
@endsection

@push('scripts')
<script src="{{ asset('asset/js/absensi.js') }}"></script>
@endpush
