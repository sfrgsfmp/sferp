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
        <td align=center width="20%">
            <b>No.Form</b> : 2
            <br>
            <b>No. PIM</b> : {{ $nopim }} 
        </td>
    </tr>
    
    <tr>
        <td align=center colspan=3>
            <b><h4> PIM </h4></b>
        </td>
    </tr>
</table>
<br><br>
<h4>
<table class="layout" width=100%>
    <thead>
        <tr>
            <th> No</th>
            <th> Code</th>
            <th> NoTransport</th>
            <th> Conveyor</th>
            <th> Cara Susun</th>
            <th> Supplier</th>
            <th> Parcel</th>
            <th> PRM</th>
            <th> Species</th>
            <th> Sortimen</th>
            <th> Sertifikat</th>
            <th> FSC</th>
           
            <th> Tipe M3</th>
            <th> Est/Doc M3</th>
            <th> Date</th>
            <th> Info</th>
        </tr>
     
    </thead>
    <tbody>
       {{$no=1}}
        @foreach($pim as $p)
        <tr>
            <td> {{$no++}}</td>
            <td> {{ $p->code_pim }}</td>
            <td> {{ $p->notransport}}</td>
            <td> {{ $p->vehicle_code }} </td>
            <td> {{ $p->carasusun}}</td>
            <td> {{ $p->name_tpk }} </td>
            <td> {{ $p->noparcel }}</td>
            <td> {{ $p->noprocurement}}</td>
            <td> {{ $p->speciesname }}</td>
            <td> {{ $p->sortimen}}</td>
            <td> {{ $p->cert_code}}</td>
            <td> {{ $p->kode_fsc }} </td>
        
            <td> {{$p->typem3}} </td>
            <td> {{$p->estdocm3}}</td>
            <td> {{$p->date}}</td>
            <td> {{$p->informasilain}}</td>
            
        </tr>
        @endforeach
        
    </tbody>
</table>
</h4>

<style>
table.layout th, table.layout td, table.layout tr{
  border: 0.1mm solid black;
  border-collapse: collapse;
}

</style>