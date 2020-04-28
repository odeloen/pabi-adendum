SELECT t1.tgl as tanggal
	, t1.cabang_verif
	, CASE 
		WHEN t1.cabang_verif is null or t1.cabang_verif = 0
		THEN 'DIPROSES'
		WHEN t1.cabang_verif = 1 
		THEN 'DISETUJUI'
		WHEN t1.cabang_verif = 2
		THEN 'DITOLAK'
	END as judul
	, count(*) as jumlah
FROM (
	SELECT hkpp.id
	, hkpp.member_id
	, hkpp.tanggal AS tgl
	, hkpp.master_kegiatan_id
	, hkpp.nilai_skp
	, hkpp.tahun
	, hkpp.cabang_verif
	, hkpp.cabang_tgl
	, hkpp.cabang_ket
	FROM history_kegiatan_pembelajaran_pribadi hkpp
	UNION
	SELECT hkp.id
	, hkp.member_id
	, hkp.tanggal AS tgl
	, hkp.master_kegiatan_id
	, hkp.nilai_skp
	, hkp.tahun
	, hkp.cabang_verif
	, hkp.cabang_tgl
	, hkp.cabang_ket
	FROM history_kegiatan_profesional hkp
	UNION
	SELECT hkpm.id
	, hkpm.member_id
	, hkpm.tanggal_mulai AS tgl
	, hkpm.master_kegiatan_id
	, hkpm.nilai_skp
	, hkpm.tahun
	, hkpm.cabang_verif
	, hkpm.cabang_tgl
	, hkpm.cabang_ket
	FROM history_kegiatan_pengabdian_masyarakat hkpm
	UNION
	SELECT hkpi1.id
	, hkpi1.member_id
	, hkpi1.tanggal AS tgl
	, hkpi1.master_kegiatan_id
	, hkpi1.nilai_skp
	, hkpi1.tahun
	, hkpi1.cabang_verif
	, hkpi1.cabang_tgl
	, hkpi1.cabang_ket
	FROM history_kegiatan_publikasi_ilmiah hkpi1
	UNION
	SELECT hkpi2.id
	, hkpi2.member_id
	, hkpi2.tanggal AS tgl
	, hkpi2.master_kegiatan_id
	, hkpi2.nilai_skp
	, hkpi2.tahun
	, hkpi2.cabang_verif
	, hkpi2.cabang_tgl
	, hkpi2.cabang_ket
	FROM history_kegiatan_pengembangan_ilmu hkpi2
) t1
LEFT JOIN master_kegiatan mk ON t1.master_kegiatan_id = mk.id
LEFT JOIN master_jenis_kegiatan mjk ON mk.master_jenis_kegiatan_id = mjk.id
LEFT JOIN master_ranah_borang mrb ON mjk.master_ranah_borang_id = mrb.id
LEFT JOIN members m ON t1.member_id = m.id
LEFT JOIN users u ON m.user_id = u.id
WHERE 1
AND m.id=$member_id 
group by t1.tgl, t1.cabang_verif
order by t1.tgl


SELECT count(*) as jml_proses
FROM (
		SELECT hkpp.id
			, hkpp.member_id
			, hkpp.tanggal AS tgl
			, hkpp.master_kegiatan_id
			, hkpp.nilai_skp
			, hkpp.tahun
			, hkpp.cabang_verif
			, hkpp.cabang_tgl
			, hkpp.cabang_ket 
		FROM history_kegiatan_pembelajaran_pribadi hkpp 
		UNION 
		SELECT hkp.id
			, hkp.member_id
			, hkp.tanggal AS tgl
			, hkp.master_kegiatan_id
			, hkp.nilai_skp
			, hkp.tahun
			, hkp.cabang_verif
			, hkp.cabang_tgl
			, hkp.cabang_ket 
		FROM history_kegiatan_profesional hkp 
		UNION 
		SELECT hkpm.id
			, hkpm.member_id
			, hkpm.tanggal_mulai AS tgl
			, hkpm.master_kegiatan_id
			, hkpm.nilai_skp
			, hkpm.tahun
			, hkpm.cabang_verif
			, hkpm.cabang_tgl
			, hkpm.cabang_ket 
		FROM history_kegiatan_pengabdian_masyarakat hkpm 
		UNION 
		SELECT hkpi1.id
			, hkpi1.member_id
			, hkpi1.tanggal AS tgl
			, hkpi1.master_kegiatan_id
			, hkpi1.nilai_skp
			, hkpi1.tahun
			, hkpi1.cabang_verif
			, hkpi1.cabang_tgl
			, hkpi1.cabang_ket 
		FROM history_kegiatan_publikasi_ilmiah hkpi1 
		UNION 
		SELECT hkpi2.id
			, hkpi2.member_id
			, hkpi2.tanggal AS tgl
			, hkpi2.master_kegiatan_id
			, hkpi2.nilai_skp
			, hkpi2.tahun
			, hkpi2.cabang_verif
			, hkpi2.cabang_tgl
			, hkpi2.cabang_ket 
		FROM history_kegiatan_pengembangan_ilmu hkpi2
	) t1 
LEFT JOIN master_kegiatan mk ON t1.master_kegiatan_id = mk.id 
LEFT JOIN master_jenis_kegiatan mjk ON mk.master_jenis_kegiatan_id = mjk.id 
LEFT JOIN master_ranah_borang mrb ON mjk.master_ranah_borang_id = mrb.id 
LEFT JOIN members m ON t1.member_id = m.id 
LEFT JOIN users u ON m.user_id = u.id 
WHERE 1
    AND m.id=71
    AND (t1.cabang_verif is null or t1.cabang_verif = 0)

-------------------------------------


DELETE FROM members WHERE is_excel <> 1 and user_id not in (select id from users);
DELETE FROM members_history_pengajuan where member_id not in (select id from members);
DELETE FROM member_anak where member_id not in (select id from members);
DELETE FROM member_file where member_id not in (select id from members);
DELETE FROM member_jurnal where member_id not in (select id from members);
DELETE FROM member_minat_bidang where member_id not in (select id from members);
DELETE FROM member_pasangan where member_id not in (select id from members);
DELETE FROM member_pekerjaan where member_id not in (select id from members);
DELETE FROM member_pengajuan where member_id not in (select id from members);
DELETE FROM member_praktek where member_id not in (select id from members);
DELETE FROM member_ujian where member_id not in (select id from members);
DELETE FROM event_history_buku_tamu where member_id not in (select id from members);
DELETE FROM buku_tamu where member_id not in (select id from members);

* tabel event_harga => status_harga

* Master Minat Bidang = tabel minat_bidang
* Master Banner = tabel master_banner
* Master Berita = tabel master_berita


select distinct excel_cabang 
from members 
where lower(excel_cabang) not in (select lower(name) from admin_cabang)
order by excel_cabang

select excel_cabang, (select id from admin_cabang where lower(name)=lower(excel_cabang))
from members
where lower(excel_cabang) in (select lower(name) from admin_cabang)
 


* card_no_issue
* email 
* 
* FINACS di Member masih salah. tgl_lulus dan valid_until bisa diubah
 


INSERT INTO members (
			, id
			, user_id
			, firstname
			, gelar
			, nickname
			, excel_t4_lahir 
			, tgl_lahir 
			, gender
			, excel_cabang
			, card_no
			, card_no_issue
			, valid_until_card_no  
			, is_excel
			)
VALUES (
			'"&B2&"'
			, '"&B2&"'
			, '"&C2&"'
			, '"&D2&"'
			, '"&E2&"'
			, '"&G2&"' 
			, '"&TEXT(H2;"yyyy-mm-dd")&"'
			, '"&I2&"'
			, '"&P2&"'
			, '"&R2&"' 
			, '"&TEXT(S2;"yyyy-mm-dd")&"'
			, '"&TEXT(U2;"yyyy-mm-dd")&"' 
			, 1
)

="INSERT INTO members (id, user_id, firstname, gelar, nickname, excel_t4_lahir, tgl_lahir , gender, excel_cabang, card_no, card_no_issue, valid_until_card_no , is_excel) VALUES ('"&B2&"','"&B2&"', '"&C2&"', '"&D2&"', '"&E2&"', '"&G2&"', '"&TEXT(H2;"yyyy-mm-dd")&"', '"&I2&"', '"&P2&"', '"&R2&"' , '"&TEXT(S2;"yyyy-mm-dd")&"', '"&TEXT(U2;"yyyy-mm-dd")&"' , 1);"


UPDATE members 
SET no_pabi_sejahtera='"&AE2&"'  
	, tgl_pabi_sejahtera='"&TEXT(AF2;"yyyy-mm-dd")&"'
	, jabatan='"&AR2&"'
	, alamat_rumah='"&AS2&"'
	, excel_kota_alamat='"&AT2&"'
	, alamat_kantor='"&AU2&"'
	, no_telp_kantor='"&AV2&"'
	, hobi='"&AW2&"'
	, email='"&AX2&"'
	, no_str='"&AY2&"'
	, excel_sjk_tahun_no_str= '"&AZ2&"'
	, excel_ket='"&BA2&"'
WHERE id='"&B2&"';

="UPDATE members SET no_pabi_sejahtera='"&AE2&"', tgl_pabi_sejahtera='"&TEXT(AF2;"yyyy-mm-dd")&"', jabatan='"&AR2&"', alamat_rumah='"&AS2&"', excel_kota_alamat='"&AT2&"', alamat_kantor='"&AU2&"', no_telp_kantor='"&AV2&"', hobi='"&AW2&"', email='"&AX2&"', no_str='"&AY2&"', excel_sjk_tahun_no_str= '"&AZ2&"', excel_ket='"&BA2&"' WHERE id='"&B2&"';"

INSERT INTO members (id
			, user_id
			, firstname
			, gelar
			, nickname
			, excel_t4_lahir
			, tempat_lahir
			, tgl_lahir 
			, gender
			, excel_cabang
			, card_no
			, card_no_issue
			, valid_until_card_no
			, no_pabi_sejahtera
			, tgl_pabi_sejahtera
			, jabatan
			, alamat_rumah
			, excel_kota_alamat
			, alamat_kantor
			, no_telp_kantor
			, hobi
			, email
			, no_str
			, sjk_tahun_no_str
			, excel_ket
			, is_excel
			)
VALUES (
			'"&B2&"'
			, '"&B2&"'
			, '"&C2&"'
			, '"&D2&"'
			, '"&E2&"'
			, '"&F2&"'
			, '"&G2&"'
			, '"&TEXT(H2;"yyyy-mm-dd")&"'
			, '"&I2&"'
			, '"&P2&"'
			, '"&R2&"' 
			, '"&TEXT(S2;"yyyy-mm-dd")&"'
			, '"&TEXT(U2;"yyyy-mm-dd")&"'
			, '"&AE2&"' 
			, '"&TEXT(AF2;"yyyy-mm-dd")&"'
			, '"&AR2&"'
			, '"&AS2&"'
			, '"&AT2&"'
			, '"&AU2&"'
			, '"&AV2&"'
			, '"&AW2&"'
			, '"&AX2&"'
			, '"&AY2&"'
			, '"&AZ2&"'
			, '"&BA2&"'
			, 1
)

 