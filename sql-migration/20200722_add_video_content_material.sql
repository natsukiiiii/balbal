alter table m400_genryo
	add video_iframe_src text null after rec_genryo;

alter table m400_genryo
	add video_title text null after video_iframe_src;

alter table m400_genryo
	add video_note text null after video_title;

alter table m400_genryo
	add video_duration text null after video_note;

alter table m400_genryo
	add video_text_content text null after video_duration;

alter table m400_genryo
	add video_get_password_url text null after video_text_content;