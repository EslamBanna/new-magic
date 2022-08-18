

//toggel gear click
let gear = document.querySelector(".toggel-setting .fa-gear");
gear.onclick = function(){

    //spin gear
    this.classList.toggle("fa-spin");
    //open setting list
    document.querySelector(".setting-box").classList.toggle("open");
}






//Create popup with image
let ourGallery = document.querySelectorAll(".gallery img");
 ourGallery.forEach(img => {

    img.addEventListener('click', (e) =>{

        //create over lay element
        let overlay = document.createElement("div");

        //add class to overlay
        overlay.className = 'popup-overlay';

        //Append overlay to the body
        document.body.appendChild(overlay);

        //create popup
        let popupBox = document.createElement("div");

        //create popup class
        popupBox.className = 'popup-box';

        if(img.alt !== null ){

            //create Heading
            let imageHeading = document.createElement("h3");

            //create text for heading
            let imgTxt = document.createTextNode(img.alt);

            //append text to heading
            imageHeading.appendChild(imgTxt);

            //append heading to popup
            popupBox.appendChild(imageHeading);

        }

        //creaet img
        let popupImage = document.createElement("img");

        //set img source
        popupImage.src = img.src;

        //Add image to popupBox
        popupBox.appendChild(popupImage);

        //Append all box on body
        document.body.appendChild(popupBox);

        //create close span
        let closeButton = document.createElement("span");

        let closeButtonText =  document.createTextNode("X");

        closeButton.appendChild(closeButtonText);
        //add class to close button
        closeButton.className = 'close-button';

        //add close buttoon to popup box
        popupBox.appendChild(closeButton);

    });




    //close popup function

    document,addEventListener("click", function (e) {

        if(e.target.className == 'close-button'){

            //remove current pop
            e.target.parentNode.remove();
            // remove overlay
            document.querySelector(".popup-overlay").remove();

        }

    });
 })

//show div
 var userData = document.getElementById("user-data");
 var testData = document.getElementById("test-data");
 var  conData = document.getElementById("consultation-data");
 var  footer = document.getElementById("footer");

function showUser(){
    userData.style.display = "block";
    testData.style.display = "none";
    conData.style.display = "none";
        footer.style.display = "block";

}
function showTest(){
    userData.style.display = "none";
    testData.style.display = "block";
    conData.style.display = "none";
        footer.style.display = "block";

}
function showcon(){
    userData.style.display = "none";
    testData.style.display = "none";
    conData.style.display = "block";
    footer.style.display = "none";

}


