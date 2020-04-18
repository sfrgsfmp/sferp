<style>


table.layout {
    border-collapse: collapse;
    table-layout: auto;
    width: 100%;  
    border: 1px solid black;
}
/* table.c.td {
    border: 1px solid black;
} */

</style>
<table width=100% class="layout">
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
            
        </td>
    </tr>
    
    <tr>
        <td align=center colspan=3>
            <b><h4> LAPORAN HASIL GRADER </h4></b>
            
        @foreach($send as $s)
                {{ $s->noipl }}
                  <br>
                {{ $s->surat_perintah }}
                
            
        </td>
    </tr>
    

</table>

<table class="table table-bordered">
  
    <tr>
        <td> Nama </td> <td> {{ implode(',', $s->users()->get()->pluck('username')->toArray()) }} </td>
    </tr>
    <tr>
        <td> Keperluan </td> <td> {{$s->keperluan}}</td>
    </tr>
    <tr>
        <td> Terima Uang</td> <td> {{$s->uang_dinas}} </td>
    </tr>
    <tr>
        <td> Lama Tugas</td> <td> {{$s->start_date}} - {{$s->end_date}} </td>
    </tr>
    @endforeach
    
    
</table>

<table class="c" border=1 width="100%" style="width:100%">
    <thead>
        <tr>
            <td> Kendaraan</td>
            <td> Tanggal</td>
            <td> Tipe Biaya</td>
            <td> Keterangan </td>
            <td> Btg</td>
            <td> M3</td>
            <td> Harga/M3</td>
            <td> Biaya </td>
        </tr>
    </thead>
    <tbody>
        
        @foreach($result as $gr)
            <tr>
                <td> {{ $gr->nokendaraan }} </td>
                <td> {{ $gr->date }}</td>
                <td> {{ $gr->tipebiaya}}</td>
                <td> {{ $gr->keterangan}}</td>
                <td align="center"> {{ $gr->btg}}</td>
                <td align="center"> {{ $gr->m3}}</td>
                <td align="center"> {{ $gr['harga/m3'] }}</td>
                <td align="center"> {{ $gr->biaya }} </td>
            </tr>
        @endforeach
            <tr>
                <td colspan=7 align="left"> Total </td>
                <td align="center"> Rp. <b> {{ $result->sum('biaya') }} </b> </td>
            </tr>
    </tbody>
</table>

<table width=100% class="layout">
        <tr> 
            <td align=center height=80> Dibuat </td>
            <td align=center > Disetujui oleh</td>
        </tr>
        <br>
        <br>
        <tr >
        @foreach($send as $b)
            <td align=center height=80> {{ implode(',', $b->users()->get()->pluck('username')->toArray()) }} </td>
        @endforeach

        
        <?php $var = ""; ?>
        @foreach($result as $r)
        <?php
        $by = $r['approval_statusby'];
        $nameby =  implode(',', $r->users()->get()->pluck('username')->toArray()) ;
            if($var != $nameby)
            {
                $var = $nameby;
                $vars = $nameby;
                
            }
            else
            {
                $vars = "";
                
            }
        ?>
            <td align=center> {{ $vars }}  </td>
        @endforeach
        </tr>

    </table>