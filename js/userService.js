app.factory("userService",function($http){

return {
	 getUsers: function(id){
				return $http({
					method:"POST",
					url:"actions.php",
					params:{action:"users_get",user_id:id}
				});


	 },

	 updateUser: function(user){


				return $http({
							method:"POST",
							url:"actions.php",
							params:{action:"users_update",username:user.username,name:user.name,email:user.email,user_id:user.user_id}
						});

	 },
	 deleteUsers: function(id){
				return $http({
						method:"POST",
						url:"actions.php",
						data:{action:'users_delete',user_id:id}
					});
	 }
};
});


