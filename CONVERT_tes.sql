SELECT t1.*
    , mrb.id AS ranah_borang_id
    , mrb.nama_ranah
    , mjk.id AS jenis_kegiatan_id
    , mjk.nama_jenis_kegiatan, mk.id AS kegiatan_id
    , mk.nama_kegiatan
    , CONCAT(m.firstname, ' ', m.lastname) AS nama_member 
FROM (     
    SELECT hkpp.id, hkpp.member_id, hkpp.tanggal AS tgl, hkpp.master_kegiatan_id, hkpp.nilai_skp, hkpp.tahun, hkpp.cabang_verif, hkpp.cabang_tgl, hkpp.cabang_ket 
    FROM history_kegiatan_pembelajaran_pribadi hkpp 
    UNION 
    SELECT hkp.id, hkp.member_id, hkp.tanggal AS tgl, hkp.master_kegiatan_id, hkp.nilai_skp, hkp.tahun, hkp.cabang_verif, hkp.cabang_tgl, hkp.cabang_ket 
    FROM history_kegiatan_profesional hkp 
    UNION 
    SELECT hkpm.id, hkpm.member_id, hkpm.tanggal_mulai AS tgl, hkpm.master_kegiatan_id, hkpm.nilai_skp, hkpm.tahun, hkpm.cabang_verif, hkpm.cabang_tgl, hkpm.cabang_ket 
    FROM history_kegiatan_pengabdian_masyarakat hkpm 
    UNION 
    SELECT hkpi1.id, hkpi1.member_id, hkpi1.tanggal AS tgl, hkpi1.master_kegiatan_id, hkpi1.nilai_skp, hkpi1.tahun, hkpi1.cabang_verif, hkpi1.cabang_tgl, hkpi1.cabang_ket 
    FROM history_kegiatan_publikasi_ilmiah hkpi1 
    UNION 
    SELECT hkpi2.id, hkpi2.member_id, hkpi2.tanggal AS tgl, hkpi2.master_kegiatan_id, hkpi2.nilai_skp, hkpi2.tahun, hkpi2.cabang_verif, hkpi2.cabang_tgl, hkpi2.cabang_ket 
    FROM history_kegiatan_pengembangan_ilmu hkpi2
) t1 
LEFT JOIN master_kegiatan mk ON t1.master_kegiatan_id = mk.id 
LEFT JOIN master_jenis_kegiatan mjk ON mk.master_jenis_kegiatan_id = mjk.id 
LEFT JOIN master_ranah_borang mrb ON mjk.master_ranah_borang_id = mrb.id 
LEFT JOIN members m ON t1.member_id = m.id 
LEFT JOIN users u ON m.user_id = u.id 
WHERE 1=1
    and (t1.cabang_verif is null or t1.cabang_verif = 0)