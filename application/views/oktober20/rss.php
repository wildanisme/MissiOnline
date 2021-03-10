<?php
  $iden = $this->db->query("SELECT * FROM identitas")->row_array();
  $logo = $this->db->query("SELECT * FROM logo")->row_array();
  $sql  = $this->db->query("SELECT * FROM tulisan ORDER BY id_tulisan DESC LIMIT 10");
  $file = fopen("rss.xml", "w");
  fwrite($file, '<?xml version="1.0"?> 
  <rss version="2.0">');

  fwrite($file, "<channel> 
				<title>$iden[nama_website] RSS</title> 
				<link>$iden[url]</link> 
				<image>
				<url>$iden[url]/asset/logo/logo-footer.png</url>
				<link>$iden[url]</link>
				<width>100</width>
				<height>35</height>
				</image>
				<language>id-id</language>");

  foreach ($sql->result_array() as $r){
  $isi_tulisan = htmlentities(strip_tags(nl2br($r['isi_tulisan']))); 
  $isi   = substr($isi_tulisan,0,500); 
  $isi   = phpmu(substr($isi_tulisan,0,strrpos($isi," "))); 

  fwrite($file, "<item>
                 <title>".phpmu($r['judul'])."</title>
                 <link>$iden[url]/tulisan-$r[judul_seo].html</link>
                 <description>$isi ...</description>
                 </item>");}

  fwrite($file, "</channel></rss>");
  fclose($file);
