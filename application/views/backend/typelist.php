<?php
include("layout/list_partials.php");
?>
<style>
  .btn {
    margin-right: 8px;
  }
  
  .angular-ui-tree-handle {
    background: #f8faff;
    border: 1px solid #dae2ea;
    color: #7c9eb2;
    padding: 10px 10px;
  }
  
  .angular-ui-tree-handle:hover {
    color: #438eb9;
    background: #f4f6f7;
    border-color: #dce2e8;
  }
  
  .angular-ui-tree-placeholder {
    background: #f0f9ff;
    border: 2px dashed #bed2db;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
  }
  
  tr.angular-ui-tree-empty {
    height: 100px
  }
  
  .group-title {
    background-color: #687074 !important;
    color: #FFF !important;
  }
  /* --- Tree --- */
  
  .tree-node {
    border: 1px solid #dae2ea;
    background: #f8faff;
    color: #7c9eb2;
  }
  
  .nodrop {
    background-color: #f2dede;
  }
  
  .tree-node-content {
    margin: 10px;
  }
  
  .tree-handle {
    padding: 10px;
    background: #428bca;
    color: #FFF;
    margin-right: 10px;
  }
  
  .angular-ui-tree-handle:hover {}
  
  .angular-ui-tree-placeholder {
    background: #f0f9ff;
    border: 2px dashed #bed2db;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
  }
</style>
<!--Datatable with tools menu -->
<div class="panel panel-default" ng-app="TypeApp" ng-controller="TypeCtrl">
  <div class="panel-heading">
    <h6 class="panel-title"><i class="icon-table"></i><?=$name2?>列表</h6>
    <a href="<?=$insert?>" class="btn btn-success pull-right"><span class="icon-plus"></span> <?=$name2;?>新增</a>
  </div>
  <div class="datatable-tools">
    <div class="dataTables_filter" id="DataTables_Table_0_filter">
      <label>
		<span><?=$name2?>:</span>
		<select ng-model="selectData" ng-options="model.name for model in datas" ng-change="changeDatas(model)" class="required select">
		<option value="">請選擇</option>
		</select>
      </label>
    </div>
    <!-- Nested node template -->
    <script type="text/ng-template" id="nodes_renderer.html">
      <div ui-tree-handle class="tree-node tree-node-content">
        <a class="btn btn-success btn-xs" ng-if="node.nodes && node.nodes.length > 0" data-nodrag ng-click="toggle(this)"><span
	        class="glyphicon"
	        ng-class="{
	          'glyphicon-chevron-right': collapsed,
	          'glyphicon-chevron-down': !collapsed
	        }"></span></a> {{node.name}}
        <a class="pull-right btn btn-icon btn-success modifybu" data-nodrag ng-click="delete(node.id)"><i class="icon-remove"></i></a>
        <a class="pull-right btn btn-icon btn-danger modifybu" data-nodrag ng-click="edit(node.id)" style="margin-right: 8px;"><i class="icon-wrench2"></i></a>
      </div>
      <ol ui-tree-nodes="" ng-model="node.nodes" ng-class="{hidden: collapsed}">
        <li ng-repeat="node in node.nodes" ui-tree-node ng-include="'nodes_renderer.html'">
        </li>
      </ol>
    </script>

    <div class="row">
      <div class="col-sm-12">
        <div ui-tree id="tree-root">
          <ol ui-tree-nodes ng-model="data">
            <li ng-repeat="node in data" ui-tree-node ng-include="'nodes_renderer.html'"></li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <BR>
  <div class="form-actions text-right">
    <input type="submit" value="確認" class="btn btn-primary" ng-click="update()">
  </div>
</div>
<!-- /datatable with tools menu -->

<script>
  (function() {
    'use strict';
    angular.module('TypeApp', ['ui.tree'])
      .controller('TypeCtrl', ['$scope', '$http', function($scope, $http) {
        $scope.updateJson = [];

        // 單筆資料展開
        $scope.toggle = function(scope) {
          scope.toggle();
        };

        // 編輯資料
        $scope.edit = function(id) {
          window.location.href = "page?mpanel=<?=$this->input->get('panel')?>" + "&id=" + id;
        };

        // 刪除資料
        $scope.delete = function(id) {
          if (confirm("確認是否要刪除資料。")) {
            window.location.href = "type/delete?panel=<?=$this->input->get('panel')?>" + "&id=" + id;
          }
        };

        // 更新 list
        $scope.update = function() {
          $scope.updateJson = [];
          tree_to_json($scope.data, $scope.parent_id);
          console.log($scope.updateJson);
		  var dataObj = {
			data : $scope.updateJson,
		  };	
          $http.post(
          	"type/list_update",
          	dataObj
          ).success(function(data) {
             console.log(data);
             window.history.go();
          });
        }

        // 類別管理選取功能
        $scope.changeDatas = function(index) {
          $scope.data = $scope.selectData.nodes;
          $scope.parent_id = $scope.selectData.id;
        }

        // Json To Tree
        function json_to_tree(nodes) {
          // 找時間優化改為無限延伸及排序 @TODO IAN
          var roots = _.where(nodes, { 'parent_id': "0" });
          _.each(roots, function(value, key, list){
  			  roots[key].nodes = _.where(nodes, { 'parent_id': value.id });
      			  _.each(roots[key].nodes, function(value2, key2, list){
      			  	roots[key].nodes[key2].nodes = _.where(nodes, { 'parent_id': value2.id });
      			  	_.each(roots[key].nodes[key2].nodes, function(value3, key3, list){
      			  		roots[key].nodes[key2].nodes[key3].nodes = _.where(nodes, { 'parent_id': value3.id });
      			  		_.each(roots[key].nodes[key2].nodes[key3].nodes, function(value4, key4, list){
      			  			roots[key].nodes[key2].nodes[key3].nodes[key4].nodes = _.where(nodes, { 'parent_id': value4.id });
      			  		});
      			  	});
      			  });
            });
            return roots;
        }

        // Tree To Json
        function tree_to_json(nodes, parent) {
          // 找時間優化排序 @TODO IAN
          _.each(nodes, function(node, key, list) {
            node.parent_id = parent;
            $scope.updateJson.push(node);
            if (node.nodes.length != 0) {
              tree_to_json(node.nodes, node.id);
            }
          });
        }

        // 抓取類別資料
        $http.get("type/list_json?panel=<?=$this->input->get('panel')?>").success(function(data) {
          $scope.datas = json_to_tree(data);
          $scope.selectData = $scope.datas[0];
          $scope.data = $scope.selectData.nodes;
          $scope.parent_id = $scope.selectData.id;
        });

      }]);
  }());
</script>