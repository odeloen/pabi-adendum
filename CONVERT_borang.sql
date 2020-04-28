SELECT (SELECT IF(SUM(t1.nilai_skp) > 0, SUM(t1.nilai_skp), 0)
		FROM (
		SELECT hkpp.member_id, hkpp.tanggal AS tgl, hkpp.nilai_skp, hkpp.cabang_verif, hkpp.tahun 
		FROM history_kegiatan_pembelajaran_pribadi hkpp 
		UNION 
		SELECT hkp.member_id, hkp.tanggal AS tgl, hkp.nilai_skp, hkp.cabang_verif, hkp.tahun
		FROM history_kegiatan_profesional hkp 
		UNION 
		SELECT hkpm.member_id, hkpm.tanggal_mulai AS tgl, hkpm.nilai_skp, hkpm.cabang_verif, hkpm.tahun
		FROM history_kegiatan_pengabdian_masyarakat hkpm 
		UNION 
		SELECT hkpi1.member_id, hkpi1.tanggal AS tgl, hkpi1.nilai_skp, hkpi1.cabang_verif, hkpi1.tahun
		FROM history_kegiatan_publikasi_ilmiah hkpi1 
		UNION 
		SELECT hkpi2.member_id, hkpi2.tanggal AS tgl, hkpi2.nilai_skp, hkpi2.cabang_verif, hkpi2.tahun
		FROM history_kegiatan_pengembangan_ilmu hkpi2) t1 
		WHERE t1.member_id = b.member_id  
		AND t1.tahun BETWEEN b.tahun_periode_awal AND b.tahun_periode_akhir 
		GROUP BY t1.member_id) AS poin_total

		, (SELECT IF(SUM(t1.nilai_skp) > 0, SUM(t1.nilai_skp), 0)
		FROM (
		SELECT hkpp.member_id, hkpp.tanggal AS tgl, hkpp.nilai_skp, hkpp.cabang_verif, hkpp.tahun 
		FROM history_kegiatan_pembelajaran_pribadi hkpp 
		UNION 
		SELECT hkp.member_id, hkp.tanggal AS tgl, hkp.nilai_skp, hkp.cabang_verif, hkp.tahun
		FROM history_kegiatan_profesional hkp 
		UNION 
		SELECT hkpm.member_id, hkpm.tanggal_mulai AS tgl, hkpm.nilai_skp, hkpm.cabang_verif, hkpm.tahun
		FROM history_kegiatan_pengabdian_masyarakat hkpm 
		UNION 
		SELECT hkpi1.member_id, hkpi1.tanggal AS tgl, hkpi1.nilai_skp, hkpi1.cabang_verif, hkpi1.tahun
		FROM history_kegiatan_publikasi_ilmiah hkpi1 
		UNION 
		SELECT hkpi2.member_id, hkpi2.tanggal AS tgl, hkpi2.nilai_skp, hkpi2.cabang_verif, hkpi2.tahun
		FROM history_kegiatan_pengembangan_ilmu hkpi2) t1 
		WHERE t1.member_id = b.member_id  
		AND t1.tahun BETWEEN b.tahun_periode_awal AND b.tahun_periode_akhir 
		AND t1.cabang_verif IS NULL 
		GROUP BY t1.member_id) AS poin_belum_verif

		, (SELECT IF(SUM(t1.nilai_skp) > 0, SUM(t1.nilai_skp), 0)
		FROM (
		SELECT hkpp.member_id, hkpp.tanggal AS tgl, hkpp.nilai_skp, hkpp.cabang_verif, hkpp.tahun 
		FROM history_kegiatan_pembelajaran_pribadi hkpp 
		UNION 
		SELECT hkp.member_id, hkp.tanggal AS tgl, hkp.nilai_skp, hkp.cabang_verif, hkp.tahun
		FROM history_kegiatan_profesional hkp 
		UNION 
		SELECT hkpm.member_id, hkpm.tanggal_mulai AS tgl, hkpm.nilai_skp, hkpm.cabang_verif, hkpm.tahun
		FROM history_kegiatan_pengabdian_masyarakat hkpm 
		UNION 
		SELECT hkpi1.member_id, hkpi1.tanggal AS tgl, hkpi1.nilai_skp, hkpi1.cabang_verif, hkpi1.tahun
		FROM history_kegiatan_publikasi_ilmiah hkpi1 
		UNION 
		SELECT hkpi2.member_id, hkpi2.tanggal AS tgl, hkpi2.nilai_skp, hkpi2.cabang_verif, hkpi2.tahun
		FROM history_kegiatan_pengembangan_ilmu hkpi2) t1 
		WHERE t1.member_id = b.member_id  
		AND t1.tahun BETWEEN b.tahun_periode_awal AND b.tahun_periode_akhir 
		AND t1.cabang_verif = 1 
		GROUP BY t1.member_id) AS poin_setuju_verif

		, (SELECT IF(SUM(t1.nilai_skp) > 0, SUM(t1.nilai_skp), 0)
		FROM (
		SELECT hkpp.member_id, hkpp.tanggal AS tgl, hkpp.nilai_skp, hkpp.cabang_verif, hkpp.tahun 
		FROM history_kegiatan_pembelajaran_pribadi hkpp 
		UNION 
		SELECT hkp.member_id, hkp.tanggal AS tgl, hkp.nilai_skp, hkp.cabang_verif, hkp.tahun
		FROM history_kegiatan_profesional hkp 
		UNION 
		SELECT hkpm.member_id, hkpm.tanggal_mulai AS tgl, hkpm.nilai_skp, hkpm.cabang_verif, hkpm.tahun
		FROM history_kegiatan_pengabdian_masyarakat hkpm 
		UNION 
		SELECT hkpi1.member_id, hkpi1.tanggal AS tgl, hkpi1.nilai_skp, hkpi1.cabang_verif, hkpi1.tahun
		FROM history_kegiatan_publikasi_ilmiah hkpi1 
		UNION 
		SELECT hkpi2.member_id, hkpi2.tanggal AS tgl, hkpi2.nilai_skp, hkpi2.cabang_verif, hkpi2.tahun
		FROM history_kegiatan_pengembangan_ilmu hkpi2) t1 
		WHERE t1.member_id = b.member_id  
		AND t1.tahun BETWEEN b.tahun_periode_awal AND b.tahun_periode_akhir 
		AND t1.cabang_verif = 2 
		GROUP BY t1.member_id) AS poin_tolak_verif

FROM borang b
WHERE (
		b.tahun_periode_awal <= YEAR(NOW()) 
		AND b.tahun_periode_akhir >= YEAR(NOW())
	)
 AND b.member_id = 71