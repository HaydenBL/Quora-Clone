var mostRecent = null;

function continueEmail() {
    if(validateEmail()) {

    }
}

function validateEmail(event) {
    var emailForm = event.currentTarget,
        email = emailForm.value,

        emailCheck = new RegExp("[A-Z]+@[A-Z]+[.][A-Z]+", "i"),
        validEmail = emailCheck.test(email)

        emailError = document.getElementById("email_err");

    emailError.innerHTML = "";

    if(!validEmail) {
        emailError.innerHTML = "Invalid email<br />";
    }
}

function validatePassword(event) {
    var passwordForm = event.currentTarget,
        password = passwordForm.value,

        passCheck = new RegExp("([A-Z0-9^\s]){8,}", "i"),
        validPass = passCheck.test(password),

        passError = document.getElementById("pass_err");

    passError.innerHTML = "";

    if(!validPass) {
        passError.innerHTML = "Invalid password<br />";
    }
}

function validateLogin(event) {

    "use strict";

	var valid = true,

        errorMessage = "",

        email = document.getElementById("email"),
        emailVal = email.value,

        password = document.getElementById("password"),
        passwordVal = password.value,
        
        emailCheck = new RegExp("[A-Z]+@[A-Z]+[.][A-Z]+", "i"),
        validEmail = emailCheck.test(emailVal),
        
        passCheck = new RegExp("([A-Z0-9^\s]){8,}", "i"),
        validPass = passCheck.test(passwordVal);

    document.getElementById("error_msg").innerHTML = "";
    
	if (!validEmail) {
		errorMessage += "Error: invalid email<br />";
		valid = false;
	}

	if (!validPass) {
		errorMessage += "Error: invalid password<br />";
		valid = false;
	}
	
	if (!valid) {
        document.getElementById("error_msg").innerHTML = errorMessage + "<hr />";
	}

    return valid;

}


function validateUsername(event) {
    var usernameForm = event.currentTarget,
        username = usernameForm.value,

        usernameCheck = new RegExp("^(?!\s)([A-Z0-9^\S]){8,}", "i"),
        validUsername = usernameCheck.test(username)

        usernameError = document.getElementById("username_err");

    usernameError.innerHTML = "";

    if(!validUsername) {
        usernameError.innerHTML = "Invalid username<br />";
    }
}

function validatePasswordSignup(event) {
    var passwordForm = event.currentTarget,
        password = passwordForm.value,

        passCheck = new RegExp("([A-Z0-9^\s]){8,}", "i"),
        validPass = passCheck.test(password),

        passError = document.getElementById("pass_err");

    passError.innerHTML = "";

    if(!validPass) {
        passError.innerHTML = "Invalid password<br />";
    }
}

function validatePasswordConfirm(event) {
    var passwordConfirmForm = event.currentTarget,
        passwordConfirm = passwordConfirmForm.value,

        password = document.getElementById("password").value,

        validPasswordConfirm = (password === passwordConfirm),

        passwordConfirmError = document.getElementById("pswdconfirm_err");

    passwordConfirmError.innerHTML = "";

    if(!validPasswordConfirm) {
        passwordConfirmError.innerHTML = "Passwords do not match<br />";
    }
}

function validateBirthday(event) {
    var birthdayForm = event.currentTarget,
        birthday = birthdayForm.value,

        birthdayCheck = new RegExp("([0-9]){4}[-]([0-9]){2}[-]([0-9]){2}", "i"),
        validBirthday = birthdayCheck.test(birthday),

        birthdayError = document.getElementById("bday_err");

    birthdayError.innerHTML = "";

    if(!validBirthday) {
        birthdayError.innerHTML = "Invalid birthday<br />";
    }

}

function validateSignup(event) {

    "use strict";

	var valid = true,
        
        errorMessage = "",

        username = document.getElementById("username"),
        usernameVal = username.value,

        password = document.getElementById("password"),
        passwordVal = password.value,
        
        pswdconfirm = document.getElementById("pswdconfirm"),
        pswdconfirmVal = pswdconfirm.value,

        email = document.getElementById("email"),
        emailVal = email.value,

        birthday = document.getElementById("birthday"),
        birthdayVal = birthday.value,
        
        usernameCheck = new RegExp("^(?!\s)([A-Z0-9^\S]){8,}", "i"),
        validUsername = usernameCheck.test(usernameVal),

        passCheck = new RegExp("([A-Z0-9^\s]){8,}", "i"),
        validPass = passCheck.test(passwordVal),

        emailCheck = new RegExp("[A-Z]+@[A-Z]+[.][A-Z]+", "i"),
        validEmail = emailCheck.test(emailVal),

        birthdayCheck = new RegExp("([0-9]){4}[-]([0-9]){2}[-]([0-9]){2}", "i"),
        validBirthday = birthdayCheck.test(birthdayVal),

        pswdMatch = (passwordVal === pswdconfirmVal);

    document.getElementById("error_msg").innerHTML = "";

    if(!validUsername) {
        errorMessage += "Invalid username<br />";
        valid = false;
    }

    if(!validPass) {
        errorMessage += "Invalid password<br />";
        valid = false;
    }

    if(!pswdMatch) {
        errorMessage += "Passwords do not match<br />";
        valid = false;
    }

    if(!validEmail) {
        errorMessage += "Invalid email<br />";
        valid = false;
    }

    if(!validBirthday) {
        errorMessage += "Invalid birthday<br />";
        valid = false;
    }

    if(!valid) {
        document.getElementById("error_msg").innerHTML = errorMessage + "<hr />";
    }

    return valid;

}

function validateURL(event) {
    var URLForm = document.getElementById("site-url"),
        URL = URLForm.value,

        /* URL validate from: http://regexr.com/39nr7 */
        URLCheck = /[(http(s)?):\/\/(www\.)?a-zA-Z0-9@:%._\+~#=]{2,256}\.[a-z]{2,6}\b([-a-zA-Z0-9@:%_\+.~#?&//=]*)/ig,
        validURL = URLCheck.test(URL),

        URLError = document.getElementById("url_err");

    URLError.innerHTML = "";

    if(!validURL) {
        URLError.innerHTML = "Invalid URL<br />";
    }
}

function validateQA(event) {
    var valid = true,

        URL = document.getElementById("site-url"),
        URLVal = URL.value,

        /* URL validate from: http://regexr.com/39nr7 */
        URLCheck = /[(http(s)?):\/\/(www\.)?a-zA-Z0-9@:%._\+~#=]{2,256}\.[a-z]{2,6}\b([-a-zA-Z0-9@:%_\+.~#?&//=]*)/ig,
        validURL = URLCheck.test(URLVal),

        input = document.getElementById("textform"),
        text = input.value,
        textLength = text.length,

        errorMessage = "";

    document.getElementById("error_msg").innerHTML = "";

    if(!validURL) {
        errorMessage += "Invalid valid URL<br />";
        valid = false;
    }

    if(textLength > 300) {
        errorMessage += "Text field is too long.";
        valid = false;
    }

    if(textLength < 30) {
        errorMessage += "Text field is too short. Please have at least 30 characters.";
        valid = false;
    }

    if(!valid) {
        document.getElementById("error_msg").innerHTML = errorMessage + "<hr />";    
    }

    return valid;

}

function updateCounter(event) {
    var input=document.getElementById("textform"),
        text = input.value
        textLength = text.length;

    document.getElementById("charCount").innerHTML = textLength;

    if(textLength > 300 || textLength < 30) {
        document.getElementById("charCount").style.color = "red";
    }
    else {
        document.getElementById("charCount").style.color = "black";
    }
}

function upvoteClicked(event) {
    var upvote = event.currentTarget,
        downvote = event.currentTarget.parentNode.childNodes[7],

        upvoteText = event.currentTarget.parentNode.childNodes[3],
        downvoteText = event.currentTarget.parentNode.childNodes[9],

        upvoteCount = upvoteText.innerHTML,
        downvoteCount = downvoteText.innerHTML,

        numUpvotes = parseInt(upvoteCount),
        numDownvotes = parseInt(downvoteCount),

        newUpvotes = numUpvotes,
        newDownvotes = numDownvotes,

        id = event.currentTarget.alt;

    if(upvote.classList.contains("upvote-highlight")) {
        upvote.classList.remove("upvote-highlight");
        newUpvotes = numUpvotes - 1;
    } else {
        upvote.classList.add("upvote-highlight");
        newUpvotes = numUpvotes + 1;
    }

    if(downvote.classList.contains("downvote-highlight")) {
        upvote.classList.add("upvote-highlight");
        newUpvotes = numUpvotes + 1;
        downvote.classList.remove("downvote-highlight");
        newDownvotes = numDownvotes - 1;
    }

    if(window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    } else {
        xmlhttp = new ActiveXObject('Microsoft.XMLHTTP');
    }

    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            var response = xmlhttp.responseText;
            //if(response != null)
            //    alert(response);
        }
    };

    xmlhttp.open("GET", "upvote.php?id=" + id, true);
    xmlhttp.send();

    upvoteText.innerHTML = newUpvotes + " Upvotes";
    downvoteText.innerHTML = newDownvotes + " Downvotes";
    
}

function downvoteClicked(event) {
    var upvote = event.currentTarget.parentNode.childNodes[1],
        downvote = event.currentTarget,

        upvoteText = event.currentTarget.parentNode.childNodes[3],
        downvoteText = event.currentTarget.parentNode.childNodes[9],

        upvoteCount = upvoteText.innerHTML,
        downvoteCount = downvoteText.innerHTML,

        numUpvotes = parseInt(upvoteCount),
        numDownvotes = parseInt(downvoteCount),

        newUpvotes = numUpvotes,
        newDownvotes = numDownvotes,

        id = event.currentTarget.alt;

    if(downvote.classList.contains("downvote-highlight")) {
        downvote.classList.remove("downvote-highlight");
        newDownvotes = numDownvotes - 1;
    } else {
        downvote.classList.add("downvote-highlight");
        newDownvotes = numDownvotes + 1;
    }

    if(upvote.classList.contains("upvote-highlight")) {
        downvote.classList.add("downvote-highlight");
        newDownvotes = numDownvotes + 1;
        upvote.classList.remove("upvote-highlight");
        newUpvotes = numUpvotes - 1;
    }

    if(window.XMLHttpRequest) {
    xmlhttp = new XMLHttpRequest();
    } else {
        xmlhttp = new ActiveXObject('Microsoft.XMLHTTP');
    }

    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            //alert(xmlhttp.responseText);
        }
    };

    xmlhttp.open("GET", "downvote.php?id=" + id, true);
    xmlhttp.send();

    upvoteText.innerHTML = newUpvotes + " Upvotes";
    downvoteText.innerHTML = newDownvotes + " Downvotes";

}

function updateMostRecent() {
    var list = document.getElementById("question-list"),
        latestQuestion = list.childNodes[1];

    mostRecent = latestQuestion.childNodes[1].href.match(/\d+$/);

    //alert(mostRecent);
}

function refreshIndex() {
    var list = document.getElementById("question-list"),
        listData = list.innerHTML,
        numQuestions = document.getElementsByClassName("question-display").length;

    if(window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    } else {
        xmlhttp = new ActiveXObject('Microsoft.XMLHTTP');
    }



    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            if(mostRecent != null) {
                var newStuff = xmlhttp.responseText;
                listData = newStuff.concat(listData);
                list.innerHTML = listData;
            } else {
                list.innerHTML = xmlhttp.responseText;
            }
            updateMostRecent();
            updateIndexNumAnswers();
        }
    };

    xmlhttp.open("GET", "refresh-index.php?mostrecent=" + mostRecent, true);
    xmlhttp.send();


    
}

function updateIndexNumAnswers() {
    var questions = document.getElementsByClassName("question-display"),
    i;

    for(i = 0; i < questions.length; i++) {
        var question = questions[i].childNodes[1],
        qid = question.href.match(/\d+$/),
        numAnswersText,
        xmlhttp,
        response;

        if(window.XMLHttpRequest) {
            xmlhttp = new XMLHttpRequest();
        } else {
            xmlhttp = new ActiveXObject('Microsoft.XMLHTTP');
        }

        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                response = xmlhttp.responseText;

                numAnswersText = question.nextSibling.nextSibling.nextSibling.nextSibling.nextSibling.nextSibling.nextSibling.nextSibling;
                numAnswersText.innerHTML = response;
            }
        };

        xmlhttp.open("GET", "update-index-answers.php?id=" + qid, false);
        xmlhttp.send();

    }
}

function refreshQuestionDetail() {
    var answers = document.getElementsByClassName("qd-answer"),
    numAnswers = 0,
    qid = getParameterByName("qid");

    if(answers.length > 0) {
        if(answers[0].classList.contains("no-answers")) {
            numAnswers = 0;
        } else {
            numAnswers = answers.length;
        }
    }

    var list = document.getElementById("answer-list"),
    listData = list.innerHTML,
    highestId = 0,
    i;

    if(numAnswers > 0) {
        highestId = getHighestAnswerId();
        //alert(highestId);
    }

    if(window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    } else {
        xmlhttp = new ActiveXObject('Microsoft.XMLHTTP');
    }

    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            if(numAnswers == 0) {
                list.innerHTML = xmlhttp.responseText;
            } else {
                //list.innerHTML = xmlhttp.responseText;
                var newStuff = xmlhttp.responseText;
                listData = listData.concat(newStuff);
                list.innerHTML = listData;
            }
            setFunctions();
        }
    };

    if(numAnswers > 0) {
        xmlhttp.open("GET", "refresh-question-detail.php?id=" + qid + "&highest=" + highestId, true);
    } else {
        xmlhttp.open("GET", "refresh-question-detail.php?id=" + qid, true);
    }
    xmlhttp.send();

}

function getHighestAnswerId() {
    var arrows = document.getElementsByClassName("upvote-arrow"),
    highestId = 0;

    for(var i = 0; i < arrows.length; i++) {
        current = parseInt(arrows[i].alt);
        if (current > highestId)
            highestId = current;
    }

    return highestId;

}

function getParameterByName(name){
    name = name.replace(/[\[]/,"\\\[").replace(/[\]]/,"\\\]");
    var regexS = "[\\?&]"+name+"=([^&#]*)";
    var regex = new RegExp( regexS );
    var results = regex.exec( window.location.href );
    if( results == null )
        return "";
    else
        return decodeURIComponent(results[1].replace(/\+/g, " "));
}

