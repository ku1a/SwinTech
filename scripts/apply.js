
"use strict";

function getDetails(){
	if (typeof(Storage)!=="undefined"){
    if (localStorage.getItem("firstname") !== null){   
      document.getElementById("name").value = localStorage.getItem("firstname");	
    }
    if (localStorage.getItem("lastname") !== null){   
      document.getElementById("surname").value = localStorage.getItem("lastname");	
    }
    if (localStorage.getItem("address") !== null){   
      document.getElementById("address").value = localStorage.getItem("address");	
    }
    if (localStorage.getItem("suburb") !== null){   
      document.getElementById("suburb").value = localStorage.getItem("suburb");	
    }
    if (localStorage.getItem("date") !== null){   
      document.getElementById("birthdate").value = localStorage.getItem("date");	
    }
    if (localStorage.getItem("textarea") !== null){   
      document.getElementById("textarea").value = localStorage.getItem("textarea");	
    }
    if (localStorage.getItem("post") !== null){   
      document.getElementById("post").value = localStorage.getItem("post");	
    }
    if (localStorage.getItem("state") !== null){   
      document.getElementById("state").value = localStorage.getItem("state");	
    }
    if (localStorage.getItem("email") !== null){   
      document.getElementById("email").value = localStorage.getItem("email");	
    }
    if (localStorage.getItem("phone") !== null){   
      document.getElementById("phone").value = localStorage.getItem("phone");	
    }
  }
}

function saveDetails(firstname, lastname, address, suburb, date, textarea, post, state, email, phone, age) {
	if (typeof(Storage)!=="undefined"){
		localStorage.setItem("firstname", firstname);
    localStorage.setItem("lastname", lastname);
    localStorage.setItem("address", address);
    localStorage.setItem("suburb", suburb);
    localStorage.setItem("date", date);
    localStorage.setItem("textarea", textarea);
    localStorage.setItem("post", post);
    localStorage.setItem("state", state);
    localStorage.setItem("email", email);
    localStorage.setItem("phone", phone);
    localStorage.setItem("age", age)
	}
}

function getDetails2() {
  if(localStorage.checkbox != undefined){
    if(localStorage.checkbox.search("organised")!= -1)
        document.getElementById("organised").checked = true;
    if(localStorage.checkbox.search("punctual")!= -1)
        document.getElementById("punctual").checked = true;
    if(localStorage.checkbox.search("writingskills")!= -1)
        document.getElementById("writingskills").checked = true;
    if(localStorage.checkbox.search("passionate")!= -1)
        document.getElementById("passionate").checked = true;
    if(localStorage.checkbox.search("mathematics")!= -1)
        document.getElementById("mathematics").checked = true;
    if(localStorage.checkbox.search("problemsolving")!= -1)
        document.getElementById("problemsolving").checked = true;
    if(localStorage.checkbox.search("communicative")!= -1)
        document.getElementById("communicative").checked = true;
    if(localStorage.checkbox.search("other")!= -1)
        document.getElementById("otherskill").checked = true;

    switch(localStorage.gender){
      case "Male":
      document.getElementById("male").checked = true;
      break;
      case "Female":
      document.getElementById("female").checked = true;
      break;
      case "Other":
      document.getElementById("other").checked = true;
      break;
    }
  }
}

function saveDetails2(organised, punctual, writing, passionate, mathematics, problemsolving, communicative, other, gender){
  var checkbox = "";
  if(organised) checkbox = "organised";
  if(punctual) checkbox += ", punctual";
  if(writing) checkbox += ", writingskills";
  if(passionate) checkbox += ", passionate";
  if(mathematics) checkbox += ", mathematics";
  if(problemsolving) checkbox += ", problemsolving";
  if(communicative) checkbox += ", communicative";
  if(other) checkbox += ", other";

  localStorage.checkbox = checkbox;
  localStorage.gender = gender;
}

function getGender(){
  var genderName = "Unknown";
  var genderArray = document.getElementById("genderset").getElementsByTagName("input");
      for(var i = 0; i < genderArray.length; i++){
      if (genderArray[i].checked)
              genderName = genderArray[i].value;
      }
      return genderName;
}

function validate() {
    var result = true;

    //Date components:
    var date = document.getElementById("birthdate").value;
    const YEAR_IN_MILLISECS = 365*24*60*60*1000;
    var dateformat =/^([0-9]{2})\/([0-9]{2})\/([0-9]{4})$/;

    //Other skills components:
    var otherskill = document.getElementById("otherskill").checked;
    var textarea = document.getElementById("textarea").value;

    //State and postcode components:
    var post = document.getElementById("post").value;
    var state = document.getElementById("state").value;

    //error messages:
    var errstate = document.getElementById("errstate");
    var errpost = document.getElementById("errpost");
    var errtextarea = document.getElementById("errtextarea");
    var errdate = document.getElementById("errdate");

    //Other variables: Firstname, Lastname, gender radio buttons, street address, suburb, email, phone, checkbox skills:
    var firstname = document.getElementById("name").value;
    var lastname = document.getElementById("surname").value;
    var address = document.getElementById("address").value;
    var suburb = document.getElementById("suburb").value;
    var email = document.getElementById("email").value;
    var phone = document.getElementById("phone").value;
    
    var organised = document.getElementById("organised").checked;
    var punctual = document.getElementById("punctual").checked;
    var writing = document.getElementById("writingskills").checked;
    var passionate = document.getElementById("passionate").checked;
    var mathematics = document.getElementById("mathematics").checked;
    var problemsolving = document.getElementById("problemsolving").checked;
    var communicative = document.getElementById("communicative").checked;

    //Determine user's age in years:
    var age = -1;
    var now = new Date();
    var dobStr = date.split("/");
    var userdate = new Date(dobStr[2],dobStr[1],dobStr[0],0,0,0,0);
    age = (now.valueOf() - userdate.valueOf())/YEAR_IN_MILLISECS;

    if(!date.match(dateformat)){
        errdate.innerHTML = "Must be in format dd/mm/yyyy*\n";
        result = false;
    }
    else if(age < 15) {
        errdate.innerHTML = "You must be over 15 to apply*\n";
        result = false;
    } 
    else if(age > 80){
        errdate.innerHTML = "You must be under 80 to apply*\n";
        result = false;
    }else {
        errdate.innerHTML = "";
    }

    //Postcode/state matching list:
    var postcodepattern;
    if(state == "VICTORIA"){
      postcodepattern = /^(3|8)\d+$/;
    }
    else if(state == "NEW SOUTH WALES"){
      postcodepattern = /^(1|2)\d+$/;
    }
    else if(state == "QUEENSLAND"){
      postcodepattern = /^(4|9)\d+$/;
    }
    else if(state == "NORTHERN TERRITORY"){
      postcodepattern = /^0\d+$/;
    }
    else if(state == "WESTERN AUSTRALIA"){
      postcodepattern = /^6\d+$/;
    }
    else if(state == "SOUTH AUSTRALIA"){
      postcodepattern = /^5\d+$/;
    }
    else if(state == "TASMANIA"){
      postcodepattern = /^7\d+$/;
    }
    else if(state == "AUSTRALIAN CAPITAL TERRITORY"){
      postcodepattern = /^0\d+$/;
    }

    if(!post.match(postcodepattern)){
      errpost.innerHTML = "State and postcode must be related*\n";
      result = false;
    }else {
      errpost.innerHTML = "";
    }

    if(otherskill && textarea == ""){
        errtextarea.innerHTML = "You must enter any other skills you have*"
        result = false;
    }else {
      errtextarea.innerHTML = "";
    }

    if(result){
        var gender = getGender();
        saveDetails(firstname, lastname, address, suburb, date, textarea, post, state, email, phone);
        saveDetails2(organised, punctual, writing, passionate, mathematics, problemsolving, communicative, other, gender);
    }
    return result;
}

function saveJobRef (jobRefNumber){
    if(typeof(Storage)!=="undefined"){
        localStorage.setItem("jobRef", jobRefNumber);
    }
}

function getJobRef (){
	if(typeof(Storage)!=="undefined"){
		if (localStorage.getItem("jobRef") !== null) {
			var jobRef= document.getElementById("jobRef");
			jobRef.value = localStorage.getItem("jobRef");
		}	
	}
}

function resetErrors(){
  errdate.textContent = "";
  errpost.textContent = "";
  errstate.textContent = "";
  errtextarea.textContent = "";
}

function init(){
  if (document.getElementById("applypage")!== null) {
      getJobRef(); //Function to retrieve the job reference number from jobs.html
      //getDetails(); //Function to prefill form data
      //getDetails2(); //Function to prefill checkboxes and radiobuttons
      //document.getElementById("form").onsubmit = validate;
      //resetErrors;
     
  } 
  else if (document.getElementById("jobspage")!== null) {
      var applylinks = document.getElementsByClassName("applynow");
      for (var i=0; i<applylinks.length; i++) 
          applylinks[i].onclick = function () { saveJobRef(this.id)}
  }
    
}

window.onload = init;