<table width=100%>
    <tr>
        <td align=left width="10%">
            <img style="vertical-align: top" src="{{ ('image/MIG_logo.png') }}" width="100" height="90" />
        </td>
        <td align=center width="80%"><b>
            <h3>PT. SENG FONG MOULDING PERKASA </h3></b>
            <h4>Jl. Prof. Dr. Nurcholish Madjid No 173 Tunggorono, Jombang</b> <br>
            <b>Phone : +62 321 867 222    Fax : +62 321 867 111</b> <br> </h4>
        </td>
    </tr>
    <tr>
        <td align=center colspan=3>
            <b><h4> Job Order </h4></b>
        </td>
    </tr>
</table>
<br><br>

@foreach($jo as $jj)
<table width=100% class="layout" >
    <tr>
        <td align=center rowspan="3">Raw Material Job Order</td>
        <td align=center>Tanggal</td>
        <td align=center>Dibuat</td>
        <td align=center>Procurement Mgr</td>
        <td align=center colspan="2">PRM-V4-06.04.18-FI</td>
        <td align=center colspan="2">Nomor Urut</td>
    </tr>
    <tr>
        <td align=center rowspan="2"> {{$jj->applydate}} </td>
        <td rowspan="2"></td>
        <td rowspan="2"></td>
        <td>Nomor</td>
        <td align=center rowspan="2">10</td>
        <td align=center rowspan="2" colspan="2"> {{$jj->jo}}</td>
    </tr>
    <tr>
        <td>Form</td>
    </tr>
</table>

<br>
    Permintaan Kualitas
<br>
<table  width=100% class="layout">
    <tr>
        <td align=center >Serat Miring</td>
        <td align=center>Serat Putus</td>
        <td align=center>Bengkok Lebar</td>
        <td align=center>Bengkok Tebal</td>
        <td align=center>Bergelombang Lebar</td>
        <td align=center>Bergelombang Tebal</td>
        <td align=center>Twist</td>
    </tr>
    <tr height=30>
        <td align=center height=30>{{$jj->seratmiring}}</td>
        <td align=center>{{$jj->seratputus}}</td>
        <td align=center>{{$jj->bengkoklebar}}</td>
        <td align=center>{{$jj->bengkoktebal}}</td>
        <td align=center>{{$jj->gelebar}}</td>
        <td align=center>{{$jj->geltebal}}</td>
        <td align=center>{{$jj->twist}}</td>
    </tr>
</table>

<br>
    Informasi Dan Dokumen Yang Diminta
<br>
<table  width=700 class="layout">
    <tr>
        <td align=center>Pemilik Kayu</td>
        <td align=center>Partai</td>
        <td align=center>Transaction Type</td>
        <td align=center>Species</td>
        <td align=center>Sortimen</td>
        <td align=center>Tipe</td>
        <td align=center>Verifikasi</td>
    </tr>
    <tr>
        <td align=center> {{ $jj->name_vendor}} {{ $jj->name_tpk }}</td>
        <td align=center> {{ $jj->noparcel}}</td>
        <td align=center> {{ $jj->objective_name}}</td>
        <td align=center> {{ $jj->speciesname}}</td>
        <td align=center> {{ $jj->sortimen}} </td>
        <td align=center> {{ $jj->cert_code}}</td>
        <td align=center> {{ $jj->kode_fsc}}</td>
    </tr>
    <tr>
        <td align=center colspan="2">Tujuan Dokumen</td>
        <td align=center colspan="2">Alamat Dokumen</td>
        <td align=center>Metode Transport</td>
        <td align=center>M3</td>
        <td align=center>ETA</td>
    </tr>
    <tr>
        <td align=center colspan="2" rowspan="2">PT SENG FONG MOULDING PERKASA</td>
        <td align=center rowspan="2" colspan="2">JL. PROF. DR. NURCHOLISH MADJID NO 173 TUNGGORONO</td>
        <td align=center> {{$jj->vehicle_code}} </td>
        <td align=center rowspan="2">{{$jj->estdocm3}}</td>
        <td align=center rowspan="2">{{$jj->date}}</td>
    </tr>
    <tr>
        <td align=center > {{$jj->notransport}} </td>
    </tr>
    <tr> <td align=center colspan="7">Dokumen</td> </tr>
    <tr>
        <td colspan="7">{{$jj->document}}</td>
    </tr>
</table>
<br>
Instruksi Kerja
<br>
<table width=100% class="layout">
    <tr>
        <td align=center colspan="7">Cara Ukur/Scalling Methode</td>
    </tr>
    <tr>
        <td colspan="7">{{ $jj->measurement}}</td>
    </tr>
    <tr>
        <td align=center colspan="7">Instruksi Lain Lain</td>
    </tr>
    <tr>
        <td colspan="7">{{$jj->qualitynote}}</td>
    </tr>
</table>
<br>
<table  width=100% class="layout">
    <tr>
        <td align=center width="10%">Bongkar/Muat</td>
        <td align=center width="10%">Telly</td>
        <td align=center width="10%">TT/SJ</td>
        <td align=center width="10%">TUK</td>
        <td align=center width="10%">Lokasi Grade</td>
        <td align=center width="10%">Lokasi Simpan</td>
        <td align=center width="10%">Lokasi Tahan</td>
    </tr>
    <tr>
        <td> {{$jj->contractor}}</td>
        <td></td>
        <td></td>
        <td>{{$jj->tuk}}</td>
        <td align=center>{{$jj->whgrader}}</td>
        <td align=center>{{$jj->whsimpan}}</td>
        <td align=center>{{$jj->whtahan}}</td>
    </tr>
</table>
<br>
<table width=100% class="layout">
    <tr>
        <td align=center width="10%">Tim Grader D1</td>
        <td align=center width="10%">Tim Grader D2</td>
        <td align=center width="10%">Tim Grader P1</td>
        <td align=center width="10%">Tim Grader P2</td>
        <td align=center width="10%">Tim 1 Inspector</td>
        
    </tr>
    <tr height="50">
        <td height="50"></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        
    </tr>
</table>
@endforeach
<style>
    table.layout th, table.layout td, table.layout tr{
        border: 0.1mm solid black;
        border-collapse: collapse;
    }
</style>