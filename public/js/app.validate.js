// This file contains the validations for the front end applicatiion
var validator_0 = $('#login_form').validate({
    rules: {
        password: {
            required: true,
            minlength: 3
        },
        email: {
            required: true,
            email: true
        }
    },
    messages: {
        password: {
            required: "<div style='color:red' class='light font-14' >Please provide the password.</div>",
            minlength: "<div style='color:red' class='light font-14' >Password should have atleast 3 characters.</div>"
        },
        email: {
            required: "<div style='color:red' class='light font-14' >Please provide us your email address.</div>",
            digits: "<div style='color:red' class='light font-14' >Please provide a valid email adress</div>"
        }
    },
    errorElement:"span"
});

var validator_1 = $("#registration_form").validate({
    errorElement : "span",
	rules : {
		fname : { required:true , minlength:3},
        lname : { required:true , minlength:3},
		password : {required:true , minlength:3},
		c_password : {required:true , minlength:3, equalTo: "#password"},
        email : {required:true , email:true}
	},
	messages : {
		fname : { required:"<div style='color:red;' class='light font-14'>Please provide the First Name.</div>" , minlength:"<div style='color:red;' class='light font-14'>First Name should have atleaset 3 characters.</div>"},
		lname : { required:"<div style='color:red;' class='light font-14'>Please provide the Last Name.</div>" , minlength:"<div style='color:red;' class='light font-14'>Last Name should have atleaset 3 characters.</div>"},
        email : {required:"<div style='color:red;' class='light font-14'>Please provide the Email-id.</div>" , email:"<div style='color:red;' class='light font-14'>Invalid email format.</div>"},
		password : {required:"<div style='color:red;' class='light font-14'>Please provide the Password.</div>" , minlength:"<div style='color:red;' class='light font-14'>Password should have atleast 3 characters.</div>"},
		c_password : {required:"<div style='color:red;' class='light font-14'>Please provide the Confirmed Password field.</div>" , minlength:"<div style='color:red;' class='light font-14'>Confirmed Password should have atleast 3 characters.</div>", equalTo: "<div style='color:red;' class='light font-14'>Password does not match confirmed password.</div>"}
	}
});

