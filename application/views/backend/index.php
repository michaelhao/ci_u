<?php include("layout/header.php"); ?>
<div class="page-content">
<?php include("layout/pageheader.php"); ?>
<?php
	header("Content-Type:text/html; charset=utf-8");
	// 取得清單
	if ($this->input->get("panel")) {
		$id=$this->input->get("panel");
		$row_submenu_2=select_submenu($id);
		$listpage= $row_submenu_2["listpage"];
		include($listpage);
	}
	
	// 取得編輯
	if ($this->input->get("mpanel")) {
		$id=$this->input->get("mpanel");
		$row_submenu_2=select_submenu($id);
		$listpage= $row_submenu_2["modifypage"];
		include($listpage);
	}

	// 取得新增
	if ($this->input->get("ipanel")) {
		$id=$this->input->get("ipanel");
		$row_submenu_2=select_submenu($id);
		$listpage= $row_submenu_2["insertpage"];
		include($listpage);
	}

	// 取得回收桶
	if ($this->input->get("rpanel")) {
		$id=$this->input->get("rpanel");
		$row_submenu_2=select_submenu($id);
		$listpage= $row_submenu_2["recoverpage"];
		include($listpage);
	}

	// 取得 Type
	if ($this->input->get("tpanel")) {
		$id=$this->input->get("tpanel");
		$row_submenu_2=select_submenu($id);
		$listpage= $row_submenu_2["typepage"];
		include($listpage);
	}

	// 若沒抓取到任何參數自動導入首頁
	if (!$this->input->get("panel") && !$this->input->get("ipanel") && !$this->input->get("mpanel") && !$this->input->get("rpanel") && !$this->input->get("tpanel")) {
		$row_submenu_2=select_submenu("1");
		$listpage= $row_submenu_2["listpage"];
		include($listpage);
	}
	?>        	
<?php include("layout/footer.php"); ?>