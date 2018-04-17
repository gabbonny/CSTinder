//javascript functionality for image buttons
function main() {
        let denyButton = document.getElementById("deny");
        let acceptButton = document.getElementById("accept");
    
        denyButton.onclick = deny;
        acceptButton.onclick = accept;
}

function accept(ob1,ob2) {
    //will compare the lang and 2 classes then redirect immediately to match.php
    //so this will return true or false;
    if ($curr_lang === $lang || ($curr_class1 === $class1 || $curr_class2 === $class2)){
        return true;
        //$match_array[$email] = $pic;
        //$_SESSION['match'] = $match_array;
        //header("Location: match.php");
    }
    return false;
}
function deny() {
    //this will implement just like the next function
    next();
    let nextNode = currentNode.neighbor;
    let start = document.getElementById("start").value;
    let end = document.getElementById("end").value;
    document.getElementById("myImage").src = nextNode.data;
    currentNode = nextNode;
}