create database pbdproject;
use pbdproject;

create table role (
idrole INT PRIMARY KEY auto_increment,
nama_role VARCHAR(100));

create table satuan (
idsatuan INT PRIMARY KEY auto_increment,
nama_satuan VARCHAR(45),
status TINYINT);

create table vendor (
idvendor INT PRIMARY KEY auto_increment,
nama_vendor VARCHAR(100),
badan_hukum CHAR(1),
status CHAR(1));

create table user (
iduser INT PRIMARY KEY auto_increment,
username VARCHAR(45),
password VARCHAR(100),
idrole INT,
constraint fk_user_role FOREIGN KEY (idrole) REFERENCES role(idrole));

create table barang (
idbarang INT PRIMARY KEY auto_increment,
jenis CHAR(1),
nama VARCHAR(45),
idsatuan INT,
status TINYINT,
harga INT,
constraint fk_barang_satuan FOREIGN KEY (idsatuan) REFERENCES satuan(idsatuan));

create table margin_penjualan (
idmargin_penjualan INT PRIMARY KEY auto_increment,
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
persen DOUBLE,
status TINYINT,
iduser INT,
updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
constraint fk_margin_user FOREIGN KEY (iduser) REFERENCES user(iduser));

create table pengadaan (
idpengadaan BIGINT PRIMARY KEY auto_increment,
timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
user_iduser INT,
status CHAR(1),
vendor_idvendor INT,
subtotal_nilai INT,
ppn INT,
total_nilai INT,
constraint fk_pengadaan_user FOREIGN KEY (user_iduser) REFERENCES user(iduser),
constraint fk_pengadaan_vendor FOREIGN KEY (vendor_idvendor) REFERENCES vendor(idvendor));

create table detail_pengadaan (
iddetail_pengadaan BIGINT PRIMARY KEY auto_increment,
harga_satuan INT,
jumlah INT,
sub_total INT,
idbarang INT,
idpengadaan BIGINT,
constraint fk_det_pengadaan_barang FOREIGN KEY (idbarang) REFERENCES barang(idbarang),
constraint fk_det_pengadaan_pengadaan FOREIGN KEY (idpengadaan) REFERENCES pengadaan(idpengadaan));

create table penerimaan (
idpenerimaan BIGINT PRIMARY KEY auto_increment,
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
status CHAR(1),
idpengadaan BIGINT,
iduser INT,
constraint fk_penerimaan_pengadaan FOREIGN KEY (idpengadaan) REFERENCES pengadaan(idpengadaan),
constraint fk_penerimaan_user FOREIGN KEY (iduser) REFERENCES user(iduser));

create table detail_penerimaan (
iddetail_penerimaan BIGINT PRIMARY KEY auto_increment,
idpenerimaan BIGINT,
barang_idbarang INT,
jumlah_terima INT,
harga_satuan_terima INT,
sub_total_terima INT,
constraint fk_det_penerimaan_penerimaan FOREIGN KEY (idpenerimaan) REFERENCES penerimaan(idpenerimaan),
constraint fk_det_penerimaan_barang FOREIGN KEY (barang_idbarang) REFERENCES barang(idbarang));

create table penjualan (
idpenjualan INT PRIMARY KEY auto_increment,
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
subtotal_nilai INT,
ppn INT,
total_nilai INT,
iduser INT,
idmargin_penjualan INT,
constraint fk_penjualan_user FOREIGN KEY (iduser) REFERENCES user(iduser),
constraint fk_penjualan_margin FOREIGN KEY (idmargin_penjualan) REFERENCES margin_penjualan(idmargin_penjualan));

create table detail_penjualan (
iddetail_penjualan BIGINT PRIMARY KEY auto_increment,
harga_satuan INT,
jumlah INT,
subtotal INT,
penjualan_idpenjualan INT,
idbarang INT,
constraint fk_det_penjualan_penjualan FOREIGN KEY (penjualan_idpenjualan) REFERENCES penjualan(idpenjualan),
constraint fk_det_penjualan_barang FOREIGN KEY (idbarang) REFERENCES barang (idbarang));

create table retur (
idretur BIGINT PRIMARY KEY auto_increment,
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
idpenerimaan BIGINT,
iduser INT,
constraint fk_retur_penerimaan FOREIGN KEY (idpenerimaan) REFERENCES penerimaan(idpenerimaan),
constraint fk_retur_user FOREIGN KEY (iduser) REFERENCES user(iduser));

create table detail_retur (
iddetail_retur INT PRIMARY KEY auto_increment,
jumlah INT,
alasan VARCHAR(200),
idretur BIGINT,
iddetail_penerimaan BIGINT,
constraint fk_det_retur_retur FOREIGN KEY (idretur) REFERENCES retur(idretur),
constraint fk_det_retur_det_penerimaan FOREIGN KEY (iddetail_penerimaan) REFERENCES detail_penerimaan(iddetail_penerimaan));

create table kartu_stok (
idkartu_stok BIGINT PRIMARY KEY auto_increment,
jenis_transaksi CHAR(1), 
masuk INT,
keluar INT,
stock INT,
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
idtransaksi INT,
idbarang INT,
constraint fk_kartu_stok_barang FOREIGN KEY (idbarang) REFERENCES barang(idbarang));

insert into role (nama_role) values 
('Administrator Sistem'),
('Manajer Toko'),
('Kasir'),
('Staf Gudang'),
('Owner'); 

insert into user (username, password, idrole) values
('admin_dubai', 'dubai123456', 1),
('manajerdimas', 'dimas123456', 2),
('kasirnala', 'nala123456', 3),
('gudangfira', 'fira123456', 4),
('owneraluna', 'aluna123456', 5);

-- status: 1 = Aktif, 0 = Tidak Aktif
insert into satuan (nama_satuan, status) values
('Pcs', 1),
('Box', 1),
('Set', 1),
('Lusin', 1),
('Pack', 1);

-- badan_hukum: P = PT, C = CV, O = Perorangan
-- status: 1 = Aktif, 0 = Tidak Aktif
insert into vendor (nama_vendor, badan_hukum, status) values
('PT Pop Mart Indonesia', 'P', '1'),
('Schylling Toys Corp', 'P', '1'), 
('CV Slime Nusantara', 'C', '1'), 
('Toko Fidget & Sensory', 'O', '1'),
('PT Art Toys Jakarta', 'P', '1');

-- Penjelasan jenis: 
-- S = Squishy / Stress Ball
-- L = sLime
-- B = Blind Box / Art Toy
-- F = Fidget Toy
insert into barang (jenis, nama, idsatuan, status, harga) values
('S', 'NeeDoh Classic', 1, 1, 65000),
('L', 'Tofu Slime 200gr', 1, 1, 35000),
('B', 'Labubu The Monsters Macaron', 2, 1, 385000),
('S', 'Mesh Stress Ball Anti-Anxiety', 1, 1, 25000),
('S', 'NeeDoh Mac n Squeeze', 1, 1, 85000),
('B', 'Labubu Fall in Wild Series', 2, 1, 420000);


-- persen: 10, 20, 30, 40, 50
-- status: 1 (Aktif), 0 (Tidak Aktif) -> Hanya 1 yang aktif
-- iduser merujuk pada tabel user sebelumnya (misal iduser 1 atau 5)
insert into margin_penjualan (persen, status, iduser) values
(10.0, 0, 1),
(20.0, 0, 1),
(30.0, 1, 1), 
(40.0, 0, 2),
(50.0, 0, 5);

-- satuan, barang, vendor, user, role, margin
create view viewsatuan as select * from satuan;
create view viewbarang as select * from barang;
create view viewvendor as select * from vendor;
create view viewuser as select * from user;
create view viewrole as select * from role;
create view viewmargin as select * from margin_penjualan;


