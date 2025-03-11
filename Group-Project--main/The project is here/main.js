document.addEventListener("DOMContentLoaded",() =>){
	const LoginForm = document.querySelector("#Login");
	const creatAccountForm = document.querySelector("createAccount");

	document.querySelector("#linkCreateAccount").addEventListener("click", e =>){
		e.preventDefault();
		loginForm.classList.add("form-hidden");
		createAccountForm.classList.remove("form-hidden");
	}
	
	document.querySelector("#linkLogin").addEventListener("click", e =>){
		e.preventDefault();
		loginForm.classList.add("form-hidden");
		createAccountForm.classList.remove("form-hidden");
	}



	
}