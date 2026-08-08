<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Report Hasil Tes</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        h3 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
        }

        th,
        td {
            padding: 5px;
            text-align: left;
        }

        .detail {
            width: fit-content;
        }

        .detail tr td:nth-child(1) {
            width: 30%;
            background-color: #efefef;
        }

        table tr td,
        p {
            font-size: .9em;
            font-weight: 400;
        }

        .deskripsi tr td.topheader {
            background-color: #efefef;
        }

        .bungkus {
            position: relative;
        }

        .deskripsi {
            border: 1.5px solid #ddd;
            font-size: .95em !important;
        }

        .deskripsi p {
            margin-top: 5px;
            font-size: .95em !important;
        }

        .deskripsi .deskripsi-header,
        .deskripsi .deskripsi-content {
            padding: 5px;
        }

        .deskripsi .deskripsi-header {
            background-color: #efefef;
            border-bottom: 1.5px solid #ddd;
        }

        .deskripsi ul {
            padding-left: 30px;
            margin-bottom: 20px;
        }

    </style>
</head>

<body>
<h3>DATA PERSONAL</h3>
<table class="detail">
    <tr>
        <td>Nama Peserta</td>
        <td>{{ $data->name }}</td>
    </tr>
    <tr>
        <td>Tanggal Lahir</td>
        <td>{{ \Carbon\Carbon::parse($data->tanggal_lahir)->locale('id')->translatedFormat('d F Y') }}</td>
    </tr>
    <tr>
        <td>Pendidikan Terakhir</td>
        <td>{{ $data->pendidikan_terakhir }}</td>
    </tr>
    <tr>
        <td>Jabataan</td>
        <td>{{$data->jabatan}}</td>
    </tr>
    <tr>
        <td>Instansi</td>
        <td>{{$data->instansi}}</td>
    </tr>
    <tr>
        <td>Tanggal Test</td>
        <td>{{ \Carbon\Carbon::parse($data->created_at)->locale('id')->translatedFormat('l, d F Y') }}</td>
    </tr>
</table>
<h3 style="margin-bottom: 0">HASIL ARAH BIDANG MINAT INDIVIDU</h3>
<img src="data:image/png;base64, {{$chartBase64}}" alt="Chart Image" class="image-canvas" width="500px" style="margin-top: 20px; padding-left: 100px">
<h3>DESKRIPSI KIPRAH KERJA</h3>
<h3>BERDASARKAN MINAT DOMINAN INDIVIDU</h3>
<p>Dari hasil Holland Test yang telah dilakukan, berikut merupakan gambaran minat dominan individu ditinjau dari 3
    peringkat teratas:</p>

@php

    $userResults = $dataResultTest->where('user_id', $data->user_id);

    $grandTotalKodeYa = ['R' => 0, 'I' => 0, 'A' => 0, 'S' => 0, 'E' => 0, 'C' => 0];
    $grandTotalKodeTidak = ['R' => 0, 'I' => 0, 'A' => 0, 'S' => 0, 'E' => 0, 'C' => 0];

    foreach ($userResults as $result) {
        $kode = $result->question->code;

        if (isset($grandTotalKodeYa[$kode]) && !is_null($result->multiple_choice)) {
            if (strtolower($result->multiple_choice) === 'ya') {
                $grandTotalKodeYa[$kode] += 1;
            } elseif (strtolower($result->multiple_choice) === 'tidak') {
                $grandTotalKodeTidak[$kode] += 1;
            }
        }
    }

    // Urutkan berdasarkan nilai "Ya" terbesar
    $sortedYa = collect($grandTotalKodeYa)->sortDesc();
    $top3Ya = $sortedYa
        ->filter(function ($value, $key) use ($sortedYa) {
            return $value >= $sortedYa->values()->take(3)->last();
        })
        ->keys();

    // Urutkan berdasarkan nilai "Tidak" terbesar
    $sortedTidak = collect($grandTotalKodeTidak)->sortDesc();
    $top3Tidak = $sortedTidak
        ->filter(function ($value, $key) use ($sortedTidak) {
            return $value >= $sortedTidak->values()->take(3)->last();
        })
        ->keys();
@endphp

<div class="deskripsi">
    @foreach ($top3Ya as $index => $kode)
        @if ($index >= 3)
            @break
        @endif
        <div class="deskripsi-header">
            #{{ $loop->iteration }}
            @switch($kode)
                @case('R')
                    Realistic
                    @break
                @case('I')
                    Investigative
                    @break
                @case('A')
                    Artistic
                    @break
                @case('S')
                    Social
                    @break
                @case('E')
                    Enterprising
                    @break
                @case('C')
                    Conventional
                    @break
                @default
                    Unknown
            @endswitch
        </div>
        <div class="deskripsi-content">
            @if($kode == "R")
                <p><b>Tipikal Personal:</b></p>
                <ul>
                    <li>Praktis, menyukai kegiatan fisik, dan cenderung mandiri</li>
                    <li>Secara fisik jasmani cenderung kuat dan memiliki koordinasi motorik yang baik</li>
                    <li>Rasional, suka bekerja dengan alat dan mesin, atau dalam lingkungan alami</li>
                    <li>Tidak terlalu menyukai interaksi sosial yang mendalam, lebih nyaman dalam situasi yang terukur
                    </li>
                    <li>Cenderung kurang terampil dalam kemampuan verbal untuk mengomunikasikan pemikiran/ide, demikian
                        juga dalam konteks keterampilan interpersonal
                    </li>
                    <li>Menyukai tugas yang bersifat langsung dan konkret, memiliki kecenderungan untuk menyelesaikan
                        masalah dengan tangan sendiri
                    </li>
                    <li>Cenderung teguh pendirian, pemalu, hati-hati</li>
                    <li>Kondisi emosional cukup stabil, tenang, meskipun ada potensi bersikap agresi</li>
                </ul>

                <p><b>Karakteristik Kondisi Kerja yang Sesuai:</b></p>
                <ul>
                    <li>Lingkungan Kerja: pekerjaan di luar ruangan atau yang memungkinkan penggunaan alat dan mesin
                    </li>
                    <li>Tugas: kegiatan yang melibatkan keterampilan praktis, seperti perbaikan, konstruksi, atau
                        produksi
                    </li>
                    <li>Struktur: situasi kerja yang terorganisir dan terencana, memiliki prosedur kerja yang jelas</li>
                    <li>Kemandirian: kebebasan untuk membuat keputusan praktis dan menyelesaikan tugas secara mandiri
                    </li>
                </ul>

                <p><b>Deskripsi Bidang Minat:</b></p>
                <p>Suka bekerja terutama dengan tangan, membuat, memperbaiki, merakit atau membangun sesuatu,
                    menggunakan dan mengoperasikan alat atau mesin, serta seringkali lebih menyukai bekerja di luar
                    ruangan.</p>

                <p><b>Keterampilan Kunci:</b></p>
                <ul>
                    <li>Menggunakan dan mengoperasikan alat/peralatan dan mesin</li>
                    <li>Merancang, membangun, memperbaiki</li>
                    <li>Bekerja secara manual</li>
                    <li>Bekerja dengan detail</li>
                    <li>Mengemudi, bergerak, mengukur</li>
                    <li>Merawat hewan, bekerja dengan tanaman</li>
                    <li>Menjalankan pekerjaan yang berhubungan dengan teknik, otomotif atau pertanian</li>
                    <li>Memecahkan masalah dan mengatasi tantangan/situasi dengan kekuatan fisik</li>
                </ul>

                <p><b>Perihal yang Dianggap Penting:</b></p>
                <ul>
                    <li>Hasil kerja yang nyata dan terukur</li>
                    <li>Kesempatan untuk melihat hasil langsung dari usaha yang dilakukan</li>
                    <li>Lingkungan aman dan teratur</li>
                    <li>Kemandirian dalam menyelesaikan tugas</li>
                </ul>

                <p><b>Rekomendasi Pekerjaan:</b></p>
                <p>Pekerja terlatih (mekanik, operator, montir, teknisi, teknolog komputer), pengemudi kendaraan (sopir,
                    pilot, masinis, pengemudi alat berat, nahkoda, dll), petani, hortikulturan, insinyur, personel
                    angkatan bersenjata, tukang kebun, olahragawan, pengawas hutan, penyuluh pertanian, pedagang,
                    praktisi (di bidang teknik mesin, fisika, pertanian, peternakan, pertambangan, kehutanan), pemadam
                    kebakaran, detektif, pekerja konstruksi, pekerjaan lapangan di bidang lingkungan dan sumber daya
                    alam, dsb.</p>
            @elseif($kode= "I")
                <p><b>Tipikal Personal:</b></p>
                <ul>
                    <li>Analitis, logis, dan berorientasi terhadap pemecahan masalah</li>
                    <li>Tertarik pada ilmu pengetahuan, teknologi, dan penelitian</li>
                    <li>Observasi dan investigasi menjadi pondasi utama menyelesaikan masalah</li>
                    <li>Menyukai diskusi-diskusi intelektual dan kegiatan yang mencakup prinsip ilmiah/pembuktian
                        empiris
                    </li>
                    <li>Cenderung berpikir kritis, suka bekerja dengan ide-ide abstrak daripada dengan orang</li>
                    <li>Memiliki rasa ingin tahu yang tinggi dan menikmati proses eksplorasi</li>
                    <li>Cenderung cerdas secara intelektual, introvert, terpusat pada pikiran sendiri, keras kepala
                        namun masih dapat melihat/mempertimbangkan beragam sudut pandang
                    </li>
                    <li>Cenderung kurang terampil dalam memimpin, dan lebih berorientasi pada aktivitas individual dalam
                        pekerjaan maupun pemecahan masalah
                    </li>
                </ul>

                <p><b>Karakteristik Kondisi Kerja yang Sesuai:</b></p>
                <ul>
                    <li>Lingkungan kerja: laboratorium, perpustakaan, ruang penelitian yang mendukung analisis dan
                        eksperimen
                    </li>
                    <li>Tugas: penelitian, pengujian, analisis data</li>
                    <li>Struktur: pekerjaan yang memungkinkan pengembangan hipotesis dan percobaan</li>
                    <li>Kemandirian: kebebasan untuk bekerja secara mandiri dalam proyek penelitian</li>
                </ul>

                <p><b>Deskripsi Bidang Minat:</b></p>
                <p>Suka menemukan dan meneliti ide, mengamati, menyelidiki, bereksperimen, mengajukan pertanyaan, dan
                    menyelesaikan masalah.</p>

                <p><b>Keterampilan Kunci:</b></p>
                <ul>
                    <li>Berpikir analitis dan logis</li>
                    <li>Mempelajari fenomena ilmiah atau teknologi baru</li>
                    <li>Menghitung, merancang, merumuskan, mendiagnosis, mengembangkan</li>
                    <li>Berkomunikasi dengan menulis dan berbicara</li>
                    <li>Mengamati, menyelidiki, bereksperimen, membuktikan</li>
                </ul>

                <p><b>Perihal yang Dianggap Penting:</b></p>
                <ul>
                    <li>Keakuratan dan validitas data</li>
                    <li>Penemuan baru dan inovasi</li>
                    <li>Kesempatan berpikir kritis dan kreatif</li>
                    <li>Lingkungan yang mendorong eksplorasi ide</li>
                </ul>

                <p><b>Rekomendasi Pekerjaan:</b></p>
                <p>Bagian riset dan pengembangan, ahli kimia, ahli biologi, ahli fisika, ahli botani, ahli astronomi,
                    ilmuwan, arsitek, programmer, dokter, data analis, ahli statistik, ekonom, antropolog, analis
                    kebijakan dan kepegawaian, analis laboratorium, penulis artikel ilmiah, editor jurnal ilmiah,
                    pengarang buku/fiksi ilmiah, pengajar (ilmu biologi dan fisika, paramedis, astrofisika, matematika,
                    dll), pengacara, analis sistem perangkat lunak, psikiatri, ahli bedah, ahli forensik, sosiolog,
                    profesor (semua bidang), dsb.</p>
            @elseif($kode= "A")
                {{ $kode }}
                <p><b>Tipikal Personal:</b></p>
                <ul>
                    <li>Kreatif, ekspresif, dan cenderung berpikir di luar kebiasaan</li>
                    <li>Menyukai kebebasan dalam berkarya dan tidak menyukai struktur yang kaku</li>
                    <li>Memiliki imajinasi yang kuat dan sering menciptakan karya seni atau ide-ide inovatif</li>
                    <li>Cenderung sensitif terhadap lingkungan dan pengalaman estetik</li>
                    <li>Spontan, tampil apa adanya, dinamis, fleksibel, menyukai kebebasan dan tidak konvensional</li>
                    <li>Cenderung emosional dan impulsif, namun memiliki kepekaan terhadap perasaan</li>
                    <li>Senang introspeksi diri, cukup memiliki keyakinan diri, terbuka dalam mengekspresikan emosi</li>
                    <li>Kerap menilai dirinya ekspresif, unik, bebas, dan mandiri</li>
                </ul>

                <p><b>Karakteristik Kondisi Kerja yang Sesuai:</b></p>
                <ul>
                    <li>Lingkungan Kerja: studio seni, ruang pameran atau tempat yang mendukung kreativitas</li>
                    <li>Tugas: kegiatan yang melibatkan desain, seni pertunjukan atau media kreatif</li>
                    <li>Struktur: pekerjaan yang fleksibel dan tidak terikat dengan prosedur ketat</li>
                    <li>Kemandirian: kebebasan untuk mengekspresikan ide dan menciptakan sesuatu tanpa batasan</li>
                </ul>

                <p><b>Deskripsi Bidang Minat:</b></p>
                <p>Suka menggunakan kata-kata, seni, musik atau drama untuk berkomunikasi, melakukan atau
                    mengekspresikan diri, membuat dan merancang sesuatu.</p>

                <p><b>Keterampilan Kunci:</b></p>
                <ul>
                    <li>Mengekspresikan secara artistik atau fisik</li>
                    <li>Menulis, menyanyi, bersyair, menggambar, melukis atau menciptakan seni visual</li>
                    <li>Mencipta dan berkarya, menyempurnakan sesuatu, eksperimen, mencoba hal baru</li>
                    <li>Tampil, menari, bermain/berakting</li>
                    <li>Berimajinasi, kreatif, berpikir out of the box</li>
                </ul>

                <p><b>Perihal yang Dianggap Penting:</b></p>
                <ul>
                    <li>Kebebasan untuk berkreasi dan mengekspresikan diri</li>
                    <li>Penghargaan terhadap seni dan keindahan</li>
                    <li>Lingkungan yang mendukung inovasi dan eksperimen</li>
                    <li>Pengakuan atas karya dan kontribusi kreatif</li>
                </ul>

                <p><b>Rekomendasi Pekerjaan:</b></p>
                <p>Artis, aktor, ilustrator, fotografer, penulis lagu, komposer, penyanyi, penari, penyair, produser,
                    manager bakat, pengarah gaya, perancang iklan, editor film/video, perancang busana, pelukis,
                    desainer komunikasi visual, desainer interior, desainer grafis, seniman/seniwati, pemain instrumen
                    musik, penulis novel, kritikus seni, ahli bahasa, kurator seni, pemahat, pembuat kartun, pembuat
                    animasi, desainer website, arsitek, konsultan event organizer/wedding organizer, dsb.</p>
            @elseif($kode= "S")
                <p><b>Tipikal Personal:</b></p>
                <ul>
                    <li>Empati, peduli, dan memiliki keinginan kuat untuk membantu orang lain</li>
                    <li>Menyukai interaksi sosial dan berorientasi pada hubungan antarpribadi</li>
                    <li>Cenderung mampu menjadi pendengar yang baik dan memiliki keterampilan interpersonal</li>
                    <li>Suka bekerja dalam kelompok dan berkontribusi terhadap kesejahteraan masyarakat</li>
                    <li>Tekun dan bertanggungjawab, berjiwa kemanusiaan</li>
                    <li>Senang memberikan perhatian, bijaksana, cukup persuasif</li>
                    <li>Tanggap sosial, simpatik, hangat, cukup mudah beradaptasi dengan lingkungan</li>
                    <li>Cenderung menghindari pekerjaan yang sistematis dan monoton</li>
                    <li>Cara berpikir terkadang kurang ilmiah tetapi peka terhadap perasaan, dapat dipercaya dan pandai
                        mengontrol diri
                    </li>
                    <li>Memiliki pemahaman dan penerimaan terhadap diri sendiri, memiliki citra diri yang positif</li>
                </ul>

                <p><b>Karakteristik Kondisi Kerja yang Sesuai:</b></p>
                <ul>
                    <li>Lingkungan Kerja: sekolah, rumah sakit, lembaga sosial atau organisasi nirlaba</li>
                    <li>Tugas: aktivitas yang melibatkan pengajaran, konseling, atau dukungan sosial</li>
                    <li>Struktur: lingkungan yang kolaboratif dan mendukung kerja tim</li>
                    <li>Kemandirian: bekerja dengan orang lain untuk mencapai tujuan bersama</li>
                </ul>

                <p><b>Deskripsi Bidang Minat:</b></p>
                <p>Suka mengajar, melatih dan memberikan informasi, membantu, mengobati, menyembuhkan, melayani,
                    menyapa, menginspirasi, peduli terhadap kesejahteraan diri dan kesejahteraan orang lain.</p>

                <p><b>Keterampilan Kunci:</b></p>
                <ul>
                    <li>Berkomunikasi secara lisan atau tertulis</li>
                    <li>Peduli dan mendukung, mengajar/melatih orang lain</li>
                    <li>Bersimpati, berempati, mengapresiasi</li>
                    <li>Bertemu, menyapa, membantu, memberikan informasi</li>
                    <li>Mendengarkan, menyimak, mewawancarai</li>
                    <li>Membangun hubungan interpersonal</li>
                </ul>

                <p><b>Perihal yang Dianggap Penting:</b></p>
                <ul>
                    <li>Membangun hubungan yang positif dan saling mendukung</li>
                    <li>Kesempatan untuk memberikan manfaat dalam hidup orang lain</li>
                    <li>Lingkungan yang inklusif dan ramah</li>
                    <li>Penghargaan terhadap kerja tim dan kolaborasi</li>
                </ul>

                <p><b>Rekomendasi Pekerjaan:</b></p>
                <p>Guru, pengajar, perawat, asisten perawat, dokter, petugas medis, customer service, konselor
                    pernikahan, psikolog, terapis, pengawas pendidikan, petugas kesehatan masyarakat, hakim, pekerja
                    sosial/LSM, pengasuh anak, juru kampanye, penasihat finansial, pendakwah agama, pegawai pemerintahan
                    di kelurahan/kecamatan, instruktur kebugaran, spesialis di bidang pelatihan dan pengembangan,
                    trainer, pembicara publik, motivator, dsb.</p>
            @elseif($kode= "E")
                <p><b>Tipikal Personal:</b></p>
                <ul>
                    <li>Penuh energi, mmbisius, percaya diri, dan memiliki keterampilan memimpin yang baik</li>
                    <li>Menyukai tantangan dan berani mengambil risiko</li>
                    <li>Senang bernegosiasi dan menjual ide/produk</li>
                    <li>Cenderung menjadi pengambil keputusan yang proaktif</li>
                    <li>Memiliki kecakapan verbal terutama lisan, aktif bersosialisasi, persuasif</li>
                    <li>Sosok yang ramah, ekstrovert, pandai berkomunikasi di depan umum, optimis, mudah beradaptasi
                    </li>
                    <li>Ada kecenderungan agresif bertutur kata, impulsif, domonan, namun sisi emosionalnya masih cukup
                        stabil
                    </li>
                    <li>Senang menjadi pusat perhatian dan mendapatkan status/posisi yang tinggi dalam kelompok</li>
                    <li>Umumnya kurang menyukai aktivitas yang memerlukan kecermatan dan pemikiran analitis ilmiah</li>
                    <li>Menganggap penting sukses di bidang politik, bisnis, dan kepemimpinan</li>
                </ul>

                <p><b>Karakteristik Kondisi Kerja yang Sesuai:</b></p>
                <ul>
                    <li>Lingkungan Kerja: kantor, ruang rapat atau lingkungan bisnis yang dinamis</li>
                    <li>Tugas: kegiatan yang melibatkan bisnis, penjualan, pemasaran atau manajemen</li>
                    <li>Struktur: lingkungan yang kompetitif dan penuh tantangan</li>
                    <li>Kemandirian: kebebasan untuk mengambil inisiatif dan memimpin proyek</li>
                </ul>

                <p><b>Deskripsi Bidang Minat:</b></p>
                <p>Suka bertemu dengan orang, memimpin, berbicara dan mempengaruhi orang lain, mendorong orang lain,
                    bekerja dalam konteks bisnis.</p>

                <p><b>Keterampilan Kunci:</b></p>
                <ul>
                    <li>Menjual, mempromosikan, membujuk, mempersuasi orang lain</li>
                    <li>Mengembangkan ide-ide</li>
                    <li>Berbicara di depan umum, bernegosiasi</li>
                    <li>Membangun jaringan dan hubungan bisnis</li>
                    <li>Mengelola, mengatur, memimpin, mengarahkan tim atau proyek</li>
                    <li>Menangkap peluang, menghitung, merencanakan</li>
                    <li>Mengembangkan ide bisnis atau strategi pemasaran</li>
                </ul>

                <p><b>Perihal yang Dianggap Penting:</b></p>
                <ul>
                    <li>Kesuksesan dan pencapaian yang terukur</li>
                    <li>Kesempatan berinovasi dan mengambil risiko</li>
                    <li>Lingkungan yang kompetitif dan menantang</li>
                    <li>Pengakuan atas prestasi dan kontribusi dalam tim</li>
                </ul>

                <p><b>Rekomendasi Pekerjaan:</b></p>
                <p>Pemilik bisnis/usaha perdagangan, tenaga penjualan (pedagang, sales, pemasaran, juru lelang, agen
                    asuransi), eksekutif atau manajer, agen perjalanan, promotor, pialang, importir, konsultan,
                    direktur, ahli psikologi industri, dekan universitas, politikus, rektor, kepala sekolah, advokat,
                    coach, convention planner, anggota dewan, pejabat tinggi pemerintahan, ahli hubungan internasional,
                    pekerja di bidang properti, dsb.</p>

            @elseif($kode= "C")
                <p><b>Tipikal Personal:</b></p>
                <ul>
                    <li>Terencana, detail-oriented, rapi, teratur, cermat, teliti, hati-hati</li>
                    <li>Menyukai pekerjaan yang terstruktur dan jelas, menyukai pekerjaan yang bersifat rutin</li>
                    <li>Senang bekerja dengan data-data yang lengkap, menggunakan angka, dan mengikuti garis kewenangan
                        yang jelas
                    </li>
                    <li>Umumnya menghindari kegiatan yang tidak jelas batas-batasnya</li>
                    <li>Cenderung mengikuti prosedur dan menyukai stabilitas, patuh pada aturan</li>
                    <li>Memiliki keterampilan dalam analisis data dan pengolahan informasi</li>
                    <li>Memiliki tanggung jawab yang tinggi, tekun, berpikir ilmiah</li>
                    <li>Cukup stabil secara emosi dan memiliki penerimaan diri namun kurang fleksibel dan cenderung
                        keras hati
                    </li>
                    <li>Cenderung tergantung pada orang lain dan kurang merasa yakin untuk memimpin</li>
                </ul>

                <p><b>Karakteristik Kondisi Kerja yang Sesuai:</b></p>
                <ul>
                    <li>Lingkungan Kerja: kantor, lembaga pemerintah, instansi/perusahaan yang memiliki prosedur
                        operasional yang jelas
                    </li>
                    <li>Tugas: kegiatan yang melibatkan admistrasi, akuntansi atau pengolahan data</li>
                    <li>Struktur: lingkungan yang terorganisir dengan aturan dan prosedur kerja yang jelas untuk
                        diikuti
                    </li>
                    <li>Kemandirian: kebebasan untuk bekerja dalam batasan yang ditentukan dan berfokus pada detail</li>
                </ul>

                <p><b>Deskripsi Bidang Minat:</b></p>
                <p>Suka bekerja di dalam ruangan dan tugas-tugas yang melibatkan pengorganisasian dan akurasi, mengikuti
                    prosedur, bekerja dengan data atau angka, tugas-tugas perencanaan.</p>

                <p><b>Keterampilan Kunci:</b></p>
                <ul>
                    <li>Komputasi dan keyboarding</li>
                    <li>Merekam dan menyimpan catatan</li>
                    <li>Memperhatikan detail dan keteraturan, mengatur jadwal</li>
                    <li>Melakukan perhitungan, bekerja dengan angka dan statistik</li>
                    <li>Mematuhi dan mengikuti prosedur</li>
                    <li>Menangani uang, mengelola data dan informasi</li>
                    <li>Mendokumentasikan, mengarsip, menata</li>
                </ul>

                <p><b>Perihal yang Dianggap Penting:</b></p>
                <ul>
                    <li>Ketelitian dan akurasi dalam pekerjaan</li>
                    <li>Struktur dan rutinitas yang jelas</li>
                    <li>Lingkungan yang stabil dan aman</li>
                    <li>Penghargaan atas keteraturan dan efisiensi</li>
                </ul>

                <p><b>Rekomendasi Pekerjaan:</b></p>
                <p>Sekretaris, pustakawan, operator komputer, pegawai administrasi, bagian tata usaha, pengolah
                    arsip/arsiparis, petugas keuangan (akuntan, auditor, pegawai bank, analis keuangan, kasir, ahli
                    perpajakan, analis kredit, bendahara), petugas payroll, penyusun laporan, pengelola inventaris,
                    pengelola proyek konstruksi, petugas verifikasi data, asisten riset pasar, staf audit internal,
                    petugas pendaftaran, asisten penjualan, admin HRD, pengelola database, dsb.</p>
            @else
                <p>kode tidak valid</p>
            @endif
        </div>

{{--   percabangan disini     --}}
    @endforeach

</div>
<p>Adapun 3 peringkat terbawah yang menunjukkan kurangnya minat individu terhadap bidang kerja tertentu dapat
    digambarkan sebagai berikut: </p>
<div class="deskripsi">
    @foreach ($top3Tidak as $index => $kode)
        @if ($index >= 3)
            @break
        @endif
        <div class="deskripsi-header">
            #{{ 6 - $index }}
            @switch($kode)
                @case('R')
                    Realistic
                    @break
                @case('I')
                    Investigative
                    @break
                @case('A')
                    Artistic
                    @break
                @case('S')
                    Social
                    @break
                @case('E')
                    Enterprising
                    @break
                @case('C')
                    Conventional
                    @break
                @default
                    Unknown
            @endswitch
        </div>
        <div class="deskripsi-content">
            @if($kode == 'R')
                <p><b>Karakteristik Kondisi Kerja yang KURANG DIMINATI:</b></p>
                <ul>
                    <li>Lingkungan Kerja: pekerjaan di luar ruangan atau yang memungkinkan penggunaan alat dan mesin.
                    </li>
                    <li>Tugas: kegiatan yang melibatkan keterampilan praktis, seperti perbaikan, konstruksi, atau
                        produksi.
                    </li>
                    <li>Struktur: situasi kerja yang terorganisir dan terencana, memiliki prosedur kerja yang jelas.
                    </li>
                    <li>Kemandirian: kebebasan untuk membuat keputusan praktis dan menyelesaikan tugas secara mandiri.
                    </li>
                </ul>

                <p><b>CENDERUNG KURANG MENIKMATI Bidang Kerja:</b></p>
                <p>Yang membutuhkan aktivitas dengan tangan, membuat, memperbaiki, merakit atau membangun sesuatu,
                    menggunakan dan mengoperasikan alat atau mesin, serta bekerja di luar ruangan.</p>

                <p><b>CENDERUNG KURANG SESUAI untuk Pekerjaan:</b></p>
                <p>Pekerja terlatih (mekanik, operator, montir, teknisi, teknolog komputer), pengemudi kendaraan (sopir,
                    pilot, masinis, pengemudi alat berat, nahkoda, dll), petani, hortikulturan, insinyur, personel
                    angkatan bersenjata, tukang kebun, olahragawan, pengawas hutan, penyuluh pertanian, pedagang,
                    praktisi (di bidang teknik mesin, fisika, pertanian, peternakan, pertambangan, kehutanan), pemadam
                    kebakaran, detektif, pekerja konstruksi, pekerjaan lapangan di bidang lingkungan dan sumber daya
                    alam, dsb.</p>
            @elseif($kode == 'I')
                <p><b>Karakteristik Kondisi Kerja yang KURANG DIMINATI:</b></p>
                <ul>
                    <li>Lingkungan kerja: laboratorium, perpustakaan, ruang penelitian yang mendukung analisis dan
                        eksperimen
                    </li>
                    <li>Tugas: penelitian, pengujian, analisis data</li>
                    <li>Struktur: pekerjaan yang memungkinkan pengembangan hipotesis dan percobaan</li>
                    <li>Kemandirian: kebebasan untuk bekerja secara mandiri dalam proyek penelitian</li>
                </ul>

                <p><b>CENDERUNG KURANG MENIKMATI Bidang Kerja:</b></p>
                <p>Menemukan dan meneliti ide, mengamati, menyelidiki, bereksperimen, mengajukan pertanyaan, dan
                    menyelesaikan masalah.</p>

                <p><b>CENDERUNG KURANG SESUAI untuk Pekerjaan:</b></p>
                <p>Bagian riset dan pengembangan, ahli kimia, ahli biologi, ahli fisika, ahli botani, ahli astronomi,
                    ilmuwan, arsitek, programmer, dokter, data analis, ahli statistik, ekonom, antropolog, analis
                    kebijakan dan kepegawaian, analis laboratorium, penulis artikel ilmiah, editor jurnal ilmiah,
                    pengarang buku/fiksi ilmiah, pengajar (ilmu biologi dan fisika, paramedis, astrofisika, matematika,
                    dll), pengacara, analis sistem perangkat lunak, psikiatri, ahli bedah, ahli forensik, sosiolog,
                    profesor (semua bidang), dsb.</p>
            @elseif($kode == 'A')
                <p><b>Karakteristik Kondisi Kerja yang KURANG DIMINATI:</b></p>
                <ul>
                    <li>Lingkungan Kerja: studio seni, ruang pameran atau tempat yang mendukung kreativitas</li>
                    <li>Tugas: kegiatan yang melibatkan desain, seni pertunjukan atau media kreatif</li>
                    <li>Struktur: pekerjaan yang fleksibel dan tidak terikat dengan prosedur ketat</li>
                    <li>Kemandirian: kebebasan untuk mengekspresikan ide dan menciptakan sesuatu tanpa batasan</li>
                </ul>

                <p><b>CENDERUNG KURANG MENIKMATI Bidang Kerja:</b></p>
                <p>Aktivitas kerja menggunakan kata-kata, seni, musik atau drama untuk berkomunikasi, melakukan atau
                    mengekspresikan diri, membuat dan merancang sesuatu.</p>

                <p><b>CENDERUNG KURANG SESUAI untuk Pekerjaan:</b></p>
                <p>Artis, aktor, ilustrator, fotografer, penulis lagu, komposer, penyanyi, penari, penyair, produser,
                    manager bakat, pengarah gaya, perancang iklan, editor film/video, perancang busana, pelukis,
                    desainer komunikasi visual, desainer interior, desainer grafis, seniman/seniwati, pemain instrumen
                    musik, penulis novel, kritikus seni, ahli bahasa, kurator seni, pemahat, pembuat kartun, pembuat
                    animasi, desainer website, arsitek, konsultan event organizer/wedding organizer, dsb.</p>

            @elseif($kode == 'S')
                <p><b>Karakteristik Kondisi Kerja yang KURANG DIMINATI:</b></p>
                <ul>
                    <li>Lingkungan Kerja: sekolah, rumah sakit, lembaga sosial atau organisasi nirlaba</li>
                    <li>Tugas: aktivitas yang melibatkan pengajaran, konseling, atau dukungan sosial</li>
                    <li>Struktur: lingkungan yang kolaboratif dan mendukung kerja tim</li>
                    <li>Kemandirian: bekerja dengan orang lain untuk mencapai tujuan bersama</li>
                </ul>

                <p><b>CENDERUNG KURANG MENIKMATI Bidang Kerja:</b></p>
                <p>Mengajar, melatih dan memberikan informasi, membantu, mengobati, menyembuhkan, melayani, menyapa, menginspirasi, peduli terhadap kesejahteraan diri dan kesejahteraan orang lain.</p>

                <p><b>CENDERUNG KURANG SESUAI untuk Pekerjaan:</b></p>
                <p>Guru, pengajar, perawat, asisten perawat, dokter, petugas medis, customer service, konselor pernikahan, psikolog, terapis, pengawas pendidikan, petugas kesehatan masyarakat, hakim, pekerja sosial/LSM, pengasuh anak, juru kampanye, penasihat finansial, pendakwah agama, pegawai pemerintahan di kelurahan/kecamatan, instruktur kebugaran, spesialis di bidang pelatihan dan pengembangan, trainer, pembicara publik, motivator, dsb.</p>
            @elseif($kode == 'E')
                <p><b>Karakteristik Kondisi Kerja yang KURANG DIMINATI:</b></p>
                <ul>
                    <li>Lingkungan Kerja: kantor, ruang rapat atau lingkungan bisnis yang dinamis</li>
                    <li>Tugas: kegiatan yang melibatkan bisnis, penjualan, pemasaran atau manajemen</li>
                    <li>Struktur: lingkungan yang kompetitif dan penuh tantangan</li>
                    <li>Kemandirian: kebebasan untuk mengambil inisiatif dan memimpin proyek</li>
                </ul>

                <p><b>CENDERUNG KURANG MENIKMATI Bidang Kerja:</b></p>
                <p>Bertemu dengan orang, memimpin, berbicara dan mempengaruhi orang lain, mendorong orang lain, bekerja dalam konteks bisnis.</p>

                <p><b>CENDERUNG KURANG SESUAI untuk Pekerjaan:</b></p>
                <p>Pemilik bisnis/usaha perdagangan, tenaga penjualan (pedagang, sales, pemasaran, juru lelang, agen asuransi), eksekutif atau manajer, agen perjalanan, promotor, pialang, importir, konsultan, direktur, ahli psikologi industri, dekan universitas, politikus, rektor, kepala sekolah, advokat, coach, convention planner, anggota dewan, pejabat tinggi pemerintahan, ahli hubungan internasional, pekerja di bidang properti, dsb.</p>
            @elseif($kode == 'C')
                <p><b>Karakteristik Kondisi Kerja yang KURANG DIMINATI:</b></p>
                <ul>
                    <li>Lingkungan Kerja: kantor, lembaga pemerintah, instansi/perusahaan yang memiliki prosedur operasional yang jelas</li>
                    <li>Tugas: kegiatan yang melibatkan administrasi, akuntansi atau pengolahan data</li>
                    <li>Struktur: lingkungan yang terorganisir dengan aturan dan prosedur kerja yang jelas untuk diikuti</li>
                    <li>Kemandirian: kebebasan untuk bekerja dalam batasan yang ditentukan dan berfokus pada detail</li>
                </ul>

                <p><b>CENDERUNG KURANG MENIKMATI Bidang Kerja:</b></p>
                <p>Aktivitas di dalam ruangan dan tugas-tugas yang melibatkan pengorganisasian dan akurasi, mengikuti prosedur, bekerja dengan data atau angka, tugas-tugas perencanaan.</p>

                <p><b>CENDERUNG KURANG SESUAI untuk Pekerjaan:</b></p>
                <p>Sekretaris, pustakawan, operator komputer, pegawai administrasi, bagian tata usaha, pengolah arsip/arsiparis, petugas keuangan (akuntan, auditor, pegawai bank, analis keuangan, kasir, ahli perpajakan, analis kredit, bendahara), petugas payroll, penyusun laporan, pengelola inventaris, pengelola proyek konstruksi, petugas verifikasi data, asisten riset pasar, staf audit internal, petugas pendaftaran, asisten penjualan, admin HRD, pengelola database, dsb.</p>
            @else
                <p>kode tidak valid</p>
            @endif
        </div>
    @endforeach
</div>
</body>

</html>
