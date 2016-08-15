<!-- Page header -->
<div class="page-header">
	<div class="page-title">
		<h3><?=$row_webinfo["webname"];?><?php if(ENVIRONMENT != "production"){echo "-".ENVIRONMENT;}?><small><?=$row_webinfo["webtitle"];?></small></h3>
	</div>
	
</div>
<!-- /page header -->
<!-- Breadcrumbs line -->
<div class="breadcrumb-line">
	<ul class="breadcrumb">
		<li><a href="<?= $row_submenu["link"];?>"><?= $row_submenu["name"];?></a></li>
		<?php

			if ($this->input->get("panel")) {
				$id=$this->input->get("panel");
				$row_submenu_2=select_submenu($id);
			}

			if ($this->input->get("mpanel")) {
				$id=$this->input->get("mpanel");
				$row_submenu_2=select_submenu($id);
				echo "<li><a href='".$row_submenu_2["link"]."'>".$row_submenu_2["name"]."</a></li>";
			}

			if ($this->input->get("ipanel")) {
				$id=$this->input->get("ipanel");
				$row_submenu_2=select_submenu($id);
				echo "<li><a href='".$row_submenu_2["link"]."'>".$row_submenu_2["name"]."</a></li>";
			}

			if ($this->input->get("rpanel")) {
				$id=$this->input->get("rpanel");
				$row_submenu_2=select_submenu($id);
				echo "<li><a href='".$row_submenu_2["link"]."'>".$row_submenu_2["name"]."</a></li>";
			}

			if ($this->input->get("tpanel")) {
				$id=$this->input->get("tpanel");
				$row_submenu_2=select_submenu($id);
				echo "<li><a href='".$row_submenu_2["link"]."'>".$row_submenu_2["name"]."</a></li>";
			}

			if (!$this->input->get("panel") || !$this->input->get("ipanel") || !$this->input->get("mpanel") || !$this->input->get("rpanel") || !$this->input->get("tpanel")) {
				echo "";
			}
			?>		
		<li>
			<?php
				if ($this->input->get("panel")) {
				$id=$this->input->get("panel");
				// echo $id;
				$row_submenu_2=select_submenu($id);
				echo $row_submenu_2["name"];
			}
			if ($this->input->get("mpanel")) {
				$id=$this->input->get("mpanel");
				$row_submenu_2=select_submenu($id);
				echo $row_submenu_2["name"] . "修改";
			}
			if ($this->input->get("ipanel")) {

				$id=$this->input->get("ipanel");
				$row_submenu_2=select_submenu($id);
				echo $row_submenu_2["name"] . "新增";
			}
			if ($this->input->get("rpanel")) {

				$id=$this->input->get("rpanel");
				$row_submenu_2=select_submenu($id);
				echo $row_submenu_2["name"] . "資源回收桶";
			}
			if ($this->input->get("tpanel")) {

				$id=$this->input->get("tpanel");
				$row_submenu_2=select_submenu($id);
				echo $row_submenu_2["name"] . "上傳";
			}
			if ($this->input->get("panel") == 1 || !$this->input->get("panel") || !$this->input->get("ipanel") || !$this->input->get("mpanel") || !$this->input->get("rpanel") || !$this->input->get("tpanel")) {
				echo "";
			}
				
				
			?>
			

		</li>
		
	</ul>
	
</div>
<!-- /breadcrumbs line -->