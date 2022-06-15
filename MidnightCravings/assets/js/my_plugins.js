//--------------------------------------------------------------------
//--- [1] ------------------ FORM VALIDATIONS -------------------------
//--------------------------------------------------------------------


// -----> [Login Page] <------

$(document).ready(function(){

	$("#login_form").click(function(){

		var userName = $("#email").val();
		var password = $("#password").val();

		var isValid = true;

		if(userName == '' || password == '') {
			isValid = false;
			$("#errorLogin").html("<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert'>&times;</button><strong>Warning!</strong> It seems that some fields are missing data. Please fill in both fields.</div>");
			
			return false;
		}
		
		else if(!databaseContainsAuthor($_POST['email'], $password)){
			isValid = false;
			$("#errorLogin").html("<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert'>&times;</button><strong>Warning!</strong> It seems that some fields are missing data. Please fill in both fields.</div>");
			
			return false;
		}
		else
		{
			$("#errorLogin").html("");
		}

	});
});

//-----> [Create new account] <------
$(document).ready(function(){

	$("#reg_form").click(function(){

		var userName = $("#name").val();
		var userEmail = $("#email").val();
		var captcha = $(".g-recaptcha").val();
		var password = $("#pwd").val();
		var passwordRepeat = $("#pwd-repeat").val();

		var isValid = true;

		if(userName == '' || userEmail == '' || password == '') {
			isValid = false;
			let messagge ="<div class='alert alert-danger alert-dismissible'>";
			messagge +="<button type='button' class='close' data-dismiss='alert'>&times;</button>";
			//messagge +="<strong>Error!</strong>";
			messagge +="Please fill in all the required fields.";
			messagge += "</div>";
			messagge;
			$("#error-creating-account").html(messagge);
			return false;
		}
		else if (password != passwordRepeat)
		{
			isValid = false;
			let messagge ="<div class='alert alert-danger alert-dismissible'>";
			messagge +="<button type='button' class='close' data-dismiss='alert'>&times;</button>";
			//messagge +="<strong>Error!</strong>";
			messagge +="Passwords don't match.";
			messagge += "</div>";
			messagge;
			$("#error-creating-account").html(messagge);
			return false;
		}
		else if (!validateEmail(userEmail))
		{
			isValid = false;
			let messagge ="<div class='alert alert-danger alert-dismissible'>";
			messagge +="<button type='button' class='close' data-dismiss='alert'>&times;</button>";
			//messagge +="<strong>Error!</strong>";
			messagge +="Please enter a valid email address.";
			messagge += "</div>";
			messagge;
			$("#error-creating-account").html(messagge);
			return false;
		}
		else if (grecaptcha && grecaptcha.getResponse().length == 0)
		{
			isValid = false;
			let messagge ="<div class='alert alert-danger alert-dismissible'>";
			messagge +="<button type='button' class='close' data-dismiss='alert'>&times;</button>";
			//messagge +="<strong>Error!</strong>";
			messagge +="Captcha is required";
			messagge += "</div>";
			messagge;
			$("#error-creating-account").html(messagge);
			return false;
		}
	});
});






// -----> [Email Validation] <------

 function validateEmail($email) {
  var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
  return emailReg.test( $email );
}




/*========== CONTACT FORM INPUT VALIDATION ==========*/



//--------------------------------------------------------------------
//--- [2] ------------ GOOGLA CAPTCHA VALIDATION ---------------------
//--------------------------------------------------------------------

// $(document).ready(function(){

//  $('#captcha_form').on('submit', function(event){
//   event.preventDefault();
//   $.ajax({
//    url:"process_data.php",
//    method:"POST",
//    data:$(this).serialize(),
//    dataType:"json",
//    beforeSend:function()
//    {
//     $('#register').attr('disabled','disabled');
//    },
//    success:function(data)
//    {
//     $('#register').attr('disabled', false);
//     if(data.success)
//     {
//      $('#captcha_form')[0].reset();
//      $('#name_error').text('');
//      $('#email_error').text('');
//      $('#password_error').text('');
//      $('#captcha_error').text('');
//      grecaptcha.reset();
//      alert('Form Successfully validated');
//     }
//     else
//     {
//      $('#name_error').text(data.first_name_error);
//      $('#email_error').text(data.email_error);
//      $('#password_error').text(data.password_error);
//      $('#captcha_error').text(data.captcha_error);
//     }
//    }
//   })
//  });

// });


//--------------------------------------------------------------------
//--- [2] -------------- ADMIN DATA TABLE COTROLS  -------------------
//--------------------------------------------------------------------

// Author table
$(document).ready(function(){
	$('#author_table_id').DataTable( {
		columnDefs: [
		{ orderable: false, targets: [ 2 , 3 ] }
		],
		order: [[0, 'asc'], [1, 'asc']]
	});
});

// Categories table
$(document).ready(function(){
	$('#cat_table_id').DataTable( {
  		columnDefs: [
    	{ orderable: false, targets: [ 1 , 2 ] }
  		],
  		order: [[0, 'asc']]
	});
});

// Recepies table
$(document).ready(function(){
	$('#rec_table_id').DataTable( {
  		columnDefs: [
    	{ orderable: false, targets: [ 4 , 5 ] }
  		],
  		order: [[0, 'asc'], [1, 'asc'], [2, 'asc']]
	});
});

// Send email table
$(document).ready(function(){
	$('#mail_table_id').DataTable( {
  		columnDefs: [
    	{ orderable: false, targets: [ 1 , 2 ] }
  		],
  		order: [[0, 'asc'], [1, 'asc']]
	});
});


//--------------------------------------------------------------------
//--- [2] --------- Image Input Field name [path]  -------------------
//--------------------------------------------------------------------

$(document).ready(function(){
		$('#fileToUpload').on('change',function(){
		//get the file name
		var fileName = $(this).val();
		//replace the "Choose a file" label
		$(this).next('.custom-file-label').html(fileName);
	});
});