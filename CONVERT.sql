


delete from members where user_id not in (select id from users);

delete from members_history_pengajuan where member_id not in (select id from members);
delete from member_anak where member_id not in (select id from members);
delete from member_file where member_id not in (select id from members);
delete from member_jurnal where member_id not in (select id from members);
delete from member_minat_bidang where member_id not in (select id from members);
delete from member_pasangan where member_id not in (select id from members);
delete from member_pekerjaan where member_id not in (select id from members);
delete from member_pendidikan where member_id not in (select id from members);
delete from member_pengajuan where member_id not in (select id from members);
delete from member_praktek where member_id not in (select id from members);
delete from member_ujian where member_id not in (select id from members);

delete from buku_tamu where member_id not in (select id from members);
delete from buku_tamu where event_id not in (select id from event);
delete from event_harga where event_id not in (select id from event);
delete from event_history_buku_tamu where event_id not in (select id from event);

delete from borang where member_id not in (select id from members);