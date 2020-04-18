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
            <b>No.Form</b> : 30
            <br>
            <b>No. Surat</b> : {{ $nosurat }} 
        </td>
    </tr>
    
    <tr>
        <td align=center colspan=3>
            <b><h4> SURAT PERINTAH GRADER </h4></b>
                  
        </td>
    </tr>
    <tr border=1> 
        <td align=center colspan=3>
            <h4> {{ $ipl }}</h4>  
        </td>    
    </tr>

</table>
    <p> Bersama ini, ditugaskan kepada karyawan dibawah ini : </p>
    <br>
    <table>
        @foreach($sendgraders as $sg)
            <tr>
                <td rowspan=7 width="50"> </td>
            </tr>
            <tr>
                <td> Grader</td> <td> : {{ implode(',', $sg->users()->get()->pluck('username')->toArray()) }} </td>
            </tr>
            <tr>
                <td> Keperluan</td> <td> : {{ $sg['keperluan'] }} </td>
            </tr>
            <tr>
                <td> Lokasi</td> <td> : {{ implode(',', $sg->vendors()->get()->pluck('name_vendor')->toArray()) }}</td>
            </tr>
            <tr>
                <td> Durasi</td> <td> : {{ $sg['start_date'] }} {{ $sg['end_date'] }} </td>
            </tr>
            <tr>
                <td> Uang Dinas</td> <td> : {{ $sg['uang_dinas'] }} </td>
            </tr>
            <tr>
                <td> Bank</td> <td> : {{ $sg['bank'] }} {{ $sg['rekening'] }}</td>
            </tr>
        @endforeach
    </table>
    <p> Akan melaksanakan penugasan sesuai dengan keperluan dan dalam jangka waktu yang sudah ditetapkan. </p>
    <br>
    <br>

    <table width=100% class="layout">
        <tr> 
            <td align=center height=80> Yang Mengeluarkan </td>
            <td align=center > Disetujui oleh</td>
        </tr>
        <br>
        <br>
        <tr >
            <td align=center height=80> HR & Payrol</td>
            <td align=center> Manager </td>
        </tr>

    </table>
