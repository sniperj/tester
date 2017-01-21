var app = angular.module("demo",["ngRoute"])
				 .config(function($routeProvider){
				 	$routeProvider
				 				.when("/home",
				 					{
				 						templateUrl:"templates/home.html",
				 						controller:"homeController"
				 					})
							 	.when("/users",
				 					{
				 						templateUrl:"templates/users.html",
				 						controller:"usersController"
				 					})	 
				 })
				 .controller("demoController",function($scope){
				 		$scope.setSelElement = function(element){
				 			$scope.sel_ele =element;
				 		}
				 		$scope.isActive = function(element){
				 			if($scope.sel_ele == element)
				 			{
								return "active";
				 			}	
				 			else 
				 			{
				 				return "";
				 			}	
							
				 		}
				 })				 
				 .controller("homeController",function($scope){
				 		$scope.title = "Home Page";

				 })
				 .controller("usersController",function($scope, userService){
				 		$scope.title = "Users Info";
				 		$scope.mtn_user ="";
				 		$scope.form_hide = true ; 
				 		$scope.message_hide = true;	
				 		$scope.actio


				 		
				 		$scope.updateUser=function(user_id){
				 			$scope.subtitle = "Update User";
				 			userService.getUsers(user_id).then(function(results){
				 				$scope.mtn_user = results.data[0]	 ;	
				 				$scope.mtn_user.user_id = user_id;
				 				$scope.form_hide = false ; 
				 				$scope.action = "update";
			
				 			});
				 		}
				 		$scope.mtn_save = function(){
				 			if($scope.action=="add")
				 			{

				 			}	
				 			else if($scope.action=="update")
				 			{
				 				userService.updateUser($scope.mtn_user).then(success,fail);
				 			}
				 			else if($scope.action == "delete")
				 			{

				 			}	
				 		}
				 		$scope.mtn_cancel = function()
				 		{
				 			delete $scope.mtn_users ; 
				 			$scope.form_hide = true;
				 			$scope.message_hide = true;
				 		}
				 	var success = function(results)
				 	{
				 		$scope.message_hide = false ; 
				 		$scope.message = results.data[1];
				 		$scope.class = (results.data[1]?"success":"danger");
				 		if(results.data[0])
				 		{
				 			$scope.form_hide = true 
				 			getUsers();
				 			delete $scope.mtn_user;

				 		}	
				 	}
				 	var fail = function(results)
				 	{
				 		$scope.message_hide = false ; 
				 		$scope.message = results.data[1];
				 		$scope.class = "danger";
				 	}
				 	var getUsers = function(){
				 		userService.getUsers().then(function(results){
				 		 $scope.users = results.data;	
				 		});
				 	}
				 	getUsers();
				 });			 