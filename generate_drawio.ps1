$xml = '<?xml version="1.0" encoding="UTF-8"?>
<mxfile host="app.diagrams.net">
  <diagram id="alur_sistem" name="Alur Sistem Produksi Jamur Tiram">
    <mxGraphModel dx="1000" dy="1000" grid="1" gridSize="10" guides="1" tooltips="1" connect="1" arrows="1" fold="1" page="1" pageScale="1" pageWidth="1400" pageHeight="2200" math="0" shadow="1">
      <root>
        <mxCell id="0"/>
        <mxCell id="1" parent="0"/>
        
        <mxCell id="lane1" value="Ketua KUPS / Admin" style="swimlane;whiteSpace=wrap;html=1;fillColor=#10B981;fontColor=#ffffff;fontStyle=1;startSize=30;" vertex="1" parent="1">
          <mxGeometry x="40" y="40" width="300" height="2100" as="geometry"/>
        </mxCell>
        <mxCell id="lane2" value="Petugas Kumbung" style="swimlane;whiteSpace=wrap;html=1;fillColor=#10B981;fontColor=#ffffff;fontStyle=1;startSize=30;" vertex="1" parent="1">
          <mxGeometry x="340" y="40" width="300" height="2100" as="geometry"/>
        </mxCell>
        <mxCell id="lane3" value="Sistem Aplikasi" style="swimlane;whiteSpace=wrap;html=1;fillColor=#10B981;fontColor=#ffffff;fontStyle=1;startSize=30;" vertex="1" parent="1">
          <mxGeometry x="640" y="40" width="300" height="2100" as="geometry"/>
        </mxCell>
        <mxCell id="lane4" value="Database" style="swimlane;whiteSpace=wrap;html=1;fillColor=#10B981;fontColor=#ffffff;fontStyle=1;startSize=30;" vertex="1" parent="1">
          <mxGeometry x="940" y="40" width="300" height="2100" as="geometry"/>
        </mxCell>
        
        <mxCell id="n1" value="Mulai" style="ellipse;whiteSpace=wrap;html=1;fillColor=#d4edda;strokeColor=#28a745;fontStyle=1;" vertex="1" parent="1"><mxGeometry x="140" y="100" width="100" height="50" as="geometry"/></mxCell>
        <mxCell id="n2" value="Kelola &amp; Tambah Stok Bibit" style="rounded=1;whiteSpace=wrap;html=1;fillColor=#e2e8f0;strokeColor=#64748b;" vertex="1" parent="1"><mxGeometry x="115" y="200" width="150" height="50" as="geometry"/></mxCell>
        <mxCell id="n3" value="Simpan Data Bibit" style="shape=cylinder3;whiteSpace=wrap;html=1;boundedLbl=1;backgroundOutline=1;size=15;fillColor=#cce5ff;strokeColor=#007bff;" vertex="1" parent="1"><mxGeometry x="1040" y="190" width="100" height="70" as="geometry"/></mxCell>
        
        <mxCell id="n4" value="Pembuatan Baglog Baru" style="rounded=1;whiteSpace=wrap;html=1;fillColor=#e2e8f0;strokeColor=#64748b;" vertex="1" parent="1"><mxGeometry x="415" y="300" width="150" height="50" as="geometry"/></mxCell>
        <mxCell id="n5" value="Input Jumlah &amp; Pilih Bibit" style="rounded=1;whiteSpace=wrap;html=1;fillColor=#e2e8f0;strokeColor=#64748b;" vertex="1" parent="1"><mxGeometry x="415" y="380" width="150" height="50" as="geometry"/></mxCell>
        <mxCell id="n6" value="Stok Bibit&#10;Cukup?" style="rhombus;whiteSpace=wrap;html=1;fillColor=#fff3cd;strokeColor=#ffc107;fontStyle=1;" vertex="1" parent="1"><mxGeometry x="730" y="365" width="120" height="80" as="geometry"/></mxCell>
        <mxCell id="n7" value="Notifikasi Stok Habis" style="ellipse;whiteSpace=wrap;html=1;fillColor=#f8d7da;strokeColor=#dc3545;fontStyle=1;strokeWidth=2;" vertex="1" parent="1"><mxGeometry x="1040" y="380" width="100" height="50" as="geometry"/></mxCell>
        <mxCell id="n8" value="Kurangi Stok &amp; Simpan Baglog" style="shape=cylinder3;whiteSpace=wrap;html=1;boundedLbl=1;backgroundOutline=1;size=15;fillColor=#cce5ff;strokeColor=#007bff;" vertex="1" parent="1"><mxGeometry x="1025" y="480" width="130" height="70" as="geometry"/></mxCell>
        
        <mxCell id="n9" value="Proses Sterilisasi" style="rounded=1;whiteSpace=wrap;html=1;fillColor=#e2e8f0;strokeColor=#64748b;" vertex="1" parent="1"><mxGeometry x="415" y="580" width="150" height="50" as="geometry"/></mxCell>
        <mxCell id="n10" value="Input Suhu &amp; Durasi" style="rounded=1;whiteSpace=wrap;html=1;fillColor=#e2e8f0;strokeColor=#64748b;" vertex="1" parent="1"><mxGeometry x="415" y="660" width="150" height="50" as="geometry"/></mxCell>
        <mxCell id="n11" value="Suhu &gt;= 95°C&#10;&amp; Durasi &gt;= 8 Jam?" style="rhombus;whiteSpace=wrap;html=1;fillColor=#fff3cd;strokeColor=#ffc107;fontStyle=1;" vertex="1" parent="1"><mxGeometry x="715" y="645" width="150" height="80" as="geometry"/></mxCell>
        <mxCell id="n12" value="Status Beresiko" style="rounded=1;whiteSpace=wrap;html=1;fillColor=#e2e8f0;strokeColor=#64748b;" vertex="1" parent="1"><mxGeometry x="740" y="780" width="100" height="50" as="geometry"/></mxCell>
        <mxCell id="n13" value="Pengukusan Ulang" style="rounded=1;whiteSpace=wrap;html=1;fillColor=#e2e8f0;strokeColor=#64748b;" vertex="1" parent="1"><mxGeometry x="415" y="780" width="150" height="50" as="geometry"/></mxCell>
        <mxCell id="n14" value="Simpan Status Aman" style="shape=cylinder3;whiteSpace=wrap;html=1;boundedLbl=1;backgroundOutline=1;size=15;fillColor=#cce5ff;strokeColor=#007bff;" vertex="1" parent="1"><mxGeometry x="1030" y="650" width="120" height="70" as="geometry"/></mxCell>
        
        <mxCell id="n15" value="Proses Inokulasi" style="rounded=1;whiteSpace=wrap;html=1;fillColor=#e2e8f0;strokeColor=#64748b;" vertex="1" parent="1"><mxGeometry x="415" y="900" width="150" height="50" as="geometry"/></mxCell>
        <mxCell id="n16" value="Cek Masa Pendinginan&#10;(&gt; 24 Jam?)" style="rhombus;whiteSpace=wrap;html=1;fillColor=#fff3cd;strokeColor=#ffc107;fontStyle=1;" vertex="1" parent="1"><mxGeometry x="715" y="885" width="150" height="80" as="geometry"/></mxCell>
        <mxCell id="n17" value="Tolak Input (Masih Panas)" style="ellipse;whiteSpace=wrap;html=1;fillColor=#f8d7da;strokeColor=#dc3545;fontStyle=1;strokeWidth=2;" vertex="1" parent="1"><mxGeometry x="1030" y="900" width="120" height="50" as="geometry"/></mxCell>
        <mxCell id="n18" value="Simpan Inokulasi" style="shape=cylinder3;whiteSpace=wrap;html=1;boundedLbl=1;backgroundOutline=1;size=15;fillColor=#cce5ff;strokeColor=#007bff;" vertex="1" parent="1"><mxGeometry x="1030" y="1000" width="120" height="70" as="geometry"/></mxCell>
        
        <mxCell id="n19" value="Inkubasi &amp; Monitoring" style="rounded=1;whiteSpace=wrap;html=1;fillColor=#e2e8f0;strokeColor=#64748b;" vertex="1" parent="1"><mxGeometry x="415" y="1120" width="150" height="50" as="geometry"/></mxCell>
        <mxCell id="n20" value="Input % Miselium" style="rounded=1;whiteSpace=wrap;html=1;fillColor=#e2e8f0;strokeColor=#64748b;" vertex="1" parent="1"><mxGeometry x="415" y="1200" width="150" height="50" as="geometry"/></mxCell>
        <mxCell id="n21" value="Miselium&#10;100%?" style="rhombus;whiteSpace=wrap;html=1;fillColor=#fff3cd;strokeColor=#ffc107;fontStyle=1;" vertex="1" parent="1"><mxGeometry x="740" y="1185" width="100" height="80" as="geometry"/></mxCell>
        <mxCell id="n22" value="Simpan Log Biasa" style="shape=cylinder3;whiteSpace=wrap;html=1;boundedLbl=1;backgroundOutline=1;size=15;fillColor=#cce5ff;strokeColor=#007bff;" vertex="1" parent="1"><mxGeometry x="1030" y="1190" width="120" height="70" as="geometry"/></mxCell>
        <mxCell id="n23" value="Buka Kapas&#10;(Siap Panen)" style="rounded=1;whiteSpace=wrap;html=1;fillColor=#e2e8f0;strokeColor=#64748b;" vertex="1" parent="1"><mxGeometry x="730" y="1300" width="120" height="50" as="geometry"/></mxCell>
        <mxCell id="n24" value="Simpan Status" style="shape=cylinder3;whiteSpace=wrap;html=1;boundedLbl=1;backgroundOutline=1;size=15;fillColor=#cce5ff;strokeColor=#007bff;" vertex="1" parent="1"><mxGeometry x="1040" y="1290" width="100" height="70" as="geometry"/></mxCell>
        
        <mxCell id="n25" value="Panen Harian" style="rounded=1;whiteSpace=wrap;html=1;fillColor=#e2e8f0;strokeColor=#64748b;" vertex="1" parent="1"><mxGeometry x="415" y="1400" width="150" height="50" as="geometry"/></mxCell>
        <mxCell id="n26" value="Input Laporan Panen&#10;(Grade A &amp; B)" style="rounded=1;whiteSpace=wrap;html=1;fillColor=#e2e8f0;strokeColor=#64748b;" vertex="1" parent="1"><mxGeometry x="415" y="1480" width="150" height="60" as="geometry"/></mxCell>
        <mxCell id="n27" value="Simpan Laporan&#10;(Status Pending)" style="shape=cylinder3;whiteSpace=wrap;html=1;boundedLbl=1;backgroundOutline=1;size=15;fillColor=#cce5ff;strokeColor=#007bff;" vertex="1" parent="1"><mxGeometry x="1030" y="1475" width="120" height="70" as="geometry"/></mxCell>
        
        <mxCell id="n28" value="Validasi Laporan Panen" style="rounded=1;whiteSpace=wrap;html=1;fillColor=#e2e8f0;strokeColor=#64748b;" vertex="1" parent="1"><mxGeometry x="115" y="1485" width="150" height="50" as="geometry"/></mxCell>
        <mxCell id="n29" value="Valid / Tolak?" style="rhombus;whiteSpace=wrap;html=1;fillColor=#fff3cd;strokeColor=#ffc107;fontStyle=1;" vertex="1" parent="1"><mxGeometry x="130" y="1585" width="120" height="80" as="geometry"/></mxCell>
        <mxCell id="n30" value="Status Dibatalkan" style="shape=cylinder3;whiteSpace=wrap;html=1;boundedLbl=1;backgroundOutline=1;size=15;fillColor=#cce5ff;strokeColor=#007bff;" vertex="1" parent="1"><mxGeometry x="1040" y="1590" width="100" height="70" as="geometry"/></mxCell>
        <mxCell id="n31" value="Status Valid &amp;&#10;Update Stok" style="shape=cylinder3;whiteSpace=wrap;html=1;boundedLbl=1;backgroundOutline=1;size=15;fillColor=#cce5ff;strokeColor=#007bff;" vertex="1" parent="1"><mxGeometry x="1030" y="1690" width="120" height="70" as="geometry"/></mxCell>
        
        <mxCell id="n32" value="Sudah 5x&#10;Panen?" style="rhombus;whiteSpace=wrap;html=1;fillColor=#fff3cd;strokeColor=#ffc107;fontStyle=1;" vertex="1" parent="1"><mxGeometry x="740" y="1685" width="100" height="80" as="geometry"/></mxCell>
        <mxCell id="n33" value="Tandai Afkir&#10;(Selesai)" style="ellipse;whiteSpace=wrap;html=1;fillColor=#f8d7da;strokeColor=#dc3545;fontStyle=1;strokeWidth=2;" vertex="1" parent="1"><mxGeometry x="740" y="1820" width="100" height="50" as="geometry"/></mxCell>

        <!-- EDGES -->
        <mxCell id="e100" value="" style="edgeStyle=orthogonalEdgeStyle;rounded=1;html=1;strokeColor=#333333;strokeWidth=2;fontStyle=1;fontSize=11;" edge="1" parent="1" source="n1" target="n2"><mxGeometry relative="1" as="geometry"/></mxCell>
        <mxCell id="e101" value="Simpan" style="edgeStyle=orthogonalEdgeStyle;rounded=1;html=1;strokeColor=#333333;strokeWidth=2;fontStyle=1;fontSize=11;" edge="1" parent="1" source="n2" target="n3"><mxGeometry relative="1" as="geometry"/></mxCell>
        <mxCell id="e102" value="Lanjut" style="edgeStyle=orthogonalEdgeStyle;rounded=1;html=1;strokeColor=#333333;strokeWidth=2;fontStyle=1;fontSize=11;" edge="1" parent="1" source="n3" target="n4"><mxGeometry relative="1" as="geometry"/></mxCell>
        <mxCell id="e103" value="" style="edgeStyle=orthogonalEdgeStyle;rounded=1;html=1;strokeColor=#333333;strokeWidth=2;fontStyle=1;fontSize=11;" edge="1" parent="1" source="n4" target="n5"><mxGeometry relative="1" as="geometry"/></mxCell>
        <mxCell id="e104" value="Cek Sistem" style="edgeStyle=orthogonalEdgeStyle;rounded=1;html=1;strokeColor=#333333;strokeWidth=2;fontStyle=1;fontSize=11;" edge="1" parent="1" source="n5" target="n6"><mxGeometry relative="1" as="geometry"/></mxCell>
        <mxCell id="e105" value="Tidak (Habis)" style="edgeStyle=orthogonalEdgeStyle;rounded=1;html=1;strokeColor=#333333;strokeWidth=2;fontStyle=1;fontSize=11;" edge="1" parent="1" source="n6" target="n7"><mxGeometry relative="1" as="geometry"/></mxCell>
        <mxCell id="e106" value="Ya (Tersedia)" style="edgeStyle=orthogonalEdgeStyle;rounded=1;html=1;strokeColor=#333333;strokeWidth=2;fontStyle=1;fontSize=11;" edge="1" parent="1" source="n6" target="n8"><mxGeometry relative="1" as="geometry"/></mxCell>
        <mxCell id="e107" value="Lanjut ke Kumbung" style="edgeStyle=orthogonalEdgeStyle;rounded=1;html=1;strokeColor=#333333;strokeWidth=2;fontStyle=1;fontSize=11;" edge="1" parent="1" source="n8" target="n9"><mxGeometry relative="1" as="geometry"/></mxCell>
        <mxCell id="e108" value="" style="edgeStyle=orthogonalEdgeStyle;rounded=1;html=1;strokeColor=#333333;strokeWidth=2;fontStyle=1;fontSize=11;" edge="1" parent="1" source="n9" target="n10"><mxGeometry relative="1" as="geometry"/></mxCell>
        <mxCell id="e109" value="Validasi" style="edgeStyle=orthogonalEdgeStyle;rounded=1;html=1;strokeColor=#333333;strokeWidth=2;fontStyle=1;fontSize=11;" edge="1" parent="1" source="n10" target="n11"><mxGeometry relative="1" as="geometry"/></mxCell>
        <mxCell id="e110" value="Tidak Memenuhi" style="edgeStyle=orthogonalEdgeStyle;rounded=1;html=1;strokeColor=#333333;strokeWidth=2;fontStyle=1;fontSize=11;" edge="1" parent="1" source="n11" target="n12"><mxGeometry relative="1" as="geometry"/></mxCell>
        <mxCell id="e111" value="" style="edgeStyle=orthogonalEdgeStyle;rounded=1;html=1;strokeColor=#333333;strokeWidth=2;fontStyle=1;fontSize=11;" edge="1" parent="1" source="n12" target="n13"><mxGeometry relative="1" as="geometry"/></mxCell>
        <mxCell id="e112" value="Input Ulang" style="edgeStyle=orthogonalEdgeStyle;rounded=1;html=1;strokeColor=#333333;strokeWidth=2;fontStyle=1;fontSize=11;" edge="1" parent="1" source="n13" target="n10"><mxGeometry relative="1" as="geometry"/></mxCell>
        <mxCell id="e113" value="Sesuai SOP" style="edgeStyle=orthogonalEdgeStyle;rounded=1;html=1;strokeColor=#333333;strokeWidth=2;fontStyle=1;fontSize=11;" edge="1" parent="1" source="n11" target="n14"><mxGeometry relative="1" as="geometry"/></mxCell>
        <mxCell id="e114" value="Lanjut Inokulasi" style="edgeStyle=orthogonalEdgeStyle;rounded=1;html=1;strokeColor=#333333;strokeWidth=2;fontStyle=1;fontSize=11;" edge="1" parent="1" source="n14" target="n15"><mxGeometry relative="1" as="geometry"/></mxCell>
        <mxCell id="e115" value="Cek Waktu" style="edgeStyle=orthogonalEdgeStyle;rounded=1;html=1;strokeColor=#333333;strokeWidth=2;fontStyle=1;fontSize=11;" edge="1" parent="1" source="n15" target="n16"><mxGeometry relative="1" as="geometry"/></mxCell>
        <mxCell id="e116" value="Kurang dari 24 Jam" style="edgeStyle=orthogonalEdgeStyle;rounded=1;html=1;strokeColor=#333333;strokeWidth=2;fontStyle=1;fontSize=11;" edge="1" parent="1" source="n16" target="n17"><mxGeometry relative="1" as="geometry"/></mxCell>
        <mxCell id="e117" value="Lebih dari 24 Jam" style="edgeStyle=orthogonalEdgeStyle;rounded=1;html=1;strokeColor=#333333;strokeWidth=2;fontStyle=1;fontSize=11;" edge="1" parent="1" source="n16" target="n18"><mxGeometry relative="1" as="geometry"/></mxCell>
        <mxCell id="e118" value="Masa Inkubasi" style="edgeStyle=orthogonalEdgeStyle;rounded=1;html=1;strokeColor=#333333;strokeWidth=2;fontStyle=1;fontSize=11;" edge="1" parent="1" source="n18" target="n19"><mxGeometry relative="1" as="geometry"/></mxCell>
        <mxCell id="e119" value="" style="edgeStyle=orthogonalEdgeStyle;rounded=1;html=1;strokeColor=#333333;strokeWidth=2;fontStyle=1;fontSize=11;" edge="1" parent="1" source="n19" target="n20"><mxGeometry relative="1" as="geometry"/></mxCell>
        <mxCell id="e120" value="Cek %" style="edgeStyle=orthogonalEdgeStyle;rounded=1;html=1;strokeColor=#333333;strokeWidth=2;fontStyle=1;fontSize=11;" edge="1" parent="1" source="n20" target="n21"><mxGeometry relative="1" as="geometry"/></mxCell>
        <mxCell id="e121" value="Belum Penuh" style="edgeStyle=orthogonalEdgeStyle;rounded=1;html=1;strokeColor=#333333;strokeWidth=2;fontStyle=1;fontSize=11;" edge="1" parent="1" source="n21" target="n22"><mxGeometry relative="1" as="geometry"/></mxCell>
        <mxCell id="e122" value="Monitoring Lanjutan" style="edgeStyle=orthogonalEdgeStyle;rounded=1;html=1;strokeColor=#333333;strokeWidth=2;fontStyle=1;fontSize=11;" edge="1" parent="1" source="n22" target="n19"><mxGeometry relative="1" as="geometry"/></mxCell>
        <mxCell id="e123" value="Penuh (100%)" style="edgeStyle=orthogonalEdgeStyle;rounded=1;html=1;strokeColor=#333333;strokeWidth=2;fontStyle=1;fontSize=11;" edge="1" parent="1" source="n21" target="n23"><mxGeometry relative="1" as="geometry"/></mxCell>
        <mxCell id="e124" value="Update Database" style="edgeStyle=orthogonalEdgeStyle;rounded=1;html=1;strokeColor=#333333;strokeWidth=2;fontStyle=1;fontSize=11;" edge="1" parent="1" source="n23" target="n24"><mxGeometry relative="1" as="geometry"/></mxCell>
        <mxCell id="e125" value="Mulai Panen" style="edgeStyle=orthogonalEdgeStyle;rounded=1;html=1;strokeColor=#333333;strokeWidth=2;fontStyle=1;fontSize=11;" edge="1" parent="1" source="n24" target="n25"><mxGeometry relative="1" as="geometry"/></mxCell>
        <mxCell id="e126" value="" style="edgeStyle=orthogonalEdgeStyle;rounded=1;html=1;strokeColor=#333333;strokeWidth=2;fontStyle=1;fontSize=11;" edge="1" parent="1" source="n25" target="n26"><mxGeometry relative="1" as="geometry"/></mxCell>
        <mxCell id="e127" value="Data Terkirim" style="edgeStyle=orthogonalEdgeStyle;rounded=1;html=1;strokeColor=#333333;strokeWidth=2;fontStyle=1;fontSize=11;" edge="1" parent="1" source="n26" target="n27"><mxGeometry relative="1" as="geometry"/></mxCell>
        <mxCell id="e128" value="Menunggu Validasi" style="edgeStyle=orthogonalEdgeStyle;rounded=1;html=1;strokeColor=#333333;strokeWidth=2;fontStyle=1;fontSize=11;" edge="1" parent="1" source="n27" target="n28"><mxGeometry relative="1" as="geometry"/></mxCell>
        <mxCell id="e129" value="Keputusan Admin" style="edgeStyle=orthogonalEdgeStyle;rounded=1;html=1;strokeColor=#333333;strokeWidth=2;fontStyle=1;fontSize=11;" edge="1" parent="1" source="n28" target="n29"><mxGeometry relative="1" as="geometry"/></mxCell>
        <mxCell id="e130" value="Tolak / Invalid" style="edgeStyle=orthogonalEdgeStyle;rounded=1;html=1;strokeColor=#333333;strokeWidth=2;fontStyle=1;fontSize=11;" edge="1" parent="1" source="n29" target="n30"><mxGeometry relative="1" as="geometry"/></mxCell>
        <mxCell id="e131" value="Setujui (Valid)" style="edgeStyle=orthogonalEdgeStyle;rounded=1;html=1;strokeColor=#333333;strokeWidth=2;fontStyle=1;fontSize=11;" edge="1" parent="1" source="n29" target="n31"><mxGeometry relative="1" as="geometry"/></mxCell>
        <mxCell id="e132" value="Pengecekan Siklus" style="edgeStyle=orthogonalEdgeStyle;rounded=1;html=1;strokeColor=#333333;strokeWidth=2;fontStyle=1;fontSize=11;" edge="1" parent="1" source="n31" target="n32"><mxGeometry relative="1" as="geometry"/></mxCell>
        <mxCell id="e133" value="Ya (&gt;= 5x)" style="edgeStyle=orthogonalEdgeStyle;rounded=1;html=1;strokeColor=#333333;strokeWidth=2;fontStyle=1;fontSize=11;" edge="1" parent="1" source="n32" target="n33"><mxGeometry relative="1" as="geometry"/></mxCell>
        <mxCell id="e134" value="Belum (Panen Lagi)" style="edgeStyle=orthogonalEdgeStyle;rounded=1;html=1;strokeColor=#333333;strokeWidth=2;fontStyle=1;fontSize=11;" edge="1" parent="1" source="n32" target="n25"><mxGeometry relative="1" as="geometry"/></mxCell>
        
      </root>
    </mxGraphModel>
  </diagram>
</mxfile>'

[System.IO.File]::WriteAllText("d:\Projek TA\jamur_tiram\alur_sistem_informasi.drawio", $xml, [System.Text.Encoding]::UTF8)
