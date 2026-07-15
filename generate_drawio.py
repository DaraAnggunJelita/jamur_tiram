import xml.etree.ElementTree as ET
import os

def create_drawio():
    mxfile = ET.Element("mxfile", host="app.diagrams.net")
    diagram = ET.SubElement(mxfile, "diagram", id="alur_sistem", name="Alur Sistem Produksi Jamur Tiram")
    mxGraphModel = ET.SubElement(diagram, "mxGraphModel", dx="1000", dy="1000", grid="1", gridSize="10", guides="1", tooltips="1", connect="1", arrows="1", fold="1", page="1", pageScale="1", pageWidth="1400", pageHeight="2200", math="0", shadow="1")
    root = ET.SubElement(mxGraphModel, "root")
    
    ET.SubElement(root, "mxCell", id="0")
    ET.SubElement(root, "mxCell", id="1", parent="0")
    
    # Swimlanes
    swimlanes = [
        {"id": "lane1", "value": "Ketua KUPS / Admin", "x": 40, "w": 300},
        {"id": "lane2", "value": "Petugas Kumbung", "x": 340, "w": 300},
        {"id": "lane3", "value": "Sistem Aplikasi", "x": 640, "w": 300},
        {"id": "lane4", "value": "Database", "x": 940, "w": 300},
    ]
    
    for lane in swimlanes:
        cell = ET.SubElement(root, "mxCell", id=lane["id"], value=lane["value"], style="swimlane;whiteSpace=wrap;html=1;fillColor=#10B981;fontColor=#ffffff;fontStyle=1;startSize=30;", vertex="1", parent="1")
        geom = ET.SubElement(cell, "mxGeometry", x=str(lane["x"]), y="40", width=str(lane["w"]), height="2100")
        geom.set("as", "geometry")

    # Styles
    styles = {
        "start": "ellipse;whiteSpace=wrap;html=1;fillColor=#d4edda;strokeColor=#28a745;fontStyle=1;",
        "end": "ellipse;whiteSpace=wrap;html=1;fillColor=#f8d7da;strokeColor=#dc3545;fontStyle=1;strokeWidth=2;",
        "process": "rounded=1;whiteSpace=wrap;html=1;fillColor=#e2e8f0;strokeColor=#64748b;",
        "decision": "rhombus;whiteSpace=wrap;html=1;fillColor=#fff3cd;strokeColor=#ffc107;fontStyle=1;",
        "database": "shape=cylinder3;whiteSpace=wrap;html=1;boundedLbl=1;backgroundOutline=1;size=15;fillColor=#cce5ff;strokeColor=#007bff;"
    }

    nodes = [
        {"id": "n1", "value": "Mulai", "type": "start", "x": 140, "y": 100, "w": 100, "h": 50},
        {"id": "n2", "value": "Kelola & Tambah Stok Bibit", "type": "process", "x": 115, "y": 200, "w": 150, "h": 50},
        {"id": "n3", "value": "Simpan Data Bibit", "type": "database", "x": 1040, "y": 190, "w": 100, "h": 70},
        
        {"id": "n4", "value": "Pembuatan Baglog Baru", "type": "process", "x": 415, "y": 300, "w": 150, "h": 50},
        {"id": "n5", "value": "Input Jumlah & Pilih Bibit", "type": "process", "x": 415, "y": 380, "w": 150, "h": 50},
        {"id": "n6", "value": "Stok Bibit\nCukup?", "type": "decision", "x": 730, "y": 365, "w": 120, "h": 80},
        {"id": "n7", "value": "Notifikasi Stok Habis", "type": "end", "x": 1040, "y": 380, "w": 100, "h": 50},
        {"id": "n8", "value": "Kurangi Stok & Simpan Baglog", "type": "database", "x": 1025, "y": 480, "w": 130, "h": 70},
        
        {"id": "n9", "value": "Proses Sterilisasi", "type": "process", "x": 415, "y": 580, "w": 150, "h": 50},
        {"id": "n10", "value": "Input Suhu & Durasi", "type": "process", "x": 415, "y": 660, "w": 150, "h": 50},
        {"id": "n11", "value": "Suhu >= 95°C\n& Durasi >= 8 Jam?", "type": "decision", "x": 715, "y": 645, "w": 150, "h": 80},
        {"id": "n12", "value": "Status Beresiko", "type": "process", "x": 740, "y": 780, "w": 100, "h": 50},
        {"id": "n13", "value": "Pengukusan Ulang", "type": "process", "x": 415, "y": 780, "w": 150, "h": 50},
        {"id": "n14", "value": "Simpan Status Aman", "type": "database", "x": 1030, "y": 650, "w": 120, "h": 70},
        
        {"id": "n15", "value": "Proses Inokulasi", "type": "process", "x": 415, "y": 900, "w": 150, "h": 50},
        {"id": "n16", "value": "Cek Masa Pendinginan\n(> 24 Jam?)", "type": "decision", "x": 715, "y": 885, "w": 150, "h": 80},
        {"id": "n17", "value": "Tolak Input (Masih Panas)", "type": "end", "x": 1030, "y": 900, "w": 120, "h": 50},
        {"id": "n18", "value": "Simpan Inokulasi", "type": "database", "x": 1030, "y": 1000, "w": 120, "h": 70},
        
        {"id": "n19", "value": "Inkubasi & Monitoring", "type": "process", "x": 415, "y": 1120, "w": 150, "h": 50},
        {"id": "n20", "value": "Input % Miselium", "type": "process", "x": 415, "y": 1200, "w": 150, "h": 50},
        {"id": "n21", "value": "Miselium\n100%?", "type": "decision", "x": 740, "y": 1185, "w": 100, "h": 80},
        {"id": "n22", "value": "Simpan Log Biasa", "type": "database", "x": 1030, "y": 1190, "w": 120, "h": 70},
        {"id": "n23", "value": "Buka Kapas\n(Siap Panen)", "type": "process", "x": 730, "y": 1300, "w": 120, "h": 50},
        {"id": "n24", "value": "Simpan Status", "type": "database", "x": 1040, "y": 1290, "w": 100, "h": 70},
        
        {"id": "n25", "value": "Panen Harian", "type": "process", "x": 415, "y": 1400, "w": 150, "h": 50},
        {"id": "n26", "value": "Input Laporan Panen\n(Grade A & B)", "type": "process", "x": 415, "y": 1480, "w": 150, "h": 60},
        {"id": "n27", "value": "Simpan Laporan\n(Status Pending)", "type": "database", "x": 1030, "y": 1475, "w": 120, "h": 70},
        
        {"id": "n28", "value": "Validasi Laporan Panen", "type": "process", "x": 115, "y": 1485, "w": 150, "h": 50},
        {"id": "n29", "value": "Valid / Tolak?", "type": "decision", "x": 130, "y": 1585, "w": 120, "h": 80},
        {"id": "n30", "value": "Status Dibatalkan", "type": "database", "x": 1040, "y": 1590, "w": 100, "h": 70},
        {"id": "n31", "value": "Status Valid &\nUpdate Stok", "type": "database", "x": 1030, "y": 1690, "w": 120, "h": 70},
        
        {"id": "n32", "value": "Sudah 5x\nPanen?", "type": "decision", "x": 740, "y": 1685, "w": 100, "h": 80},
        {"id": "n33", "value": "Tandai Afkir\n(Selesai)", "type": "end", "x": 740, "y": 1820, "w": 100, "h": 50},
    ]

    for n in nodes:
        cell = ET.SubElement(root, "mxCell", id=n["id"], value=n["value"], style=styles[n["type"]], vertex="1", parent="1")
        geom = ET.SubElement(cell, "mxGeometry", x=str(n["x"]), y=str(n["y"]), width=str(n["w"]), height=str(n["h"]))
        geom.set("as", "geometry")
        
    edges = [
        ("n1", "n2", ""),
        ("n2", "n3", "Simpan"),
        ("n3", "n4", "Lanjut"),
        
        ("n4", "n5", ""),
        ("n5", "n6", "Cek Sistem"),
        ("n6", "n7", "Tidak (Habis)"),
        ("n6", "n8", "Ya (Tersedia)"),
        ("n8", "n9", "Lanjut ke Kumbung"),
        
        ("n9", "n10", ""),
        ("n10", "n11", "Validasi"),
        ("n11", "n12", "Tidak Memenuhi"),
        ("n12", "n13", ""),
        ("n13", "n10", "Input Ulang"),
        ("n11", "n14", "Sesuai SOP"),
        ("n14", "n15", "Lanjut Inokulasi"),
        
        ("n15", "n16", "Cek Waktu"),
        ("n16", "n17", "Kurang dari 24 Jam"),
        ("n16", "n18", "Lebih dari 24 Jam"),
        ("n18", "n19", "Masa Inkubasi"),
        
        ("n19", "n20", ""),
        ("n20", "n21", "Cek %"),
        ("n21", "n22", "Belum Penuh"),
        ("n22", "n19", "Monitoring Lanjutan"),
        ("n21", "n23", "Penuh (100%)"),
        ("n23", "n24", "Update Database"),
        ("n24", "n25", "Mulai Panen"),
        
        ("n25", "n26", ""),
        ("n26", "n27", "Data Terkirim"),
        ("n27", "n28", "Menunggu Validasi"),
        
        ("n28", "n29", "Keputusan Admin"),
        ("n29", "n30", "Tolak / Invalid"),
        ("n29", "n31", "Setujui (Valid)"),
        ("n31", "n32", "Pengecekan Siklus"),
        
        ("n32", "n33", "Ya (>= 5x)"),
        ("n32", "n25", "Belum (Panen Lagi)"),
    ]

    edge_id = 100
    for src, tgt, lbl in edges:
        style = "edgeStyle=orthogonalEdgeStyle;rounded=1;html=1;strokeColor=#333333;strokeWidth=2;fontStyle=1;fontSize=11;"
        cell = ET.SubElement(root, "mxCell", id=f"e{edge_id}", value=lbl, style=style, edge="1", parent="1", source=src, target=tgt)
        geom = ET.SubElement(cell, "mxGeometry", relative="1")
        geom.set("as", "geometry")
        edge_id += 1

    tree = ET.ElementTree(mxfile)
    with open("d:\\Projek TA\\jamur_tiram\\alur_sistem_informasi.drawio", "wb") as f:
        tree.write(f, encoding="utf-8", xml_declaration=True)

if __name__ == "__main__":
    create_drawio()
